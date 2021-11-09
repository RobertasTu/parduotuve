<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use PDF;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::sortable()->paginate(20);
        $categories = Category::all();

        $filterCategories = $products;

        $filterByCategory = $request->filterByCategory;

        $min_price = $request->min_price;
        $max_price = $request->max_price;


        if(!$filterByCategory || $filterByCategory == 'all' && !$min_price && !$max_price) {
            $products = Product::sortable()->paginate(20);
        }
        elseif (!$min_price && !$max_price && $filterByCategory ) {
            $filterByCategory = $request->filterByCategory;
            $products = Product::sortable()->where('category_id', $filterByCategory)->paginate(20);
        }

        elseif (!$filterByCategory || $filterByCategory == 'all' && $min_price && $max_price ) {
            $min_price = $request->min_price;
            $max_price = $request->max_price;
            $products = Product::sortable()->whereBetween('price', [$min_price, $max_price])->paginate(20);

        }

        elseif ($filterByCategory && $min_price && $max_price ) {
            $filterByCategory = $request->filterByCategory;
            $min_price = $request->min_price;
            $max_price = $request->max_price;

            $products = Product::sortable()->where('category_id', $filterByCategory)->whereBetween('price', [$min_price, $max_price])->paginate(20);



        }

        return view ('product.index', ['products'=>$products, 'categories'=>$categories, 'filterByCategory'=>$filterByCategory, 'filterCategories'=>$filterCategories]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;
        $product->title=$request->product_title;
        $product->excerpt=$request->product_excerpt;
        $product->description=$request->product_description;
        $product->price=$request->product_price;
        // $product->image=$request->product_image;
        $product->category_id=$request->product_category_id;

        if($request->has('product_image')) {
            $imageName = time().'.'.$request->product_image->extension();
           $product->image =  time().'.'.$request->product_image->extension();
           $request->product_image->move(public_path('images'), $imageName );
           } else {
           $product->image = '/images/placeholder.png';
           }

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', ['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {   $categories=Category::all();
        return view('product.edit', ['product'=>$product, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->title=$request->product_title;
        $product->excerpt=$request->product_excerpt;
        $product->description=$request->product_description;
        $product->price=$request->product_price;
        // $product->image=$request->product_image;
        $product->category_id=$request->product_category_id;

        if($request->has('product_image')) {
            $imageName = time().'.'.$request->product_image->extension();
           $product->image =  time().'.'.$request->product_image->extension();
           $request->product_image->move(public_path('images'), $imageName );
           } else {
           $product->image = '/images/placeholder.png';
           }

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
