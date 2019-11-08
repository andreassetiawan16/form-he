@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('title_page')
    Tambah Data Kesehatan Peserta
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-body">
            <div id="app">
                <data-kesehatan-form></data-kesehatan-form>
            </div>
        </div>
    </div>
@endsection