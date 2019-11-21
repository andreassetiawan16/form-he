@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-primary">
        <div id="app">
            <edit-data-kesehatan-form :datakesehatan="'{{ json_encode($dataKesehatan) }}'"></edit-data-kesehatan-form>
        </div>
    </div>
@endsection