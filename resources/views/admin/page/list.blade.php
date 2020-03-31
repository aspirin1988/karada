@extends('admin.layouts.app')

@section('title')
    Karada - Page-List
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <page_list-component :user_type="'{{$user_type}}'" :current_page="{{$page}}"></page_list-component>
@endsection
