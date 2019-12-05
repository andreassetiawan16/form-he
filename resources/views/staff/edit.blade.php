@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
            <edit-staff-form :datastaff="'{{ json_encode($staff) }}'"></edit-staff-form>
        </div>
    </div>
@endsection