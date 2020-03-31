@extends('admin.layouts.app')

@section('title')
    Karada - Article-List
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <article_list-component :user_type="'{{$user_type}}'" :method="'{{$method}}'" :current_page="{{$page}}"></article_list-component>
@endsection
