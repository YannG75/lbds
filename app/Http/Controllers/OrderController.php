<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Mail\AdminMail;
use App\Mail\ContactMail;
use App\Mail\UserMail;
use App\MessageData;
use App\Order;
use App\OrdersProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

        /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $token = bin2hex(openssl_random_pseudo_bytes(4));

        $validator = Validator::make($request->all(), [
            'customer' => 'required',
            'customer.firstname' => 'required',
            'customer.lastname' => 'required',
            'customer.email' => 'required',
            'customer.address' => 'required',
            'products' => 'required',
            'products.*' => 'required',
            'products.*.*' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => 'une erreur est survenu ! réessayez en remplissant bien tous les champs'],400);
        }

        $customer = new Customer();
        $customer->last_name = $data['customer']['lastname'];
        $customer->first_name = $data['customer']['firstname'];
        $customer->email = $data['customer']['email'];
        $customer->address = $data['customer']['address'];
        $customer->save();

        $order = new Order();
        $order->token = $token;
        $order->customer_id = $customer->id;
        $order->save();

        foreach ($data['products'] as $product) {
            $order_products = new Ordersproduct();
            $order_products->order_id = $order->id;
            $order_products->product_id = $product['id'];
            $order_products->quantity = $product['quantity'];
            $order_products->size = $product['size'];
            $order_products->save();
        }


        $messageData = new MessageData;
        $messageData->customer = $customer->first_name;
        $messageData->order = 'la commande n°'.$order->token. ' est bien passé !';
        $messageData->message = 'Tu recevras bientôt tes sneakers ! ';

        Mail::to($customer->email)->send(new UserMail($messageData));

        $messageData = new MessageData;
        $messageData->message = 'la commande n°'.$order->token. ' vient d\'être passé sur le site !';


        Mail::to('admin@lbds.fr')->send(new AdminMail($messageData));


        $data = (object) [
            'msg' => 'yay c\'est tout bon',
            'cart' => $data['products']
        ];

        return response()->json($data);

    }
}
