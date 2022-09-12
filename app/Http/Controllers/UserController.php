<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Message;
use App\Models\Category;
use App\Models\Task;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerUserPost(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'digits:11', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login')->with('success','Registered Successfully. Please wait for approval from admin');
        //Auth::login($user);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginUserPost(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'password' => 'required',
        ]);

        $userCheck = User::where('email', $data['email']);

        $user = $userCheck->first();
        
        //password check
        $hashed = Hash::make($data['password']);
        $passCheck = Hash::check($data['password'], $user->password); //bool true or false
        if($passCheck !== true){
            return back()->with('error', 'You provided the wrong credentials');
        }

        //more checks
        if($user->status=='pending'){
            return back()->with('error', 'Please wait for approval from admin');
        }

        Auth::login($user);
        if($user->isAdmin){
            return redirect()->route('adminDashboard')->with('success', 'Logged In Successfully');
        }
        return redirect()->route('userDashboard')->with('success', 'Logged In Successfully');
            
        
    }

    public function logoutUser()
    {
        $user = Auth::user();
        Session::flush();
        Auth::logout($user);
        return redirect('/');
    }

    
    public function userDashboard()
    {
        $user = Auth::user();
        $tasks = $user->tasks;
        $recentTasks = $user->tasks()->orderBy('id', 'DESC')->paginate('5');

        $pendingTasks = $user->tasks()->where('status','pending')->get();
        $doneTasks = $user->tasks()->where('status','done')->get();
        $overDueTasks = $user->tasks()->where('status','overdue')->get();

        return view('userDashboard', \compact('tasks', 'recentTasks', 'pendingTasks', 'doneTasks', 'overDueTasks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function userSendMessage()
    {
        $admins = User::where('isAdmin',true)->get();
        return view('userSendMessage', compact('admins'));
    }
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver' => ['required'],
            'content' => ['required', 'string', 'min:2', 'max:255'],
        ]);
        $data = $request->all();
        
        Message::create([
            'sender_id' => $data['sender_id'],
            'content' => $data['content'],
            'receiver_id' => $data['receiver'],
        ]);

        return back()->with('success', 'Message Sent Successfully');
    }

    public function userMessages(){
        $user = auth()->user();
        $sent_messages = $user->sent_messages;
        return view('userMessages', \compact('sent_messages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userTask()
    {
        $user = Auth::user();
        $tasks = $user->tasks;
        return view('userTasks', \compact('tasks'));
    }

    public function userAddTask()
    {
        $categories = Category::where('status', 'active')->get();
        return view('userAddTask', compact('categories'));
    }

    public function userAddTaskPost(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'category' => ['required', 'string'],
            'deadline' => ['required'],
            'status' => ['required', 'string'],
        ]);
        $data = $request->all();
        
        
        Task::create([
            'title' => $data['title'],
            'category_id' => $data['category'],
            'deadline_date' => $data['deadline'],
            'created_by' => Auth::user()->id,
            'status' => $data['status'],
        ]);

        return back()->with('success', 'Task Created Successfully');
    }

    public function updateTaskStatus($action, $task_id)
    {
        $task = Task::findOrFail($task_id);
        if($action=='done'){
            $task->update(['status'=>'done']);
            return back()->with('success', 'Task Updated Successfully');
        }

        if($action=='pending'){
            $task->update(['status'=>'pending']);
            return back()->with('success', 'Task Updated Successfully');
        }

        if($action=='overdue'){
            $task->update(['status'=>'overdue']);
            return back()->with('success', 'Task Updated Successfully');
        }
    }

    public function deleteTask($task_id)
    {
        $task = Task::findOrFail($task_id);
        $task->delete();
        return back()->with('success', 'Task Removed Successfully');
    }
    

   
}
