@extends('admin.layouts.app')

@section('title')
    Karada - User-Add
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <user_add_company-component :company_id="'{{$id}}'"></user_add_company-component>
@endsection
