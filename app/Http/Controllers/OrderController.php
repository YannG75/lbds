<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrdersProduct;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
            return response()->json(['msg' => 'faiiiil'],400);
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
            $order_products->save();
        }





        $data = (object) [
            'msg' => 'yay c\'est tout bon'
        ];

        return response()->json($data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
