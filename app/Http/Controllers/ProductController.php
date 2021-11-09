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

        $validateVar = $request->validate ([
            'min_price' => 'numeric|gte:0',
            'max_price' => 'numeric|gt:min_price',
        ]);

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
        $validateVar = $request->validate ([
            'product_title' => 'required|min:6|max:200|regex:/^[a-zA-Z]+$/u',
            'product_excerpt' => 'required|min:6|max:400|regex:/^[a-zA-Z]+$/u',
            'product_description' => 'required|min:6|max:1500|regex:/^[a-zA-Z]+$/u',
            'product_price' => 'required|numeric|gte:0',
            'product_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'product_category_id' => 'required|numeric'

          ]);
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
        $validateVar = $request->validate ([
            'product_title' => 'required|min:6|max:200|regex:/^[a-zA-Z]+$/u',
            'product_excerpt' => 'required|min:6|max:400|regex:/^[a-zA-Z]+$/u',
            'product_description' => 'required|min:6|max:1500|regex:/^[a-zA-Z]+$/u',
            'product_price' => 'required|numeric|gte:0',
            'product_image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'product_category_id' => 'required|numeric'

          ]);
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
