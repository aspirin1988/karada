@extends('admin.layouts.app')

@section('title')
    Karada - Media collection list
@endsection

@section('content')
    <media_collection_list-component :current_page="{{$page}}"></media_collection_list-component>
@endsection
