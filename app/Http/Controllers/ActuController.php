<?php

namespace App\Http\Controllers;

use App\Actu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JD\Cloudder\Facades\Cloudder;

class ActuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Actu::where('is_published',true)->where('publish_date','<=',Carbon::now())->get());
    }

    public function adminIndex() {
        return response()->json(Actu::all());
    }

    public function adminShow(Actu $actu, $id)
    {
        return response()->json($actu->findOrFail($id));
    }


    public function lastNews()
    {
        return response()->json(Actu::latest()->take(5)->where('is_published',true)->where('publish_date','<=',Carbon::now())->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|unique:actus',
                'image'=>'required|mimes:jpeg,jpg,png',
                'banner'=>'required|mimes:jpeg,jpg,png',
                'summary'=>'required',
                'content'=>'required',
                'publish_date'=>'required',
                'is_published'=>'required|integer',
                'author'=>'required',
            ]);
        }
    catch (\Exception $e){
        $error = "Tous les champs doivent être remplis !";
        return response()->json(['msg'=> $error], 404);
    }
            $all = $request->all();

        $imageName = $request->image->getRealPath();
        Cloudder::upload($imageName, null, ['folder' => 'LBDS-Online/news']);
        $imgUrl = Cloudder::getResult();

        $bannerName = $request->banner->getRealPath();
        Cloudder::upload($bannerName, null, ['folder' => 'LBDS-Online/news/banner']);
        $bannerUrl = Cloudder::getResult();


        $news = new Actu();
        $news->title = $request->title;
        $news->summary = $request->summary;
        $news->content = $all['content'];
        $news->is_published = $request->is_published;
        $news->publish_date = $request->publish_date;
        $news->author = $request->author;
        $news->image = $imgUrl['secure_url'];
        $news->banner = $bannerUrl['secure_url'];
        $news->save();

        return response()->json(['msg' => 'Création effectuée avec succès ! 😇']);

    }

    /**
     * Display the specified resource.
     *
     * @param Actu $actu
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Actu $actu, $id)
    {
        return response()->json($actu->where('is_published',true)->where('publish_date','<=',Carbon::now())->findOrFail($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Actu $actu
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Actu $actu, $id)
    {
        try {
            $request->validate([
                'title' => 'required',
                'summary'=>'required',
                'content'=>'required',
                'publish_date'=>'required',
                'is_published'=>'required|integer',
                'author'=>'required',
            ]);
        }
    catch (\Exception $e){
        $error = "Tous les champs doivent être remplis !";
        return response()->json(['msg'=> $error], 404);
    }
        $all = $request->all();

         Actu::findOrFail($id)->update([
            'title' => $request->title,
            'summary'=>$request->summary,
            'content'=>$all['content'],
            'publish_date'=>$request->publish_date,
            'is_published'=>$request->is_published,
            'author'=>$request->author,
        ]);
        $oldImage = Actu::findOrFail($id);

        if($request->image) {

            $extension = pathinfo($oldImage->image);
            $public_id = basename($oldImage->image, "." . $extension['extension']);
            Cloudder::delete("LBDS-Online-Online/news/".$public_id);

            $imageName = $request->image->getRealPath();
            Cloudder::upload($imageName, null, ['folder' => 'LBDS-Online/news']);
            $newsImage = Cloudder::getResult();

            $updateNews = $oldImage->update([
                'image' => $newsImage['secure_url'],
            ]);
        }

        if($request->banner) {
            $extension = pathinfo($oldImage->banner);
            $public_id = basename($oldImage->banner, "." . $extension['extension']);
            Cloudder::delete("LBDS-Online-Online/news/banner/".$public_id);

            $imageName = $request->banner->getRealPath();
            Cloudder::upload($imageName, null, ['folder' => 'LBDS-Online/news/banner']);
            $newsImage = Cloudder::getResult();

            $updateNews = $oldImage->update([
                'banner' => $newsImage['secure_url'],
            ]);

        }

        return response()->json(['msg' => 'Modification effectuée avec succès ! 😇']);

    }

    public function delete($id) {
        $news = Actu::findOrFail($id);
        $extension = pathinfo($news->image);
        $public_id = basename($news->image,".".$extension['extension']);
        Cloudder::delete("LBDS-Online/news/".$public_id);

        $extension = pathinfo($news->banner);
        $public_id = basename($news->banner,".".$extension['extension']);
        Cloudder::delete("LBDS-Online/news/banner/".$public_id);

        $news->delete();
        return response()->json(['msg' => 'Suppression réussis !']);
    }
}
