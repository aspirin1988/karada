@extends('admin.layouts.app')

@section('title')
    Karada - Promise-Single
@endsection

@section('content')
    <promise_single-component :id="{{$id}}"></promise_single-component>
@endsection
