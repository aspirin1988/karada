@extends('admin.layouts.app')

@section('title')
    Karada - Conference-Edit
@endsection

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->siCorrector())
        <conference_corrector_edit-component :id="{{$id}}"></conference_corrector_edit-component>
    @else
        <conference_edit-component :id="{{$id}}"></conference_edit-component>
    @endif
@endsection
