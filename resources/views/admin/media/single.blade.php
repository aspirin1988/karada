@extends('admin.layouts.app')

@section('title')
    Karada - Page-Single
@endsection

@section('content')
    <page_single-component :id="{{$id}}"></page_single-component>
@endsection
