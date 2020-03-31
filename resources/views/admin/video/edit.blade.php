@extends('admin.layouts.app')

@section('title')
    Karada - Video edit
@endsection

@section('content')
    <video_edit-component :id="{{$id}}"></video_edit-component>
@endsection
