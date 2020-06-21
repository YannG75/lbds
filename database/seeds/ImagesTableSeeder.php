<?php

use App\Image;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/images.json');
        $images = json_decode($getJson);

        foreach ($images as $singleImage){
            Cloudder::upload(storage_path('images/'.$singleImage->image),null,['folder'=>'LBDS/images']);
            $imageUrl = Cloudder::getResult();
            $image = new Image();
            $image->image = $imageUrl['secure_url'];
            $image->sneaker_id = $singleImage->sneaker_id;
            $image->save();
        }
    }
}
