@extends('admin.layouts.app')

@section('title')
    Karada - PobediteliCompetition-Single
@endsection

@section('content')
    <pobediteli_competition_single-component :id="{{$id}}"></pobediteli_competition_single-component>
@endsection
