@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <event-form :proppeserta="'{{ json_encode($peserta) }}'" :isedit=true></event-form>
        </div>
    </div>
@endsection