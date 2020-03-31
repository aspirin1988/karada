@extends('admin.layouts.app')

@section('title')
    Karada - Log-List
@endsection

@section('content')
    <log_list-component :method="'{{$method}}'" :current_page="{{$page}}"></log_list-component>
@endsection
