@extends('admin.layouts.app')

@section('title')
    Karada - Article-List
@endsection

@section('content')
    <battle_opinion_list-component :method="'{{$method}}'" :current_page="{{$page}}"></battle_opinion_list-component>
@endsection
