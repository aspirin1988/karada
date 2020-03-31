@extends('admin.layouts.app')

@section('title')
    Karada - Conference-List
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <conference_list-component :user_type="'{{$user_type}}'" :method="'{{$method}}'" :current_page="{{$page}}"></conference_list-component>
@endsection
