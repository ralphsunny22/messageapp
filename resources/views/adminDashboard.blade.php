@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Welcome to Admin</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}

                    <div class="d-flex justify-content-center">
                        <a href="{{ route('users') }}">
                        <div class="users p-3 bg-danger m-1 text-white rounded-3">
                            <h6>Users</h6>
                            <h5>{{ count($users) }}</h5>
                        </div></a>

                        <a href="{{ route('messages') }}">
                        <div class="messages p-3 bg-success m-1 text-white rounded-3">
                            <h6>Messages</h6>
                            <h5>{{ count($messages) }}</h5>
                        </div></a>

                        <a href="{{ route('userTask') }}">
                            <div class="users p-3 bg-secondary m-1 text-white rounded-3">
                                <h6>Total Tasks</h6>
                                <h5>{{ count($tasks) }}</h5>
                            </div></a>
    
                            
                            <div class="messages p-3 bg-primary m-1 text-white rounded-3">
                                <h6>Pending Tasks</h6>
                                <h5>{{ count($pendingTasks) }}</h5>
                            </div>
    
                            <div class="messages p-3 bg-success m-1 text-white rounded-3">
                                <h6>Done Tasks</h6>
                                <h5>{{ count($doneTasks) }}</h5>
                            </div>
                        
                            <div class="messages p-3 bg-danger m-1 text-white rounded-3">
                                <h6>OverDue Tasks</h6>
                                <h5>{{ count($overDueTasks) }}</h5>
                            </div>

                    </div>

                    <div class="mt-5 text-center">
                        <h4>5 Most Recent Tasks</h4>
                    </div>
                    <table class="table table-hover table-bordered">
                        
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Deadline</th>
                                <th>Status</th>
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTableBody">
                            @if (count($tasks) > 0)

                            @foreach ($recentTasks as $key=>$task)
                            <tr class="featured_outer">
                                <td>{{ ++$key }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->category->title }}</td>
                                <td>{{ $task->deadline_date }}</td>
                                
                                <td class="status">
                                    @if ($task->status == 'pending')
                                        <span class="text-primary">Pending</span>
                                    @elseif($task->status == 'done')
                                        <span class="text-success">Done</span>
                                    @elseif($task->status == 'overdue')
                                        <span class="text-danger">Over Due</span>
                                    @endif
                                </td>
                                

                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle mb-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          Update Status
                                        </button>
                                        <ul class="dropdown-menu">
                                            @if ($task->status == 'pending')
                                                <li><a class="dropdown-item" href="{{ route('updateTaskStatus', ['done', $task->id]) }}">Done</a></li>
                                                <li><a class="dropdown-item" href="{{ route('updateTaskStatus', ['overdue', $task->id]) }}">Over Due</a></li>

                                            @elseif ($task->status == 'done')
                                                <li><a class="dropdown-item" href="{{ route('updateTaskStatus', ['pending', $task->id]) }}">Pending</a></li>
                                                <li><a class="dropdown-item" href="{{ route('updateTaskStatus', ['overdue', $task->id]) }}">Over Due</a></li>

                                            @elseif ($task->status == 'overdue')
                                                <li><a class="dropdown-item" href="{{ route('updateTaskStatus', ['done', $task->id]) }}">Done</a></li>
                                                <li><a class="dropdown-item" href="{{ route('updateTaskStatus', ['pending', $task->id]) }}">Pending</a></li>
                                            @endif
                                          

                                        </ul>
                                      </div>
                                      <a href="{{ route('deleteTask', $task->id) }}" class="text-white btn btn-danger btn-sm">Delete</a>
                                </td>
                                
                                
                                
                                
                            </tr>
                            @endforeach
                            
                            @else
                                <tr class="text-center"><td colspan="5">No data available</td></tr>
                            @endif
                            
                        </tbody>
                    </table>

                    <div class="mt-5 text-center">
                        <h4>5 Most Recent Users</h4>
                    </div>
                    <table class="table table-hover table-bordered">
                        <select name="filter" id="filter" class="form-control mb-3" style="width: 20%">
                            <option value="">Filter</option>
                            <option value="Pending">Pending</option>
                            <option value="Active">Active</option>
                        </select>
                        <thead>
                            <tr>
                                <th>S/No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Status</th>
                                <th>Date Joined</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="myTableBody">
                            @if (count($users) > 0)

                            @foreach ($recentUsers as $key=>$user)
                            <tr class="featured_outer">
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td class="status">{!! $user->status == 'pending' ? '<span class="text-danger">Pending</span>' : '<span class="text-success">Active</span>' !!}</td>
                                <td>{{ $user->created_at }}</td>

                                @if ($user->status == 'pending')
                                    <td><a href="{{ route('updateUserStatus', ['activate', $user->id]) }}" class="btn btn-success btn-sm">Activate</a></td>
                                @else
                                    <td><a href="{{ route('updateUserStatus', ['deactivate', $user->id]) }}" class="btn btn-danger btn-sm">Deactivate</a></td>
                                @endif
                                
                            </tr>
                            @endforeach
                            
                            @else
                                <tr class="text-center"><td colspan="5">No data available</td></tr>
                            @endif
                            
                        </tbody>
                    </table>

                    
                </div>
            </div>
        </div>
    </div>

    

</div>
@endsection
