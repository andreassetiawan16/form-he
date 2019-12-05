<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use App\Http\Requests\StaffRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff.index');
    }

    public function table (Request $request)
    {
        $input = $request->all();
        $perPage = $request->has('per_page') ? (int) $input['per_page'] : 10;
        $query = Staff::query();

        if (!empty($input['posisi'])) {
            $query->where('posisi', '=', $request->posisi);
        }

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
    
        $list_staff = new LengthAwarePaginator($result,$total,$perPage,$currentPage,[
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'staff'
        ]);
        return response()->json($list_staff)->setStatusCode(200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create');
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
        $validator = Validator::make($data, StaffRequest::rules());
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->getMessages();
            return response()->json([
                'message' => $errorMessage,
                'status' => 406
            ]);
        } else {
            $data['tanggal_lahir'] = $date;
            $response = Staff::create($data);
            return response()->json([
                'data' => $response,
                'message' => 'Berhasil membuat data staff',
                'status' => 200
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::find($id);
        return view('staff.detail', ['staff' => $staff]);
    }

    public function search(Request $request)
    {
        $input = $request->all();
        $list_staff = Staff::where('nama', 'LIKE', '%'.$input['query'].'%')->where('posisi', '=', $input['posisi'])->get();
        return response()->json([
            'data' =>$list_staff
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::find($id);
        return view('staff.edit', ['staff' => $staff]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $date = Carbon::parse($request->tanggal_lahir);
        $now = Carbon::now();
        $usia = $date->diffInYears($now);
        $data['usia'] = $usia;
        $validator = Validator::make($data, StaffRequest::rules());
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->getMessages();
            return response()->json([
                'message' => $errorMessage,
                'status' => 406
            ]);
        } else {
            $updateStaff = Staff::find($id);
            $updateStaff->update($data);
            return response()->json([
                'data' => $updateStaff,
                'message' => 'Berhasil update data staff',
                'status' => 200
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $staff = Staff::find($request->id);
        $staff->delete();

        return response()->json([
            'message' => 'Berhasil menghapus staff',
            'status' => 200
        ]);
    }
}
