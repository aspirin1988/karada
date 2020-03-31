@extends('profile.app')

@section('content')
    <div class="container">
        <div class="my_team">
            <div class="my_team_header block hidden-mobile">
                <div>
                    <span class="title">Сотрудников:</span>
                    <span class="price">{{$user->getCountTeam()}} / {{$user->company_limit}}</span>
                </div>
                <div class="my_team_header_buttons">
                    <div class="my_team_header_progress">
                        <div class="progress" style="display: none;">
                            <div style="width: {{($user->getCountTeam()/$user->company_limit)*100}}%"></div>
                        </div>
                    </div>
                    @if($user->getCountTeam()>=$user->company_limit)
                        <button class="button round button-gray-stroke" style="color: #e5e5e5;" disabled>добавить
                            сотрудника
                        </button>
                    @else
                        <a href="#" rel="add_teammate_button" class="button round button-blue-stroke">добавить
                            сотрудника</a>
                    @endif
                </div>
            </div>
            <div class="my_team_body">
                @foreach($user->getTeam() as $teammate )
                    <div class="my_team_body_item">
                        <div class="profile-edit block">
                            <div class="profile-ava">
                                <img src="{{$teammate->getAva()??'/img/empty.png'}}" alt="">
                                <remove_teammate-component :id="'{{$teammate->id}}'"></remove_teammate-component>
                            </div>
                            <div class="profile-data">
                                <div class="form">
                                    <div class="hidden-mobile">
                                        <p class="first_name">{{$teammate->first_name}}</p>
                                        <p class="last_name">{{$teammate->last_name}}</p>
                                    </div>
                                    <div class="visible-mobile">
                                        <div class="mobile-ava-grid">
                                            <div>
                                                <img src="{{$teammate->getAva()??'/img/empty.png'}}" alt="">
                                            </div>
                                            <div>
                                                <p class="first_name">{{$teammate->first_name}}</p>
                                                <p class="last_name">{{$teammate->last_name}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="name">Завершено уроков:</label>
                                        <p class="big-text">{{$sales->getLessonsCountCheck($teammate->id)}}</p>
                                    </div>
                                    <div class="row">
                                        <label for="first_name">Завершено разделов:</label>
                                        <p class="big-text">{{$sales->getSectionFinished($teammate->id)}}
                                            /{{$sales->getParentSectionCount()}}</p>
                                    </div>
                                    <div>
                                        <label class="progress-label" for="">Общее время:</label>
                                        <b>{{$sales->getStat($teammate->id)}}</b>
                                    </div>
                                    <div class="visible-mobile">
                                        <remove_teammate-component :id="'{{$teammate->id}}'"></remove_teammate-component>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-buttons">
                                <div class="my_rewards" style="padding: 0; width: 100%;">
                                    <a href="#" class="my_rewards_title">Награды:</a>
                                    <div class="my_rewards_item">
                                        <img src="/img/Sert-visual.png" alt="">
                                        <div>
                                            <label class="progress-label" for="">Сертификатов:
                                                <b>{{$teammate->getCertificatCount()}}
                                                    / {{$sales->getParentSectionCount()}}</b></label>
                                            <div class="progress" style="display: none;">
                                                <div
                                                        style="width: {{($sales->getParentSection()?ceil(($teammate->getCertificatCount($teammate->id)/$sales->getParentSectionCount())*100):0)}}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="/home/rewards/{{$teammate->id}}" class="button round button-blue-stroke ">
                                        <i class="icon medal"></i>
                                        Перейти в раздел</a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="offcanvas" rel="add_teammate">
        <div class="overlay"></div>
        <div class="center-center">
            <add_teammate-component></add_teammate-component>
        </div>
    </div>
    <div rel="add_teammate_confirm" class="offcanvas">
        <div class="overlay"></div>
        <div class="center-center">
            <div class="block modal-body" style="width: 370px;">
                <a href="#" class="modal-body-header" style="color: #37a2e9;">Сотрудника добавлен:</a>
                <div class="form">
                    <p style="margin: 40px 0; font-family: Montserrat; line-height: 27px;">Доступы в портал будут
                        высланы на указанный вами e-mail!</p>
                    <div class="row flex-center">
                        <a href="#" id="add_teammate_confirm_close"
                           class="button round button-yellow-stroke">Ok</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
