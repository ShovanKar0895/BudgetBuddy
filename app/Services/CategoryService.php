<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;

class CategoryService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function categoryDocument(array $userData){

        return [
            'name' => $userData['name'] ?? null,
            'description' => $userData['description'] ?? null,
            'remarks' => $userData['remarks'] ?? null,
            'user_id' => new ObjectId(Auth::id()),
            'added_time' => time(),
            'last_updated_time' => $userData['last_updated_time'] ?? null,
            'status' => '1',
        ];
    }

    public function populate_defaults_for_user($userId)
{
    try {
        // Fetch default categories
        $defaultCategories = Category::where([
            ['status', '1'],
            ['user_id', 0],
        ])->get();

        // Convert userId to MongoDB ObjectId
        $objUserId = new ObjectId($userId);

        // Transform default categories
        $multiplied = $defaultCategories->map(function ($item) use ($objUserId) {
            $itemArray = $item->toArray();
            unset($itemArray['_id']); // Remove the _id field
            $itemArray['user_id'] = $objUserId;
            $itemArray['added_time'] = time();
            $itemArray['last_updated_time'] = null;

            return $itemArray;
        });

        // Insert new categories
        Category::insert($multiplied->toArray());

        // Update user service
        $this->userService->update([
            'category_seen' => '1'
        ], $userId);

    } catch (\Exception $e) {
        Log::error('Error in populate_defaults_for_user: ' . $e->getMessage());
        throw $e; // Optionally rethrow the exception
    }
}


    public function count($conditions): int
    {
        $searchTerm = $conditions['search_by'];

        return Category::where([
            ['status', '!=', '5'],
            ['user_id',$conditions['user_id']]
            ])->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->count();
    }

    public function list(array $conditions): Collection
    {
        $searchTerm = $conditions['search_by'];

        return Category::where([
            ['status', '!=', '5'],
            ['user_id',$conditions['user_id']]
            ])->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy($conditions['ordering_column'], $conditions['ordering_column_by'])
            ->offset($conditions['offset'])
            ->limit($conditions['limit'])
            ->get();
    }

    public function update(array $updateData, $categoryId): int
    {
        $updateData['last_updated_time'] = time();
        
        // Ensure $categoryId is an ObjectId if necessary
        if (!$categoryId instanceof ObjectId) {
            $categoryId = new ObjectId($categoryId);
        }

        $affectedUsers = Category::where('_id', $categoryId)
            ->where('status', '!=', '5')
            ->update($updateData);

        return $affectedUsers;
    }

    public function store(array $categoryData): Category{
        $category = Category::create($this->categoryDocument($categoryData));
        return $category;
    }

    public function fetch($categoryId){
        return Category::where([
            ['status','!=','5'],
            ['_id',$categoryId]
        ])->first();
    }
}

