@extends('admin.layouts.app')

@section('title')
    Karada - Template-Edit
@endsection

@section('content')
    <template_edit-component :id="{{$id}}"></template_edit-component>
@endsection
