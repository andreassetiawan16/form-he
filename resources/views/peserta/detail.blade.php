@extends('skeleton.index')

@section('title')
    Health Expo
@endsection

@section('content')
    <div class="box box-info">
        <div id="app">
          <detail-data-peserta-form :datapeserta="'{{ json_encode($peserta) }}'"></detail-data-peserta-form>
        </div>
    </div>
@endsection