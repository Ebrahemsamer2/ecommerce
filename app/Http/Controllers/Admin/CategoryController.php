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

        $fail = '';
        $success = '';

        if($category = Category::create($request->all())) {
            $success = '<tr id="cat'. $category->id .'"><td>'. $category->name .'</td>';
            $success .= '<td>'. $category->created_at->diffForHumans() .'</td>';
            $success .= '<td class="text-right">';
            $success .= '<a type="button" href="'.route("categories.edit",$category).'" rel="tooltip" class="btn btn-success btn-icon btn-sm " data-original-title="" title="">
                        <i class="now-ui-icons ui-2_settings-90"></i>
                      </a>';

            $success .= '<form class ="deletecategory" action="'.route("categories.destroy", $category).'" method="post" style="display:inline-block;">

                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type="hidden" name="id" value="'.$category->id.'">
                    <input type="submit" value="X" class="btn btn-danger btn-sm">';

            $success .= '</form>';
            $success .= '</td></tr>';

        }else {
            $fail = '<div class="alert alert-danger">';
            $fail .= 'Something wrong, Try again';
            $fail .= '</div>';
        }

        return response()->json(
            [
                'success' => $success,
                'fail' => $fail,
            ]
        );

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
        if($category->update($request->all())) {
            return redirect('/admin/categories')->withStatus('Category successfully updated.');
        } else {
            return redirect('/admin/categories/'. $category->id .'/edit')->withStatus('Something wrong.');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        $success = '<div class="alert alert-success">Category successfully deleted.</div>';
        return response()->json(['success' => $success]);
    }
}
