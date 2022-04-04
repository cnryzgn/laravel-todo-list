<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todoData = Todo::get();

        return view('layouts.app', ['todoData' => $todoData]);
    }

    public function store(Request $request)
    {
        $this->validate($request, ['todoItem' => 'required']);

        Todo::create(['todoItem' => $request->todoItem]);

        return back();
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return back();
    }

    public function update(Request $request, $id)
    {
        Todo::where('id', $id)->update(['todoItem' => $request->todoItem]);
        
        return back();
    }
}
