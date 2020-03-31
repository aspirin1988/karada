@extends('admin.layouts.app')

@section('title')
    Karada - Comment_Object-List
@endsection

@section('content')
    <comment_object_list-component :model="'{{$model}}'" :id="'{{$id}}'" :method="'{{$method}}'"></comment_object_list-component>
@endsection
