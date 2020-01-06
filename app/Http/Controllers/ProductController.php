<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Product;
use App\Addon;
use App\Favorite;
use Illuminate\Http\Response;
use Auth;

class ProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();
        if (Auth::check() == true && User::findOrFail(Auth::id())->favorites()->count() > 0) {
            $favorites = User::findOrFail(Auth::id())->favorites()->get();
        } else {
            $favorites = null;
        }

        return view('home', compact('products', 'favorites'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($name, $id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    /**
     * Favorite the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function favorite($id)
    {
        $product = Product::findOrFail($id);
        $favorite = new Favorite;

        $favorite->product_id = $product->id;
        $favorite->user_id = Auth::id();

        $favorite->save();

        return back();
    }

    /**
     * Unfavorite the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function unfavorite($id)
    {
        $product = Product::findOrFail($id);
        $favorite = Favorite::where('user_id', Auth::id())->where('product_id', $product->id)->firstorFail();
        $favorite->delete();

        return back();
    }
}
