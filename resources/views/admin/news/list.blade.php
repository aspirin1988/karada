@extends('admin.layouts.app')

@section('title')
    Karada - News list
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <news_list-component :user_type="'{{$user_type}}'" :current_page="{{$page}}"></news_list-component>
@endsection
