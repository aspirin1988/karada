@extends('profile.app')

@section('content')
    <div class="container">
        <div class="sales_plan">
            @if($sales_plan && count($sales_plan))
                <div class="sales_plan_header block">
                    <div>
                        <span class="title">Годовой план продаж:</span>
                        <span class="price">{{number_format($sales_plan_sum, 0, ',', ' ')}}</span>
                    </div>
                    <div class="sales_plan_header_buttons">
                        <div class="sales_plan_header_progress">
                            <label class="progress-label" for="">На данный момент: <span>{{number_format($sales_fact_sum, 0, ',', ' ')}}</span>
                                <b>{{ceil(($sales_fact_sum/$sales_plan_sum)*100)}}%</b></label>
                            <div class="progress" style="display: none;">
                                <div style="width: {{($sales_fact_sum/$sales_plan_sum)*100}}%"></div>
                            </div>
                        </div>
                        <a href="#" rel="sales_plan_edit" class="button round button-gray-stroke">редактировать</a>
                    </div>
                </div>
                <div class="sales_plan_body">
                    <see-sales-plan-component :id="'{{$user_id}}'"></see-sales-plan-component>
                </div>
                <edit-sales-plan-modal-component></edit-sales-plan-modal-component>
            @else
                <div class="sales_plan_header block">
                    <div style="display: flex;">
                        <span class="title">Годовой план продаж:</span>
                        <span style="display: inline-block; text-align: center;" class="price">Не создан</span>
                    </div>
                    <create-sales-plan-component :user_id="'{{$user_id}}'" :title="'Назначить'"></create-sales-plan-component>
                </div>
            @endif
        </div>
    </div>
    <div class="offcanvas" rel="sales_plan_edit_modal">
        <div class="overlay"></div>
        <div class="center-center">
            <edit-sales-plan-modal-component :id="'{{$user_id}}'"></edit-sales-plan-modal-component>
        </div>
    </div>
@endsection
