@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <data-peserta-form :isedit=false :isShow=false></data-peserta-form>
        </div>
    </div>
@endsection