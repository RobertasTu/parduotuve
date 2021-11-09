<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use PDF;
use App\Shop;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::sortable()->paginate(10);
        $shops = Shop::all();

        return view ( 'category.index', ['categories'=>$categories, 'shops'=>$shops] );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shops = Shop::all();
        return view('category.create', ['shops'=>$shops]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $validateVar = $request->validate ([
            'category_title' => 'required|unique:categories,title|min:6|max:200|regex:/^[a-zA-Z]+$/u',
            'category_description' => 'required|min:6|max:1500|regex:/^[a-zA-Z]+$/u',
            'category_shop_id' => 'required|numeric'
        ]);
        $category->title=$request->category_title;
        $category->description=$request->category_description;
        $category->shop_id=$request->category_shop_id;

        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       return view('category.show', ['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
       $shops = Shop::all();
       return view("category.edit",["category"=>$category, "shops"=>$shops]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validateVar = $request->validate ([
            'category_title' => 'required|unique:categories,title|min:6|max:200|regex:/^[a-zA-Z]+$/u',
            'category_description' => 'required|min:6|max:1500|regex:/^[a-zA-Z]+$/u',
            'category_shop_id' => 'required|numeric'
        ]);
        $category->title=$request->category_title;
        $category->description=$request->category_description;
        $category->shop_id=$request->category_shop_id;

        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route("category.index");
    }
}
