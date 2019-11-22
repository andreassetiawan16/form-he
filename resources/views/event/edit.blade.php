@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <edit-event-form :dataevent="'{{ json_encode($event) }}'"></edit-event-form>
        </div>
    </div>
@endsection