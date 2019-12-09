<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
        ];
        $this->validate($request, $rules);
        if(Category::create($request->all())) {
            return redirect('/admin/categories')->withStatus('Category successfully created.');
        } else {
            return redirect('/admin/categories/create')->withStatus('Something wrong.');
        }
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|min:5',
        ];
        $this->validate($request, $rules);
        if(Category::update($request->all())) {
            return redirect('/admin/categories')->withStatus('Category successfully updated.');
        } else {
            return redirect('/admin/categories/'. $category->id .'/edit')->withStatus('Something wrong.');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('/admin/categories')->withStatus('Category successfully created.');
    }
}
