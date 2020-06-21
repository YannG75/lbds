<?php

use App\Product;
use Illuminate\Database\Seeder;
use JD\Cloudder\Facades\Cloudder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/sneakers.json');
        $sneakers = json_decode($getJson);

        foreach ($sneakers as $sneaker){
            Cloudder::upload(storage_path('images/'.$sneaker->image),null,['folder'=>'LBDS/products']);
            $image = Cloudder::getResult();
            $product = new Product();
            $product->name = $sneaker->name;
            $product->brand = $sneaker->brand;
            $product->color = $sneaker->color;
            $product->description = $sneaker->description;
            $product->price = $sneaker->price;
            $product->image = $image['secure_url'];
            $product->brand_id = $sneaker->brand_id;
            $product->release_date = $sneaker->release_date;
            $product->save();
        }
    }
}
