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

    public function table(Request $request)
    {
        $input = $request->all();
        $perPage = $request->has('per_page') ? (int) $input['per_page'] : 10;

        $query = DataKesehatan::query();
        if($request->has('sort') && !empty($input['sort'])){
            $sort = explode('|', $request->sort);
        
            $query->orderBy($sort[0], strtoupper($sort[1]));
        }else{
            $query->orderBy('created_at', 'DESC');
        }
        
        $total = $query->count();
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $result = $query->offset($offset)->limit($perPage)->get();
    
        $dataKesehatans = new LengthAwarePaginator($result,$total,$perPage,$currentPage,[
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'dataKesehatan'
        ]);
        return response()->json($dataKesehatans)->setStatusCode(200);
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
        return response()->json([
    		'success' => true,
    		'message' => 'Pesan berhasil dikirim.'
    	]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DataKesehatan  $dataKesehatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataKesehatan = DataKesehatan::find($id);
        return response ()->json([
            'data' => $dataKesehatan,
            'message' => 'Berhasil membuat data kesehatan',
            'status' => 200
        ]);
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
