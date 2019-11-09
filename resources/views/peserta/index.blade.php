@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('add_button')
    <a class="btn btn-primary" href="{{route("create.data.peserta")}}">Tambah</a>
@endsection

@section('title_page')
    Data Peserta
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <div id="app">
                <custom-vuetable vuetable_ref="pesertaTable" url="{{url("tablePeserta")}}"></custom-vuetable>
            </div>
        </div>
    </div>
@endsection