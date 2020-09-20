<?php
namespace App\Repositories;

use App\Http\Requests\TasksStore;
use App\Models\Tasks;
use Illuminate\Support\Str;

class TasksRepository
{
	public function create ()
	{
		$request = new TasksStore();
		$slug = Str::slug($request->input('title'), '-');

		return Tasks::insertGetId([
			'title' => $request->input('title'),
			'slug'  => $slug
		]);

	}

	public function edit ()
	{
		$request = new TasksStore();
		$slug = Str::slug($request->input('title'), '-');

		return Tasks::where('id', $request->all()['id'])->update([
			'title' => $request->input('title'),
			'slug'  => $slug
		]);
	}
}
