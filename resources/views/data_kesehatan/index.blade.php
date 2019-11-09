@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('add_button')
    <a class="btn btn-primary" href="{{route("create.data.kesehatan")}}">Tambah</a>
@endsection

@section('title_page')
    Data Kesehatan Peserta
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-body">
            <div id="app">
                <data-kesehatan-table url="{{url("tableDataKesehatan")}}"></data-kesehatan-table>
            </div>
        </div>
    </div>
@endsection