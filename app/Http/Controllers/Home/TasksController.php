<?php

namespace App\Http\Controllers\Home;
use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Repositories\TasksRepository;

class TasksController extends HomeController
{

    public function create (TasksRepository $tasks)
    {
    	return response()->json([
		    'id' => $tasks->create()
		]);
    }

    public function edit (TasksRepository $tasks)
    {
    	return response()->json([
		    'done' => $tasks->edit()
		]);
    }

    public function delete (Request $request)
    {
    	return response()->json([
		    'done' => Tasks::where('id', $request->input('id'))->delete()
		]);
    }
}
