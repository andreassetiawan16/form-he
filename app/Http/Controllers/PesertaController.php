<?php

namespace App\Http\Controllers;

use App\Peserta;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\PesertaRequest;
use App\Http\Traits\DataKesehatanTrait;
use Carbon\Carbon;
use Validator;

class PesertaController extends Controller
{
    
    use DataKesehatanTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peserta.index');
    }

    public function table(Request $request)
    {
        $input = $request->all();
        $perPage = $request->has('per_page') ? (int) $input['per_page'] : 10;
        $query = Peserta::query();
        if ($request->has('filter')) {
            $query->where('nama', 'LIKE', '%'.$request->filter.'%');
        } else {
            if($request->has('sort') && !empty($input['sort'])){
                $sort = explode('|', $request->sort);
            
                $query->orderBy($sort[0], strtoupper($sort[1]));
            }else{
                $query->orderBy('created_at', 'DESC');
            }
        }
        
        $total = $query->count();
        $currentPage = $request->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $result = $query->offset($offset)->limit($perPage)->get();
    
        $pesertas = new LengthAwarePaginator($result,$total,$perPage,$currentPage,[
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'peserta'
        ]);
        return response()->json($pesertas)->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peserta.create');
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
        $date = Carbon::parse($request->tanggal_lahir);
        $now = Carbon::now();
        $usia = $date->diffInYears($now);
        $data['usia'] = $usia;
        $validator = Validator::make($data, PesertaRequest::rules());
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->getMessages();
            return response()->json([
                'message' => $errorMessage,
                'status' => 406
            ]);
        } else {
            $data['tanggal_lahir'] = $date;
            $response = Peserta::create($data);
            return response()->json([
                'data' => $response,
                'message' => 'Berhasil membuat data peserta',
                'status' => 200
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peserta = Peserta::find($id);
        return view('peserta.detail', ['peserta' => $peserta]);
    }

    public function search(Request $request)
    {
        $input = $request->all();
        $pesertas = Peserta::where('nama', 'LIKE', '%'.$input['query'].'%')->get();
        return response()->json([
            'data' => $pesertas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peserta = Peserta::find($id);
        return view('peserta.edit', ['peserta' => $peserta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $date = Carbon::parse($request->tanggal_lahir);
        $now = Carbon::now();
        $usia = $date->diffInYears($now);
        $data['usia'] = $usia;
        $validator = Validator::make($data, PesertaRequest::rules());
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->getMessages();
            return response()->json([
                'message' => $errorMessage,
                'status' => 406
            ]);
        } else {
            $updatePeserta = Peserta::find($id);
            $updatePeserta->update($data);
            return response()->json([
                'data' => $updatePeserta,
                'message' => 'Berhasil update data peserta',
                'status' => 200
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Peserta  $peserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $peserta = Peserta::find($request->id);
        $peserta->dataKesehatan()->delete();
        $peserta->delete();

        return response()->json([
            'message' => 'Berhasil menghapus peserta',
            'status' => 200
        ]);
    }
}
