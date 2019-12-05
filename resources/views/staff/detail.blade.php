@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <detail-staff-form :datastaff="'{{ json_encode($staff) }}'"></detail-staff-form>
        </div>
    </div>
@endsection