<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\MessageData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\Object_;

class ContactController extends Controller
{
    public function sendMail(Request $request) {
         // data is an array right now

        $data = $request->json()->all();
        $validator = Validator::make($request->all(), [
            'form.*' => 'required',
            'form.prenom' => 'required',
            'form.nom' => 'required',
            'form.email' => 'required',
            'form.sujet' => 'required',
            'form.message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'hep ! pas si vite ! il faut remplir tous les champs 😋 '],400);
        }

        $messageData = new MessageData;
        $messageData->name = $data['form']['nom'].' '. $data['form']['prenom'];
        $messageData->email = $data['form']['email'];
        $messageData->subject = $data['form']['sujet'];
        $messageData->message = $data['form']['message'];

        Mail::to('newuser@example.com')->send(new ContactMail($messageData));

        $succes = (object) [
            'msg' => 'Message bien reçu ! Nous traitons ta demande aussi vite que possible ! 😇'
        ];
         return response()->json($succes,200) ;
    }
}
