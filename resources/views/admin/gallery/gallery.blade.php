@extends('admin.layouts.app')

@section('title')
    Karada - Gallery-Edit
@endsection

@section('content')
    <gallery_image_list-component :id="{{$id}}"></gallery_image_list-component>
@endsection
