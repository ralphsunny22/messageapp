@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @include('partials.message')

                <div class="card-header">
                    <a href="{{ route('userAddTask') }}" class="text-white btn btn-primary">Add Task</a>
                </div>

                <div class="card-body">
                    
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

                            @foreach ($tasks as $key=>$task)
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


