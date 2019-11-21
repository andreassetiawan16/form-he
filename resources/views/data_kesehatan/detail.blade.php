@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <detail-data-kesehatan-form :datakesehatan="'{{ json_encode($dataKesehatan) }}'"></detail-data-kesehatan-form>
        </div>
    </div>
@endsection