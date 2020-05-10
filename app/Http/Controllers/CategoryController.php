<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index')->with('categories', Category::all());

    }


    public function create()
    {
       return view('categories.create');
    }


    public function store(CreateCategoryRequest $request)
    {

        Category::create([
            'name'=>$request->name
        ]);

        session()->flash('success','Category created successfully');

        return redirect(route('categories.index'));
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('categories.create')->with('category' , $category);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
       $category->update([
           'name'=>$request->name
       ]);
        session()->flash('success','Category Updated successfully');
        return redirect(route('categories.index'));
    }


    public function destroy(Category $category)
    {
        if($category->posts->count() >0){
            session()->flash('error','Category can not be deleted, because it has some posts');
            return redirect()->back();
        }


       $category->delete();

        session()->flash('success','Category deleted successfully');

        return redirect(route('categories.index'));
    }
}
