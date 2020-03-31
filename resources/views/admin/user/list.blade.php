@extends('admin.layouts.app')

@section('title')
    Karada - User-List
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <user_list-component :user_type="'{{$user_type}}'" :method="'{{$method}}'" :current_page="{{$page}}"></user_list-component>
@endsection
