@extends('admin.layouts.app')

@section('title')
    Karada - PromoCode
@endsection

@section('content')
    @php $user_type = Auth::user()->type; @endphp
    <promo_code_list-component :user_type="'{{$user_type}}'" :current_page="{{$page}}"></promo_code_list-component>
@endsection
