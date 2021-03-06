<?php

use App\Actu;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getJson= File::get('database/data/news.json');
        $actus = json_decode($getJson);

        foreach ($actus as $article){
            Cloudder::upload(storage_path('images/'.$article->image),null,['folder'=>'LBDS-Online/news']);
            $image = Cloudder::getResult();
            Cloudder::upload(storage_path('images/'.$article->banner),null,['folder'=>'LBDS-Online/news/banner']);
            $banner = Cloudder::getResult();
            $news = new Actu();
            $news->title = $article->title;
            $news->image = $image['secure_url'];
            $news->banner = $banner['secure_url'];
            $news->summary = $article->summary;
            $news->content = $article->content;
            $news->publish_date = Carbon::now();
            $news->save();
        }
    }
}
