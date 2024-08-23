<?php

namespace App\Services;

use App\Models\Investment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;

class InvestmentService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function investmentDocument(array $investmentData){

        return [
            'user_id' => new ObjectId(Auth::id()),
            'type' => $investmentData['type'] ?? null,
            'amount' => $investmentData['amount'] ?? null,
            'institution' => $investmentData['institution'] ?? null,
            'interest_rate' => $investmentData['interest_rate'] ?? null,
            'maturity_date' => $investmentData['maturity_date'] ?? null,
            'frequency' => $investmentData['frequency'] ?? null,
            'commitment_date' => $investmentData['commitment_date'] ?? null,
            'category' => $investmentData['category'] ?? null,
            'note' => $investmentData['note'] ?? null,
            'added_time' => time(),
            'last_updated_time' => $investmentData['last_updated_time'] ?? null,
            'status' => '1',
        ];
    }

    public function store(array $investmentData): Investment{
        $investment = Investment::create($this->investmentDocument($investmentData));
        return $investment;
    }

    public function populate_defaults_for_user($userId){
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

    

    public function fetch($categoryId){
        return Category::where([
            ['status','!=','5'],
            ['_id',$categoryId]
        ])->first();
    }
}

