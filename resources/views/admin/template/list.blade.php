@extends('admin.layouts.app')

@section('title')
    Karada - Template-List
@endsection

@section('content')
    <template_list-component :current_page="{{$page}}"></template_list-component>
@endsection
