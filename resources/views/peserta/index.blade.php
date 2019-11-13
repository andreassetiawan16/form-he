@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div class="container-fluid">
            <div class="head-content-section">
                <h3>Data Peserta</h3>
                <a class="btn btn-info" href="{{route("create.data.peserta")}}">Tambah</a>
            </div>
        </div>
        <div id="app">
            <peserta-table url="{{url("tablePeserta")}}"></peserta-table>
        </div>
    </div>
@endsection