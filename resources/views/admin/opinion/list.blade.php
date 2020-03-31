@extends('admin.layouts.app')

@section('title')
    Karada - Opinion-List
@endsection

@section('content')
    <opinion_list-component :method="'{{$method}}'" :current_page="{{$page}}"></opinion_list-component>
@endsection
