@extends('admin.layouts.app')

@section('title')
    Karada - SpecialWidget-Edit
@endsection

@section('content')
    <special_widget_company_edit-component :id="{{$id}}"></special_widget_company_edit-component>
@endsection
