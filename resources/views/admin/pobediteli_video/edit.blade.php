@extends('admin.layouts.app')

@section('title')
    Karada - PobediteliVideo-Edit
@endsection

@section('content')
    <pobediteli_video_edit-component :id="{{$id}}"></pobediteli_video_edit-component>
@endsection
