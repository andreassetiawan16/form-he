<?php

namespace App\Http\Controllers;

use App\DataKesehatan;
use Illuminate\Http\Request;

class DataKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data_kesehatan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_kesehatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataKesehatan  $dataKesehatan
     * @return \Illuminate\Http\Response
     */
    public function show(DataKesehatan $dataKesehatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataKesehatan  $dataKesehatan
     * @return \Illuminate\Http\Response
     */
    public function edit(DataKesehatan $dataKesehatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataKesehatan  $dataKesehatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DataKesehatan $dataKesehatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataKesehatan  $dataKesehatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(DataKesehatan $dataKesehatan)
    {
        //
    }
}
