@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-primary">
        <div id="app">
            <data-kesehatan-form :propkesehatan="'{{ json_encode($dataKesehatan) }}'" :iscreate=false></data-kesehatan-form>
        </div>
    </div>
@endsection