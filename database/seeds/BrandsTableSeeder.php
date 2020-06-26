<?php

use App\Brand;
use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/brands.json');
        $brands = json_decode($getJson);

        foreach ($brands as $singleBrand){
            Cloudder::upload(storage_path('images/'.$singleBrand->image),null,['folder'=>'LBDS-Online/brands']);
            $image = Cloudder::getResult();
            Cloudder::upload(storage_path('images/'.$singleBrand->banner),null,['folder'=>'LBDS-Online/brands/banner']);
            $banner = Cloudder::getResult();
            $brand = new Brand();
            $brand->name = $singleBrand->name;
            $brand->image = $image['secure_url'];
            $brand->banner = $banner['secure_url'];
            $brand->save();
        }
    }
}
