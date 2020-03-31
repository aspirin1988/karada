@extends('admin.layouts.app')

@section('title')
    Karada - PressRelease-Single
@endsection

@section('content')
    <press_release_single-component :id="{{$id}}"></press_release_single-component>
@endsection
