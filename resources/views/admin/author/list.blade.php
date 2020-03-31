@extends('admin.layouts.app')

@section('title')
    Karada - Article-List
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <author_list-component :user_type="'{{$user_type}}'" :current_page="{{$page}}"></author_list-component>
@endsection
