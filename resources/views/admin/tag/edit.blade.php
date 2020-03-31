@extends('admin.layouts.app')

@section('title')
    Karada - Tag-Edit
@endsection

@section('content')
    <tag_edit-component :id="{{$id}}"></tag_edit-component>
@endsection
