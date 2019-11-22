@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <edit-data-peserta-form :datapeserta="'{{ json_encode($peserta) }}'"></edit-data-peserta-form>
        </div>
    </div>
@endsection