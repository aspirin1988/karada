@extends('admin.layouts.app')

@section('title')
    Karada - Article-Single
@endsection

@section('content')
    <battle_opinion_single-component :id="{{$id}}"></battle_opinion_single-component>
@endsection
