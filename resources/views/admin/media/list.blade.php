@extends('admin.layouts.app')

@section('title')
    Karada - Media list
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <media_list-component :user_type="'{{$user_type}}'" current_dir="'{{$dir}}'"  :current_page="{{$page}}"></media_list-component>
@endsection
