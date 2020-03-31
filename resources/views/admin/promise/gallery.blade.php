@extends('admin.layouts.app')

@section('title')
    Karada - Promise-Edit
@endsection

@section('content')
    <promise_image_list-component :id="{{$id}}"></promise_image_list-component>
@endsection
