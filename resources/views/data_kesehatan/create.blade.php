@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <create-data-kesehatan-form></create-data-kesehatan-form>
        </div>
    </div>
@endsection