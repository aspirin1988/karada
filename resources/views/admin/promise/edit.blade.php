@extends('admin.layouts.app')

@section('title')
    Karada - Promise-Edit
@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->siCorrector())
        <promise_corrector_edit-component :id="{{$id}}"></promise_corrector_edit-component>
    @else
        <promise_edit-component :id="{{$id}}"></promise_edit-component>
    @endif
@endsection
