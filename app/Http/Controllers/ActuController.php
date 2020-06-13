<?php

namespace App\Http\Controllers;

use App\Actu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Actu::all());
    }


    public function lastNews()
    {
        return response()->json(Actu::latest()->take(5)->get());
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
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Actu $actu
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Actu $actu, $id)
    {
        return response()->json($actu->findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Actu $actu
     * @return Response
     */
    public function edit(Actu $actu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Actu $actu
     * @return Response
     */
    public function update(Request $request, Actu $actu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Actu $actu
     * @return Response
     */
    public function destroy(Actu $actu)
    {
        //
    }
}
