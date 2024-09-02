<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function userLoginSection(Request $request){
        $viewData = [
            'section' => 'Login',
        ];
        return view('client.authentication.login',$viewData);
    }

    public function processLogin(Request $request){

        $email = $request->post('email');
        $password = $request->post('password');

        if(Auth::attempt(['email' => $email, 'password' => $password, 'status' => '1'])){
            return redirect()->route('dashboard.index'); 
        }else{
            return redirect()->route('landing.user_login_section')->withInput();
            $request->session()->flash('error', 'Login failed. Please check and try again!');
        }
    }
}
