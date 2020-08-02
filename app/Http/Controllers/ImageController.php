<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;

class ImageController extends Controller
{
    public function delete(Image $image, $id) {
        $img = $image->findOrFail($id);

        $extension = pathinfo($img['image']);
        $public_id = basename($img['image'], "." . $extension['extension']);
        Cloudder::delete("LBDS/images/" . $public_id);
        $img->delete();

        return response()->json(['msg' => 'Suppression effectué avec succès ! 😇']);
    }
}
