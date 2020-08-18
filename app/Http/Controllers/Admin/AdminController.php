<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Auth;

class AdminController extends Controller
{
    public static $data;

    public function index (Request $request)
    {
    	$user = Auth::user();

    	$data = [
    		'categories' => Categories::all(),
    		'blogs' => [],
            'divide' => $request->get('divide'),
    		'user' => [
    			'fullname' => 'Roman',
                'position' => 'user',
    			'name'     => $user->name,
    			'role'     => $user->role,
    			'email'    => $user->email,
    			'updated_at' => $user->updated_at,
    			'avatar'   => $user->avatar
    		],
            'questions' => [],
            'followers' => []
    	];

    	return view('cabinet.editor', compact('data'));
    }
}
