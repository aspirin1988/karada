@extends('admin.layouts.app')

@section('title')
    Karada - Gallery-List
@endsection

@section('content')
    <gallery_list-component :method="'{{$method}}'" :current_page="{{$page}}"></gallery_list-component>
@endsection
