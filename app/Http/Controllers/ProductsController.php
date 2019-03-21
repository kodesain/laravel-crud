<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Products;
use App\Categories;

class ProductsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = DB::table('products')->leftJoin('categories', 'products.cat_id', '=', 'categories.cat_id')->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Categories::orderBy('cat_name')->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->hasFile('prod_image')) {
            $validatedData = $request->validate([
                'prod_name' => 'required|max:200',
                'prod_description' => 'required|max:200',
                'prod_price' => 'required|numeric',
                'prod_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'cat_id' => 'required|integer'
            ]);

            $validatedData['prod_image'] = $request->file('prod_image')->store('public/files');
        } else {
            $validatedData = $request->validate([
                'prod_name' => 'required|max:200',
                'prod_description' => 'required|max:200',
                'prod_price' => 'required|numeric',
                'prod_image' => 'nullable',
                'cat_id' => 'required|integer'
            ]);
        }

        Products::create($validatedData);

        return redirect('products')->with('success', 'Product has been successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $product = Products::findOrFail($id);
        $categories = Categories::orderBy('cat_name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if ($request->hasFile('prod_image')) {
            $validatedData = $request->validate([
                'prod_name' => 'required|max:200',
                'prod_description' => 'required|max:200',
                'prod_price' => 'required|numeric',
                'prod_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'cat_id' => 'required|integer'
            ]);

            $validatedData['prod_image'] = $request->file('prod_image')->store('public/files');
        } else {
            $validatedData = $request->validate([
                'prod_name' => 'required|max:200',
                'prod_description' => 'required|max:200',
                'prod_price' => 'required|numeric',
                'prod_image' => 'nullable',
                'cat_id' => 'required|integer'
            ]);
        }

        Products::where('prod_id', $id)->update($validatedData);

        return redirect('products')->with('success', 'Product has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect('products')->with('success', 'Product has been successfully deleted');
    }

}
