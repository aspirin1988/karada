@extends('admin.layouts.app')

@section('title')
    Karada - Article-List
@endsection

@section('content')
    <rubric_list-component :current_page="{{$page}}"></rubric_list-component>
@endsection
