@extends('admin.layouts.app')

@section('title')
    Karada - PressRelease-Edit
@endsection

@section('content')
    <press_release_edit-component :id="{{$id}}"></press_release_edit-component>
@endsection
