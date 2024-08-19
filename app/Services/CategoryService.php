<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function count(): int
    {
        return Category::where('status','!=','5')->count();
    }

    public function list(array $conditions): Collection
    {
        $searchTerm = $conditions['search_by'];

        return Category::where('status','!=','5')
            ->where(function($query) use ($searchTerm){
                $query->where('name','like','%'.$searchTerm.'%');
           })->orderBy($conditions['ordering_column'],$conditions['ordering_column_by'])
           ->offset($conditions['offset'])
           ->limit($conditions['limit'])
           ->get();
    }

    public function update(array $updateData,$categoryId): int{

        $updateData['last_updated_time'] = time();
        $affectedUsers = Category::where('_id',$categoryId)->where('status','!=','5')->update($updateData);
        return $affectedUsers;
    }
}
