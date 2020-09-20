<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Tasks;
use Auth;

class HomeController extends Controller
{
    public static $data;

    public function index (Request $request)
    {
    	$version = env('APP_VERSION', time());
        $user    = Auth::user();

        $user->role = DB::table('roles')
                    ->where('id', $user->role)
                    ->first();

        $user->role->stacks = json_decode($user->role->stacks);

        if ( $user->role->access === 'fullstack' ) {
            $tasks = Tasks::all();
        }else{
            $tasks = Tasks::whereJsonContains('stacks', $user->role->stacks)->get();
        }

        foreach ($tasks as &$task) {
            $task->projects = json_decode($task->projects);
            $task->stacks = json_decode($task->stacks);
    	}

    	$data = [
            'divide' => $request->get('divide'),
    		'tasks'  => $tasks,
            'user'   => [
                'fullname' => 'Богдан Пирожок',
                'name'     => $user->name,
                'role'     => $user->role
            ]
    	];

    	return view('cabinet.home', compact('data', 'version'));
    }
}
