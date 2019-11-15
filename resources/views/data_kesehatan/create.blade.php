@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <data-kesehatan-form :iscreate=true></data-kesehatan-form>
        </div>
    </div>
@endsection