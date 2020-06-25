<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Brand $brand
     * @return Brand[]|Collection
     */
    public function index(Brand $brand)
    {
        return $brand->all()->load('products');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'banner' => 'required',
            'image' => 'required',
        ]);

        $requestedBrand = $request->all();

        Cloudder::upload($requestedBrand['banner']->getRealPath(),null,['folder'=>'LBDS/brands/banner']);
        $banner = Cloudder::getResult();
        Cloudder::upload($requestedBrand['image']->getRealPath(),null,['folder'=>'LBDS/brands']);
        $image = Cloudder::getResult();

        $brand = new Brand();
        $brand->name = $requestedBrand['name'];
        $brand->image = $image['secure_url'];
        $brand->banner = $banner['secure_url'];
        $brand->description = $requestedBrand['description'];
        $brand->save();

        return response()->json($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param Brand $brand
     * @param $id
     * @return Brand[]|Collection
     */
    public function show(Brand $brand, $id)
    {
        return $brand->findOrFail($id)->load('products');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }


    public function delete($id, Brand $brand) {
        $currentBrand = $brand->findOrFail($id);
         $currentBrand->delete();

         return response()->json(['msg'=> 'Suppression effectué avec succès ! 😇']);
    }
}
