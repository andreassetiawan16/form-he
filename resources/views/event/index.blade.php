@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div class="container-fluid">
            <div class="head-content-section">
                <h3>Data Event</h3>
                <a class="btn btn-info" href="{{route("create.event")}}">Tambah</a>
            </div>
        </div>
        <div id="app">
            <event-table url="{{url("tableEvents")}}"></event-table>
        </div>
    </div>
@endsection