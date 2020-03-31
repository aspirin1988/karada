@extends('admin.layouts.app')

@section('title')
    Karada - Gallery-Single
@endsection

@section('content')
    <gallery_single-component :id="{{$id}}"></gallery_single-component>
@endsection
