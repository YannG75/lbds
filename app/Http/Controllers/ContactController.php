<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\MessageData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Object_;

class ContactController extends Controller
{
    public function sendMail(Request $request) {
         // data is an array right now



        $messageData = new MessageData;
        $messageData->name = $request->input('form.nom').' '. $request->input('form.prenom');
        $messageData->email = $request->input('form.email');
        $messageData->subject = $request->input('form.sujet');
        $messageData->message = $request->input('form.message');



        Mail::to('newuser@example.com')->send(new ContactMail($messageData));

        $succes = (object) [
            'msg' => 'Message bien reçu ! Nous traitons ta demande aussi vite que possible ! 😇'
        ];
         return response()->json($succes,200) ;
    }
}
