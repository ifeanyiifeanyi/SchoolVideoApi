<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categories::latest()->get();
        return view('admin.Category.index', ['category_create' => true, 'categories' => $category]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'category' => 'required|string|unique:categories',
            'description' => 'required|string',
        ]);

        $category = new Categories();
        $category->category = $request->category;
        $category->description = $request->description;
        $category->save();
        $notification = [
            'message'   => 'Category Created!',
            'alert-type' => 'success'
        ];
        return redirect()->route('categories')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.Category.index', ['category' => $category, 'category_create' => false]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);
        $category->category = $request->category;
        $category->description = $request->description;
        $category->save();
        $notification = [
            'message'   => 'Category Updated!',
            'alert-type' => 'success'
        ];
        return redirect()->route('categories')->with($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categories::findOrFail($id)->delete();
        $notification = [
            'message'   => 'Category deleted!',
            'alert-type' => 'success'
        ];
        return redirect()->route('categories')->with($notification);
    }
}
