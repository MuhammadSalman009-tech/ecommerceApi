<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;


class ProductController extends Controller
{
    public function __construct(){
        $this->middleware("auth:sanctum")->except("index","create");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductCollection(Product::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product=new Product;
        $product->name=$request->name;
        $product->detail=$request->description;
        $product->price=$request->price;
        $product->discount=$request->discount;
        $product->stock=$request->stock;
        $product->save();
        return response([
            "data"=>new ProductResource($product)
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if($this->checkProductUser($product)){
            return [
                "error"=>"product not belongs to user"
            ];
        }
        $product["detail"]=$request->description;
        unset($request["description"]);
        $product->update($request->all());
        return response([
            "data"=>new ProductResource($product)
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($this->checkProductUser($product)){
            return [
                "error"=>"product not belongs to user"
            ];
        }
        $product->delete();
        return response([
            "data"=>null
        ],204);
    }
    public function checkProductUser($product){
        if(auth()->user()->id!==$product->user_id){
            return true;
        }
    }
}
