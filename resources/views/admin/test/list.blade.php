@extends('admin.layouts.app')

@section('title')
    Karada - Test-List
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <test_list-component :user_type="'{{$user_type}}'" :current_page="'{{$page}}'"></test_list-component>
@endsection
