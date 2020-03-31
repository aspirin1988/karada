@extends('admin.layouts.app')

@section('title')
    Karada - SpecialWidget-List
@endsection

@section('content')
    <special_widget_list-component :method="'{{$method}}'" :current_page="{{$page}}"></special_widget_list-component>
@endsection
