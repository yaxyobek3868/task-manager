<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController  extends Controller
{
    public function index(){
        return view('tasks.index');
    }

    public function create(){
        return view('tasks.create');
    }
    public function store(Request $request){
        return view('tasks.store');
    }
    public function show($id){
        return view('tasks.show');
    }
    public function edit($id){
        return view('tasks.edit');
    }

}
