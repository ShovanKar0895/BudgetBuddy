<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateContactRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdatePersonalInfoRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class AccountController extends Controller
{

    private UserService $userService;
 
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function myProfileSection(Request $request){

        $user = Auth::user();
        $user->full_name = $user->first_name.' '.$user->last_name;

        $viewData = [
            'section' => 'My Account',
            'user_details' => $user
        ];

        return view('client.account.profile',$viewData);
    }

    public function editProfileSection(Request $request){
        $user = Auth::user();
        $user->full_name = $user->first_name.' '.$user->last_name;

        $viewData = [
            'section' => 'Edit Account',
            'user_details' => $user
        ];

        return view('client.account.edit',$viewData);
    }

    public function updateProfilePersonalInfo(UpdatePersonalInfoRequest $request){
        
        $userId = Auth::id();
        $validatedData = $request->validated();
        $validatedData['dob'] = new UTCDateTime(strtotime($validatedData['dob'])*1000);

        $affectedUsers = $this->userService->update($validatedData,$userId);
        
        $request->session()->flash('success', 'Profile details succesfully updated!');
        return redirect()->route('profile.edit');
    }

    public function updateProfilePasswordDetails(UpdatePasswordRequest $request){

        $userId = Auth::id();
        $validatedData = $request->validated();
        $filteredData = [
            'password' => bcrypt($validatedData['new_password']),
        ];

        $affectedUsers = $this->userService->update($filteredData,$userId);
        
        $request->session()->flash('success', 'Profile details succesfully updated!');
        return redirect()->route('profile.edit');
    }

    public function updateProfileContactDetails(UpdateContactRequest $request){
        
        $userId = Auth::id();
        $validatedData = $request->validated();
        $filteredData = [
            'phone' => $validatedData['contact_number'],
            'email' => $validatedData['email'],
            'portfolio_url' => $validatedData['url'],
        ];

        $affectedUsers = $this->userService->update($filteredData,$userId);
        
        $request->session()->flash('success', 'Profile details succesfully updated!');
        return redirect()->route('profile.edit');
    }
}
