@extends('admin.layouts.app')

@section('title')
    Karada - Company edit
@endsection

@section('content')
    <company_edit-component :id="{{$id}}"></company_edit-component>
@endsection
