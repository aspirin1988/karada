@extends('admin.layouts.app')

@section('title')
    Karada - Log-Single
@endsection

@section('content')
    <log_single-component :method="'{{$method}}'" :current_page="{{$page}}" :id="{{$id}}"></log_single-component>
@endsection
