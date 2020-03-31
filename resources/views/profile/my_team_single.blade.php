@extends('profile.app')

@section('content')
    <div class="container">
        <div class="my_team sales_plan">
            <div class="my_team_header block">
                <div class="flex-left">
                    <img src="{{$teammate->getAva()??'/img/empty.png'}}" alt="">
                    <div class="name">{{$teammate->first_name}} {{$teammate->last_name}}</div>
                </div>
                <div class="my_team_header_buttons {{!count($teammate->getPlans())?'no-create':''}}">
                    @if(count($teammate->getPlans()))
                        <span class="title">Продаж на сегодня:</span>
                        <span class="price">{{$teammate->getFactSum()}}</span>
                    @else
                        <create-sales-plan-component :user_id="'{{$teammate->id}}'" :title="'Назначить'"></create-sales-plan-component>
                    @endif
                </div>
            </div>
            <edit-teammate-sales-plan-component :id="'{{$teammate->id}}'"></edit-teammate-sales-plan-component>
        </div>
    </div>
    <div class="offcanvas" rel="add_teammate">
        <div class="overlay"></div>
        <div class="center-center">
{{--            <add_teammate-component></add_teammate-component>--}}
        </div>
    </div>
@endsection
