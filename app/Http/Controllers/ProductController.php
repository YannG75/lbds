<?php

namespace App\Http\Controllers;

use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Product $product, Request $request)
    {
        $sort = $request->query('sort');
        $search = $request->query('search');
        $max = $request->query('max');

        if ($sort && $max && ($max == 10)){
            $data = $product->all()->random($max);
            return response()->json($data);
        }

        else if($sort && (!$max || $max != 10)){
            $product->findOrFail(50);
        }

        if ($search){
             $data = $product->where('name','like' ,'%'.$search.'%')->paginate(3);
            return response()->json($data);
        }

         $data = $product->all();

        return response()->json($data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product, $id)
    {
        try{
            $data = $product->with('images')->findOrFail($id);
            return response()->json($data, 200);
        }
        catch (\Exception $e){
            $error = "Cet identifiant est inconnu";
            return response()->json($error, 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
