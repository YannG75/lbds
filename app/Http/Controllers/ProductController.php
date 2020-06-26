<?php

namespace App\Http\Controllers;

use App\Image;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

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
        $request->validate([
            'name' => 'required|unique:products',
            'color' => 'required',
            'image'=>'required|mimes:jpeg,jpg,png',
            'price'=>'required|numeric',
            'description'=>'required',
            'actif'=>'required|integer',
            'brand'=>'required',
            'brand_id'=>'required|integer',
            'images'=>'required',
        ]);


        $imageName = $request->image->getRealPath();
        Cloudder::upload($imageName, null, ['folder' => 'LBDS/products']);
        $productImage = Cloudder::getResult();

        $newProduct = new Product();
        $newProduct->name = $request->name;
        $newProduct->description = $request->description;
        $newProduct->price = $request->price;
        $newProduct->color = $request->color;
        $newProduct->brand = $request->brand;
        $newProduct->release_date = Carbon::now();
        $newProduct->actif = $request->actif;
        $newProduct->brand_id = $request->brand_id;
        $newProduct->image = $productImage['secure_url'];
        $newProduct->save();

        foreach ($request->images as $secondPicture){
            $imageSecond = $secondPicture->getRealPath();
            Cloudder::upload($imageSecond, null, ['folder' => 'LBDS/images']);
            $cloudinarySecondPicture = Cloudder::getResult();

            $secondaryPictures = new Image();
            $secondaryPictures->image = $cloudinarySecondPicture['secure_url'];
            $secondaryPictures->sneaker_id = $newProduct->id;
            $secondaryPictures->save();
        }
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
            $error = "Ce produit n'existe pas";
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

    public function delete($id, Product $product)
    {
        $currentProduct = $product->with('images')->findOrFail($id);
        foreach ($currentProduct['images'] as $image) {
            $extension = pathinfo($image['image']);
            $public_id = basename($image['image'], "." . $extension['extension']);
            Cloudder::delete("LBDS/images/" . $public_id);
            Image::where("sneaker_id","=",$image['product_id'])->delete();
        }

        $extension = pathinfo($currentProduct['image']);

        $public_id = basename($currentProduct['image'], "." . $extension['extension']);
        Cloudder::delete("LBDS/products/" . $public_id);

        $currentProduct->delete();

        return response()->json(['msg' => 'Suppression effectué avec succès ! 😇']);
    }
}
