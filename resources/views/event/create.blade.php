@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <create-event-form></create-event-form>
        </div>
    </div>
@endsection