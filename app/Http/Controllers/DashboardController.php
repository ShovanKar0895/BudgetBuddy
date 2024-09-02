<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardSection(Request $request){

        $user = Auth::user();
        $user->full_name = $user->first_name.' '.$user->last_name;

        $viewData = [
            'section' => 'Dashboard',
            'user_details' => $user,
        ];
        return view('client.dashboard.index',$viewData);
    }

    public function logout(Request $request){

        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $request->session()->flash('success', 'You have logged out succesfully!');
        return redirect()->route('landing.user_login_section');
    }
}
