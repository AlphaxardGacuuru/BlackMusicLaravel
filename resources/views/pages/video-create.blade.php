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

<!-- ***** Call to Action Area Start ***** -->
<div class="sonar-call-to-action-area section-padding-0-100">
    <div class="backEnd-content">
        <h2>Studio</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-form text-center call-to-action-content wow fadeInUp" data-wow-delay="0.5s">
                    <h2>Upload your video</h2>
                    <h5>It's free</h5>
                    <br>
                    <div class="form-group">
                        {!! Form::open(['action' => 'VideosController@store', 'method' => 'POST', 'enctype' =>
                        'multipart/form-data']) !!}
                        {{ Form::text('video', '', ['class' => 'form-control', 'placeholder' => 'Video URL from YouTube', 'required']) }}
                        <br>
                        {{ Form::text('video-name', '', ['class' => 'form-control', 'placeholder' => 'Video name', 'required']) }}
                        <br>
                        {{ Form::text('ft', '', ['class' => 'form-control', 'placeholder' => 'Featuring Artist e.g. @JohnDoe']) }}
                        <br>
                        <select name='video-album' class='form-control'>
                            <option value="Single">Single</option>
                            @foreach($videoAlbums as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <br>
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
								 ], null, ['class' => 'form-control', 'placeholder' => 'Select song genre', 'required']) }}
                        <br>
                        <br>
                        <label for="">Released</label>
                        {{ Form::date('video-released', '', ['class' => 'form-control', 'placeholder' => 'Released', 'required']) }}
                        <br>
                        <br>
                        {{ Form::textarea('video-description', '', [
							'class' => 'form-control', 
							'cols' => '30', 
							'rows' => '10', 
							'placeholder' => 'Say something about your song', 'required'
							]) }}
                        {{-- <label>Upload Video</label>
                        {{ Form::file('video', ['class' => 'form-control', 'accept' => 'video/*', 'required']) }}
                        <br>
                        <br> --}}
                        {{ Form::reset('reset', ['class' => 'sonar-btn']) }}
                        <br>
                        <br>

                        {{-- Collapse --}}
                        <button class="sonar-btn" type="button" data-toggle="collapse" data-target="#collapseExample"
                            aria-expanded="false" aria-controls="collapseExample">
                            next
                        </button>
                        <div class="collapse" id="collapseExample">
                            <div class="">
                                <br>
                                <h3>Before you upload</h3>
                                <h6>By uploading you agree that you <b>own</b> this song.</h6>
                                <h6>Videos are sold at
                                    <b style="color: green;">KES 200</b>, Black Music takes
                                    <b style="color: green;">50% (KES 100)</b> and the musician takes
                                    <b style="color: green;">50% (KES 100)</b>.</h6>
                                <h6>You will be paid
                                    <b>weekly</b>, via Mpesa to
                                    <b style='color: dodgerblue;'>{{ auth()->user()->phone }}</b>.
                                </h6>
                                <br>
                                {{ Form::submit('upload video', ['class' => 'sonar-btn']) }}
                            </div>
                        </div>
                        {{-- Collapse End --}}
                        {!! Form::close() !!}
                        <br>
                        <a href="/videos" class="btn sonar-btn">studio</a>
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
    const inputElement = document.querySelector('input[name="video-try"]');
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
        server: {
            url: '/videos',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });

</script>
@include('inc/bottomnav')
@endsection
