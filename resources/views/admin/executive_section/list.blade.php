@extends('admin.layouts.app')

@section('title')
    Karada - Executive Section list
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <executive_section_list-component :user_type="'{{$user_type}}'" :method="'{{$method}}'" :current_page="{{$page}}"></executive_section_list-component>
@endsection
