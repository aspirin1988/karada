@extends('admin.layouts.app')

@section('title')
    Karada - Test-Edit
@endsection

@section('content')
    <test_edit-component :id="{{$id}}"></test_edit-component>
@endsection
