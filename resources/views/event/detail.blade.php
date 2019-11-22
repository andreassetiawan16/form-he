@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <detail-event-form :dataevent="'{{ json_encode($event) }}'"></detail-event-form>
        </div>
    </div>
@endsection