@extends('layouts/app')

@section('content')
@include('inc/topnav')

<!-- Preloader Start -->
<div id="preloader">
    <div class="preload-content">
        <div id="sonar-load"></div>
    </div>
</div>
<!-- Preloader End -->

<!-- Grids -->
<div class="grids d-flex justify-content-between">
    <div class="grid1"></div>
    <div class="grid2"></div>
    <div class="grid3"></div>
    <div class="grid4"></div>
    <div class="grid5"></div>
    <div class="grid6"></div>
    <div class="grid7"></div>
    <div class="grid8"></div>
    <div class="grid9"></div>
</div>

<br>
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
                    <h2>Upload your audio</h2>
                    <h5>It's free</h5>
                    <br>
                    <div class="form-group">
                        {!! Form::open(['action' => ['AudiosController@update', $audio->id],
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data']) !!}
                        {{ Form::hidden('_method', 'PUT') }}
                        <br>
                        <br>
                        {{ Form::text('audio-name', '', ['class' => 'form-control', 'placeholder' => $audio->name, ]) }}
                        <br>
                        {{ Form::text('ft', '', ['class' => 'form-control', 'placeholder' => $audio->ft]) }}
                        <br>
                        <select name='audio-album' class='form-control'>
                            <option hidden disabled selected value>
                                @if($audio->album != 'Single'
                                    && $audio->album != '')
                                    {{ $audio->audio_albums->name }}
                                @else
                                    {{ $audio->album }}
                                @endif
                            </option>
                            <option value="Single">Single</option>
                            @foreach($audioAlbums as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <br>
                        {{ Form::select('audio-genre', [
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
								 ], null, ['class' => 'form-control', 'placeholder' => $audio->genre,]) }}
                        <br>
                        <br>
                        <label>Audio Cover</label>
                        {{ Form::file('audio-thumbnail', ['class' => 'form-control', 'accept' => 'image/*', ]) }}
                        <br>
                        <br>
                        <label>Released</label>
                        {{ Form::date('released', '', ['class' => 'form-control', 'placeholder' => 'Released', ]) }}
                        <br>
                        <br>
                        {{ Form::textarea('audio-description', '', [
							'class' => 'form-control', 
							'cols' => '30', 
							'rows' => '10', 
							'placeholder' => $audio->description, 
							]) }}
                        <label>Upload Audio</label>
                        {{ Form::file('audio', ['class' => 'form-control', 'accept' => 'audio/*', ]) }}
                        <br>
                        <br>
                        {{ Form::reset('reset', ['class' => 'sonar-btn']) }}
                        <br>
                        <br>
                        {{ Form::submit('save changes', ['class' => 'sonar-btn']) }}
                        {!! Form::close() !!}
                        <br>
                        <a href="/audios" class="btn sonar-btn">go to audios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Filepond plugin, add before </body> -->
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

{{-- Replaces input with a css version of Filepond --}}
<script>
    const inputElement = document.querySelector('input[name="audio-try"]');
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
        server: {
            url: '/audios',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });

</script>
@include('inc/bottomnav')
@endsection
