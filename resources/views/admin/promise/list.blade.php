@extends('admin.layouts.app')

@section('title')
    Karada - Promise-List
@endsection

@section('content')
    <promise_list-component :method="'{{$method}}'" :current_page="{{$page}}"></promise_list-component>
@endsection
