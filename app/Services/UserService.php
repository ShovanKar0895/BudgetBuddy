<?php

namespace App\Services;

use App\Models\User;
use Ramsey\Uuid\Type\Integer;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function userDocument(array $userData){

        return [
            'first_name' => $userData['first_name'] ?? null,
            'last_name' => $userData['last_name'] ?? null,
            'user_name' => $userData['user_name'] ?? null,
            'gender' => $userData['gender'] ?? null,
            'dob' => $userData['dob'] ?? null,
            'address' => $userData['address'] ?? null,
            'email' => $userData['email'] ?? null,
            'password' => $userData['password'] ?? null,
            'phone' => $userData['phone'] ?? null,
            'about' => $userData['about'] ?? null,
            'portfolio_url' => $userData['portfolio_url'] ?? null,
            'profile_picture' => $userData['profile_picture'] ?? null,
            'marital_status' => $userData['marital_status'] ?? null,
            'qualification' => $userData['qualification'] ?? null,
            'occupation' => $userData['occupation'] ?? null,
            'added_time' => time(),
            'last_updated_time' => $userData['last_updated_time'] ?? null,
            'status' => '1',
        ];
    }

    public function store(array $userData): User
    {
        $user = User::create($this->userDocument($userData));
        return $user;
    }
 
    public function update(array $userData,$userId): string
    {
        $userData['last_updated_time'] = time();
        $affectedUsers = User::where('_id',$userId)->where('status','!=','5')->update($userData);
        return $affectedUsers;
    }
}
