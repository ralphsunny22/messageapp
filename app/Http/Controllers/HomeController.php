<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Category;
use App\Models\Task;

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
        $recentUsers = User::orderBy('id', 'DESC')->paginate('5');

        $messages = auth()->user()->received_messages;

        $tasks = Task::all();
        $recentTasks = Task::orderBy('id', 'DESC')->paginate('5');

        $pendingTasks = Task::where('status','pending')->get();
        $doneTasks = Task::where('status','done')->get();
        $overDueTasks = Task::where('status','overdue')->get();

        return view('adminDashboard', \compact('users', 'recentUsers', 'messages', 'tasks', 'recentTasks', 'pendingTasks', 'doneTasks', 'overDueTasks'));
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

    public function adminCategory(){
        $categories = Category::all();
        return view('adminCategory', \compact('categories'));
    }

    public function adminAddCategory(){
        $categories = Category::all();
        return view('adminAddCategory');
    }

    public function adminAddCategoryPost(Request $request){
        $request->validate([
            'title' => ['required'],
            'status' => ['required', 'string'],
        ]);
        $data = $request->all();
        
        Category::create([
            'title' => $data['title'],
            'status' => $data['status'] == 'active' ? 'active' : 'pending',
        ]);

        return back()->with('success', 'Category Added Successfully');
    }

    public function updateCategoryStatus($action, $category_id)
    {
        $category = Category::findOrFail($category_id);
        if($action=='activate'){
            $category->update(['status'=>'active']);
            return back()->with('success', 'Category Activated Successfully');
        }

        if($action=='deactivate'){
            $category->update(['status'=>'pending']);
            return back()->with('success', 'Category Deactivated Successfully');
        }
    }

    public function adminDeleteCategory($category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->tasks()->delete();
        $category->delete();
        return back()->with('success', 'Category Removed Successfully');
    }

    public function adminTask()
    {
        $tasks = Task::all();
        return view('adminTask', compact('tasks'));
    }

}
