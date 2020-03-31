@extends('admin.layouts.app')

@section('title')
    Karada - SpecialWidget-Single
@endsection

@section('content')
    <special_widget_single-component :id="{{$id}}"></special_widget_single-component>
@endsection
