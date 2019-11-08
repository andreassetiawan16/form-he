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
                <custom-vuetable vuetable_ref="pesertaTable" url="{{url("tablePeserta")}}"></custom-vuetable>
            </div>
        </div>
    </div>
@endsection