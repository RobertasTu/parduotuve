<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;
use PDF;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::sortable()->paginate(15);

        return view ('shop.index', ['shops'=>$shops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = new Shop;
        $validateVar = $request->validate ([
            'shop_title' => 'required|min:6|max:200|regex:/^[a-zA-Z]+$/u',
            'shop_description' => 'required|min:6|max:1500|regex:/^[a-zA-Z]+$/u',
            'shop_email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:shops,email',
            'shop_phone' => 'required|d|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12',
            'shop_country' => 'required|regex:/^[a-zA-Z]+$/u',
        ]);
        $shop->title = $request->shop_title;
        $shop->description = $request->shop_description;
        $shop->email = $request->shop_email;
        $shop->phone =$request->shop_phone;
        $shop->country = $request->shop_country;

        $shop->save();

        return redirect()->route("shop.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        return view ('shop.show', ['shop'=>$shop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop)
    {
        return view ('shop.edit', ['shop'=>$shop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        $validateVar = $request->validate ([
            'shop_title' => 'required|min:6|max:200|regex:/^[a-zA-Z]+$/u',
            'shop_description' => 'required|min:6|max:1500|regex:/^[a-zA-Z]+$/u',
            'shop_email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:shops,email',
            'shop_phone' => 'required|d|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12',
            'shop_country' => 'required|regex:/^[a-zA-Z]+$/u',
        ]);
        $shop->title = $request->shop_title;
        $shop->description = $request->shop_description;
        $shop->email = $request->shop_email;
        $shop->phone =$request->shop_phone;
        $shop->country = $request->shop_country;

        $shop->save();

        return redirect()->route("shop.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->route("shop.index");
    }
}
