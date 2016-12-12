<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class CategoriesController extends Controller
{
    public function index(Category $category)
    {
    	return view('category', compact('category'));
    }
    public function admin_index(){
		$categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    public function admin_create(Request $request){
        if(!empty($request['_token']))
        {
            $category = new Category(['title' => $request->title, 'description' => $request->description, 'slug' => $this->create_slug($request->title)]);
            $category->save();
            return redirect()->action('CategoriesController@admin_index');
        }
        return view('admin.categories.create');
    }
    public function admin_edit($id, Request $request)
    {
        $category = Category::where('id', $id)->first();
        if(!empty($request['_token'])) {
            $category->title = $request->title;
            $category->description = $request->description;
            $category->updated_at = date('Y-m-d H:i:s');
            $category->save();
            return redirect()->action('CategoriesController@admin_index');
        }
        return view('admin.categories.edit', ['category' =>  $category]);
    }
    public function admin_delete($id){
        Category::where('id', $id)->delete();
        return redirect()->action('CategoriesController@admin_index');
    }

}
