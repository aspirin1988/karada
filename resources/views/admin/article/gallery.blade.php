@extends('admin.layouts.app')

@section('title')
    Karada - Article-Edit
@endsection

@section('content')
    <article_image_list-component :id="{{$id}}"></article_image_list-component>
@endsection
