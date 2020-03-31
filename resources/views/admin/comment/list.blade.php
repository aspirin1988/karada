@extends('admin.layouts.app')

@section('title')
    Karada - Comment-List
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <comment_list-component :user_type="'{{$user_type}}'" :method="'{{$method}}'" :current_page="{{$page}}"></comment_list-component>
@endsection
