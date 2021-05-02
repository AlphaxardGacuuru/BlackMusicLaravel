@extends('layouts/app')

@section('content')
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <div class="contact-form">
            {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' =>
            'multipart/form-data']) !!}
            <div class="float-left">
                <a href="/posts">
                    <!-- Close Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-x"
                        viewBox="0 0 16 16">
                        <path
                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </a>
            </div>
            <div class="form group float-right">
                {{ Form::submit('post', ['class' => 'btn mysonar-btn']) }}
            </div>
            {{ Form::textarea('post-text', '', ['class' => 'form-control', 'placeholder' => "What's on your mind"]) }}
            {{ Form::file('post-media', ['id' => 'post-media', 'style' => 'display: none;']) }}
            <div class="d-flex text-center">
                <div class="p-2 flex-fill" style="background-color: #232323;">
                    <a href="#" style="color: white;" onclick="document.getElementById('post-media').click();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-image" viewBox="0 0 16 16">
                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            <path
                                d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                        </svg>
                    </a>
                </div>
                <div class="p-2 flex-fill" style="background-color: #232323;">
                    <a href="#collapseExample" style="color: white;" data-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="collapseExample">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-bar-chart" viewBox="0 0 16 16">
                            <path
                                d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="collapse" id="collapseExample">
                <label>
                    {{ Form::text('text', '', ['name' => 'poll_1', 'class' => 'form-control', 'placeholder' => "Parameter 1", 'oninput' => 'inputPara2()']) }}
                </label>
                <label id='para-2'></label>
                <label id='para-3'></label>
                <label id='para-4'></label>
                <label id='para-5'></label>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="col-sm-4"></div>
</div>
@endsection
