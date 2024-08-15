<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePersonalInfoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function myProfileSection(Request $request){

        $user = Auth::user();
        $user->full_name = $user->first_name.' '.$user->last_name;

        $viewData = [
            'section' => 'My Account',
            'user_details' => $user
        ];

        return view('client.my_profile',$viewData);
    }

    public function editProfileSection(Request $request){
        $user = Auth::user();
        $user->full_name = $user->first_name.' '.$user->last_name;

        $viewData = [
            'section' => 'Edit Account',
            'user_details' => $user
        ];

        return view('client.edit_profile',$viewData);
    }

    public function updateProfilePersonalInfo(UpdatePersonalInfoRequest $request){
        
        $validatedData = $request->validated();
        dd($validatedData);
    }
}
