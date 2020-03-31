@extends('admin.layouts.app')

@section('title')
    Karada - PobediteliVideo-Single
@endsection

@section('content')
    <pobediteli_video_single-component :id="{{$id}}"></pobediteli_video_single-component>
@endsection
