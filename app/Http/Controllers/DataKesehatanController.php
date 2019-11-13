<?php

namespace App\Http\Controllers;

use App\DataKesehatan;
use App\Peserta;
use Illuminate\Http\Request;
use App\Http\Requests\DataKesehatanRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;

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

    public function table(Request $request, $id)
    {
        // $dataKesehatan = Peserta::find($id)->dataKesehatan()->paginate(1);
        // return response()->json($dataKesehatan);
        $input = $request->all();
        $perPage = $request->has('per_page') ? (int) $input['per_page'] : 10;

        $query = Peserta::find($id)->dataKesehatan();

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
        $data = $request->all();
        $validator = Validator::make($data, DataKesehatanRequest::rules());
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->getMessages();
            return response()->json([
                'message' => $errorMessage,
                'status' => 406
            ]);
        } else {
            $response = DataKesehatan::create($data);
            return response()->json([
                'data' => $response,
                'message' => 'Berhasil Membuat Data Kesehatan',
                'status' => 200
            ]);
        }
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
    public function edit($id)
    {
        $dataKesehatan = DataKesehatan::with('peserta')->find($id);
        return view('data_kesehatan.edit', ['dataKesehatan' => $dataKesehatan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DataKesehatan  $dataKesehatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, DataKesehatanRequest::rules());
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->getMessages();
            return response()->json([
                'message' => $errorMessage,
                'status' => 406
            ]);
        } else {
            $updateDataKesehatan = DataKesehatan::find($id);
            $updateDataKesehatan->update($data);
            return response()->json([
                'data' => $updateDataKesehatan,
                'message' => 'Berhasil membuat data peserta',
                'status' => 200
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DataKesehatan  $dataKesehatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $dataKesehatan = DataKesehatan::find($request->id);
        $dataKesehatan->delete();

        return ressponse()->json([
            'message' => 'Berhasil menghapus data kesehatan',
            'status' => 200
        ]);
    }
}
