@extends('admin.layouts.app')

@section('title')
    Karada - Member-List
@endsection

@section('content')
    <member_list-component :method="'{{$method}}'" :current_page="{{$page}}"></member_list-component>
@endsection
