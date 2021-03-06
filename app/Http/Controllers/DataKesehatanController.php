<?php

namespace App\Http\Controllers;

use App\DataKesehatan;
use App\Peserta;
use Illuminate\Http\Request;
use App\Http\Requests\DataKesehatanRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
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

    public function table(Request $request)
    {
        // $dataKesehatan = Peserta::find($id)->dataKesehatan()->paginate(1);
        $input = $request->all();
        $perPage = $request->has('per_page') ? (int) $input['per_page'] : 10;

        // $query = Peserta::find($id)->dataKesehatan();
        $query = DataKesehatan::with('peserta');

        if(!is_null($request->peserta_id)) {
            $query->where('peserta_id', $request->peserta_id);
        }

        if (!empty($request->from_date) && !empty($request->to_date)) {
            $fromDate = new Carbon($request->from_date);
            $toDate = new Carbon($request->to_date);
            $query->whereBetween('tanggal_he', [$fromDate, $toDate]);
        }

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
        $dataKesehatan = DataKesehatan::with('peserta')->with('dokter')->with('petugas')->find($id);
        return view('data_kesehatan.detail', ['dataKesehatan' => $dataKesehatan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DataKesehatan  $dataKesehatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataKesehatan = DataKesehatan::with('peserta')->with('dokter')->with('petugas')->find($id);
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
        if ($data['petugas_id'] == 0) {
            $data['petugas_id'] = null;
        }
        if ($data['dokter_id'] == 0) {
            $data['dokter_id'] = null;
        }
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
                'message' => 'Berhasil update data kesehatan',
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

        return response()->json([
            'message' => 'Berhasil menghapus data kesehatan',
            'status' => 200
        ]);
    }
}
