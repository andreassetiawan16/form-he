@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <event-form :isedit=false :isShow=false></event-form>
        </div>
    </div>
@endsection