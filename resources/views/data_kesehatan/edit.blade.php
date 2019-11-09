@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('title_page')
    Edit Data Kesehatan Peserta
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-body">
            <div id="app">
                <data-kesehatan-form :propkesehatan="'{{ json_encode($dataKesehatan) }}'" :isedit=true></data-kesehatan-form>
            </div>
        </div>
    </div>
@endsection