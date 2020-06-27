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

        Cloudder::upload($requestedBrand['banner']->getRealPath(), null, ['folder' => 'LBDS/brands/banner']);
        $banner = Cloudder::getResult();
        Cloudder::upload($requestedBrand['image']->getRealPath(), null, ['folder' => 'LBDS/brands']);
        $image = Cloudder::getResult();

        $brand = new Brand();
        $brand->name = $requestedBrand['name'];
        $brand->image = $image['secure_url'];
        $brand->banner = $banner['secure_url'];
        if ($requestedBrand['description'] !== null)
            $brand->description = $requestedBrand['description'];
        $brand->save();

        return response()->json(['msg' => 'Suppression effectué avec succès ! 😇']);
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
     * @return JsonResponse
     */
    public function update(Request $request, Brand $brand, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $updateBrand =$brand->findOrFail($id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $requestedBrand = $request->all();
        $currentBrand = $brand->findOrFail($id);
        if(isset($requestedBrand['image'])){
            $extension = pathinfo($currentBrand->image);
            $public_id = basename($currentBrand->image, "." . $extension['extension']);
            Cloudder::delete("LBDS/brands/" . $public_id);

            $imageName = $requestedBrand['image']->getRealPath();
            Cloudder::upload($imageName, null, ['folder' => 'LBDS/brands']);
            $newImage = Cloudder::getResult();

            $updateBrand = $brand->findOrFail($id)->update([
                'image' => $newImage['secure_url'],
            ]);
        }
        if(isset($requestedBrand['banner'])){
            $extension = pathinfo($currentBrand->banner);
            $public_id = basename($currentBrand->banner, "." . $extension['extension']);
            Cloudder::delete("LBDS/brands/banner/".$public_id);

            $bannerName = $requestedBrand['banner']->getRealPath();
            Cloudder::upload($bannerName, null, ['folder' => 'LBDS/brands/banner']);
            $newBanner = Cloudder::getResult();

            $updateBrand =$brand->findOrFail($id)->update([
                'banner' => $newBanner['secure_url'],
            ]);
        }

        return response()->json(['msg' => 'modification effectué avec succès ! 😇']);
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


    public function delete($id, Brand $brand)
    {
        $currentBrand = $brand->findOrFail($id);

        $extension = pathinfo($currentBrand->image);
        $extension_banner = pathinfo($currentBrand->banner);

        $public_id = basename($currentBrand->image, "." . $extension['extension']);
        Cloudder::delete("LBDS/brands/" . $public_id);

        $public_id_banner = basename($currentBrand->banner, "." . $extension_banner['extension']);
        Cloudder::delete("LBDS/brands/banner/" . $public_id_banner);

        $currentBrand->delete();

        return response()->json(['msg' => 'Suppression effectué avec succès ! 😇']);
    }

}
