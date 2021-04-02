@extends('layouts/app')
@section('content')
@include('inc/topnav')
<br>
<br>
<br>

<!-- ***** Call to Action Area Start ***** -->
<div class="sonar-call-to-action-area section-padding-0-100">
    <div class="backEnd-content">
        <h2>Studio</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-form text-center call-to-action-content wow fadeInUp" data-wow-delay="0.5s">
                    <h2>Edit {{ $video->name }}</h2>
                    <br>
                    <div class="form-group">
                        {!! Form::open(['action' => ['VideosController@update', $video->id],
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data']) !!}
                        {{ Form::hidden('_method', 'PUT') }}
                        {{ Form::label('Video', '', ['class' => 'float-left']) }}
                        {{ Form::text('video', '', ['class' => 'form-control', 'placeholder' => $video->video]) }}
                        <br>
                        {{ Form::label('Video name', '', ['class' => 'float-left']) }}
                        {{ Form::text('video-name', '', ['class' => 'form-control', 'placeholder' => $video->name,
                       ]) }}
                        <br>
                        {{ Form::label('Featuring Artist', '', ['class' => 'float-left']) }}
                        {{ Form::text('ft', '', ['class' => 'form-control', 'placeholder' => $video->ft]) }}
                        <br>
                        {{ Form::label('Video Album', '', ['class' => 'float-left']) }}
                        <select name='video-album' class='form-control'>
                            <option hidden disabled selected value>
                                @if($video->album != 'Single'
                                    && $video->album != '')
                                    {{ $video->video_albums->name }}
                                @else
                                    {{ $video->album }}
                                @endif
                            </option>
                            <option value="Single">Single</option>
                            @foreach($videoAlbums as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <br>
                        {{ Form::label('Video Genre', '', ['class' => 'float-left']) }}
                        {{ Form::select('video-genre', [
								 'Afro'=> 'Afro',
								 'Benga' => 'Benga',
								 'Blues' => 'Blues',
								 'Boomba' => 'Boomba',
								 'Country' => 'Country',
								 'Cultural' => 'Cultural',
								 'EDM' => 'EDM',
								 'Genge' => 'Genge',
								 'Gospel' => 'Gospel',
								 'Hiphop' => 'Hiphop',
								 'Jazz' => 'Jazz',
								 'Music of Kenya' => 'Music of Kenya',
								 'Pop' => 'Pop',
								 'R&B' => 'R&B',
								 'Rock' => 'Rock',
								 'Sesube' => 'Sesube',
								 'Taarab' => 'Taarab'
								 ], null, ['class' => 'form-control', 'placeholder' => $video->genre]) }}
                        <br>
                        <br>
                        {{ Form::label('Released', '', ['class' => 'float-left']) }}
                        {{ Form::date('video-released', '', ['class' => 'form-control']) }}
                        <br>
                        {{-- {{ Form::label('Video thumbnail', '', ['class' => 'float-left']) }}
                        {{ Form::file('vArt', ['class' => 'form-control', 'accept' => 'image/*']) }}
                        <br>
                        <br> --}}
                        {{ Form::label('Video description', '', ['class' => 'float-left']) }}
                        {{ Form::textarea('description', '', 
						['class' => 'form-control', 'cols' => '30', 'rows' => '10', 'placeholder' => $video->description]) }}
                        {{ Form::reset('reset', ['class' => 'sonar-btn']) }}
                        <br>
                        <br>
                        {{ Form::submit('save changes', ['class' => 'sonar-btn']) }}
                        {!! Form::close() !!}
                        <br>
                        <a href='/charts/{{ $video->id }}' class="btn sonar-btn">go to song</a>
                        <br>
                        <br>
                        <a href='/videos' class="btn sonar-btn">studio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('inc/bottomnav')
@endsection
