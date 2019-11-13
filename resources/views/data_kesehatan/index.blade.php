@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div id="app">
        <data-kesehatan-table url="{{url("tableDataKesehatan")}}"></data-kesehatan-table>
    </div>
@endsection