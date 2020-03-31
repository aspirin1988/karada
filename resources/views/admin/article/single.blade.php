@extends('admin.layouts.app')

@section('title')
    Karada - Article-Single
@endsection

@section('content')
    <article_single-component :id="{{$id}}"></article_single-component>
@endsection
