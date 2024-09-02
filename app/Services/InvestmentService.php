<?php

namespace App\Services;

use App\Models\Investment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

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
            'maturity_date' => $investmentData['maturity_date'] ? new UTCDateTime(strtotime($investmentData['maturity_date']) * 1000) : null,
            'frequency' => $investmentData['frequency'] ?? null,
            'commitment_date' => $investmentData['commitment_date'] ? new UTCDateTime(strtotime($investmentData['commitment_date']) * 1000) : null,
            'category' => $investmentData['category'] ?? null,
            'note' => $investmentData['note'] ?? null,
            'added_time' => new UTCDateTime(time()*1000),
            'last_updated_time' => $investmentData['last_updated_time'] ?? null,
            'status' => '1',
        ];
    }

    public function store(array $investmentData): Investment{
        $investment = Investment::create($this->investmentDocument($investmentData));
        return $investment;
    }


    public function count($conditions): int
    {
        $searchTerm = $conditions['search_by'];

        return Investment::where([
            ['status', '!=', '5'],
            ['user_id',$conditions['user_id']]
            ])->where(function ($query) use ($searchTerm) {
                $query->where('type', 'like', '%' . $searchTerm . '%')
                ->orWhere('institution', 'like', '%' . $searchTerm . '%')
                ->orWhere('note', 'like', '%' . $searchTerm . '%');
            })
            ->count();
    }

    public function list(array $conditions): Collection
    {
        $searchTerm = $conditions['search_by'];

        return Investment::where([
            ['status', '!=', '5'],
            ['user_id',$conditions['user_id']]
            ])->where(function ($query) use ($searchTerm) {
                $query->where('type', 'like', '%' . $searchTerm . '%')
                ->orWhere('institution', 'like', '%' . $searchTerm . '%')
                ->orWhere('note', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy($conditions['ordering_column'], $conditions['ordering_column_by'])
            ->offset($conditions['offset'])
            ->limit($conditions['limit'])
            ->get();
    }

    public function update(array $updateData, $categoryId): int
    {
        $updateData['last_updated_time'] = new UTCDateTime(time()*1000);
        
        // Ensure $categoryId is an ObjectId if necessary
        if (!$categoryId instanceof ObjectId) {
            $categoryId = new ObjectId($categoryId);
        }

        $affectedUsers = Investment::where('_id', $categoryId)
            ->where('status', '!=', '5')
            ->update($updateData);

        return $affectedUsers;
    }

    

    public function fetch($categoryId){
        return Investment::where([
            ['status','!=','5'],
            ['_id',$categoryId]
        ])->first();
    }
    
}

