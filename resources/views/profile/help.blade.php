@extends('profile.app')

@section('content')
    <div class="container">
        <div class="help-grid">
            @foreach( \App\Help::get() as $help)
                @php $video = $help->getVideo() @endphp
                <div class="accordion block">
                    <div class="accordion-header">
                        {{$help->title}}
                        <div class="accordion-button"></div>
                    </div>
                    <div class="accordion-content">
                        @if($video)
                            <video class="help-video" src="{{$video->getVideoSize()}}"
                                   data-video-1080="{{$video->getVideoSize()}}" data-video-720="{{$video->getVideoSize(720)}}"
                                   data-video-480="{{$video->getVideoSize(480)}}"></video>
                        @endif
                        {!! $help->description !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
