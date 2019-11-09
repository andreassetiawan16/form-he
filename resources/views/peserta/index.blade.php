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
                <peserta-table url="{{url("tablePeserta")}}"></peserta-table>
            </div>
        </div>
    </div>
@endsection