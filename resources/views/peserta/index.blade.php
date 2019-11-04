@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('add_button')
    <a class="btn btn-block btn-info" href="{{route("create.data.peserta")}}">Tambah</a>
@endsection

@section('title_page')
    Data Peserta
@endsection