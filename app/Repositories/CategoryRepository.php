<?php
namespace App\Repositories;

use App\Http\Requests\CategoriesStore;
use App\Models\Categories;
use Illuminate\Support\Str;

class CategoryRepository
{
	public function categoryCreate ()
	{
		$request = new CategoriesStore();
		$slug = Str::slug($request->all()['title'], '-');
		return Categories::insertGetId([
			'title' => $request->all()['title'],
			'slug'  => $slug
		]);

	}

	public function categoryEdit ()
	{
		$request = new CategoriesStore();
		$slug = Str::slug($request->all()['title'], '-');
		return Categories::where('id', $request->all()['id'])->update([
			'title' => $request->all()['title'],
			'slug'  => $slug
		]);
	}
}