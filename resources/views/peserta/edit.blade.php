@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('title_page')
    Tambah Data Peserta
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-body">
            <div id="app">
                <data-peserta-form :proppeserta="'{{ json_encode($peserta) }}'" :isedit=true></data-peserta-form>
            </div>
        </div>
    </div>
@endsection