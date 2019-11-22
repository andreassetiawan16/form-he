<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\EventRequest;
use App\Http\Traits\DataKesehatanTrait;
use Carbon\Carbon;
use Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('event.index');
    }

    public function table(Request $request)
    {
        $input = $request->all();
        $perPage = $request->has('per_page') ? (int) $input['per_page'] : 10;
        $query = Event::query();
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
        return view('event.create');
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
        $validator = Validator::make($data, EventRequest::rules());
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->getMessages();
            return response()->json([
                'message' => $errorMessage,
                'status' => 406
            ]);
        } else {
            $response = Event::create($data);
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
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        return view('event.detail', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('event.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, EventRequest::rules());
        if ($validator->fails()) {
            $errorMessage = $validator->errors()->getMessages();
            return response()->json([
                'message' => $errorMessage,
                'status' => 406
            ]);
        } else {
            $updateEvent = Event::find($id);
            $updateEvent->update($data);
            return response()->json([
                'data' => $updateEvent,
                'message' => 'Berhasil update data peserta',
                'status' => 200
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $event = Event::find($request->id);
        $event->delete();
        return response()->json([
            'message' => 'Berhasil menghapus event',
            'status' => 200
        ]);
    }
}
