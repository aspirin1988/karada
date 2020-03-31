@extends('admin.layouts.app')

@section('title')
    Karada - Article-Edit
@endsection

@section('content')
    <author_edit-component :id="{{$id}}"></author_edit-component>
@endsection
