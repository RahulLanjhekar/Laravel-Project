<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(){
        return view('tasks.index',['tasks'=>Task::sortable()->paginate(4)]);
    }

    public function create(){
        return view('tasks.create'); 
    }

    public function store(Request $request){
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required'
        ]);

        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        $task->save();

        return back()->withSuccess('Product Created !!');
    }

    public function edit($id){

        $task = Task::where('id',$id)->first();
        
        return view('tasks.edit', ['task' => $task]);
    }

    public function delete($id){

        $task = Task::where('id',$id)->first();

        $task->delete();
        return back()->withSuccess('Product Deleted !!');
    }

    public function show($id){

        $task = Task::where('id',$id)->first();

        return view('tasks.show', ['task' => $task]);
    }

    public function update(Request $request, $id){
        
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required'
        ]);

        $task = Task::where('id',$id)->first();

        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;

        $task->save();

        return back()->withSuccess('Product Updated !!');
    }

    public function search(Request $request){

        $search = $request->search;

        $tasks = Task::sortable()->where(function($query) use ($search){

            $query->where('title','like',"%$search%")
            ->orWhere('description','like',"%%$search");

        })->paginate(4)->all();

        return view('tasks.index',compact('tasks','search'));
    }
}
