@extends('admin.layouts.app')

@section('title')
    Karada - PressRelease-List
@endsection

@section('content')
    <press_release_list-component :method="'{{$method}}'" :current_page="{{$page}}"></press_release_list-component>
@endsection
