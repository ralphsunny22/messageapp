<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function adminDashboard(){

        if(!auth()->user()->isAdmin){
            return back();
        }

        $users = User::where('isAdmin',false)->get();
        $messages = auth()->user()->received_messages;

        return view('adminDashboard', \compact('users', 'messages'));
    }

    public function users(){
        $users = User::where('isAdmin',false)->get();
        return view('users', \compact('users'));
    }

    public function updateUserStatus($action, $user_id)
    {
        $user = User::findOrFail($user_id);
        if($action=='activate'){
            $user->update(['status'=>'active']);
            return back()->with('success', 'User Activated Successfully');
        }

        if($action=='deactivate'){
            $user->update(['status'=>'pending']);
            return back()->with('success', 'User Deactivated Successfully');
        }
    }

    public function messages(){
        $admin = auth()->user();
        $received_messages = $admin->received_messages;
        return view('messages', \compact('received_messages'));
    }
}
