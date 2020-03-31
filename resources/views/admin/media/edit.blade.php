@extends('admin.layouts.app')

@section('title')
    Karada - Media collection edit
@endsection

@section('content')
    <media_collection_edit-component :id="{{$id}}"></media_collection_edit-component>
@endsection
