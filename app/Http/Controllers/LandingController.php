<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserForgotPasword;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    private UserService $investmentService;
 
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

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

    public function userForgotPasswordSection(Request $request){
        $viewData = [
            'section' => 'Forgot Password',
        ];
        return view('client.authentication.forgot_password',$viewData);
    }

    public function processUserForgotPassword(UserForgotPasword $request){
        
        $validatedData = $request->validated();

        $this->userService->generate_reset_password_for_user('email',$validatedData['email']);
    }
}
