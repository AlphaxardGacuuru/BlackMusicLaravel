<!-- bottom nav -->
<div class="row" style="margin: 0px; padding: 0px;">
    <div class="col-sm-12" style="margin: 0px; padding: 0px;">
        <div class="bottomNav menu-content-area header-social-area">
            <div class="container-fluid menu-area d-flex justify-content-between">
                <a href="/posts" style="color:<?php if(Route::is('posts.index')){echo 'gold';}else{echo 'white';}?>; text-align:
                    center; font-size: 10px; font-weight: 100;">
                    <span style="font-size: 20px; margin: 0;" class="nav-link">
                        <svg class="bi bi-house" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                            <path fill-rule="evenodd"
                                d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                        </svg>
                    </span>
                </a>
                @php
                    $mystring = url()->current();
                    if(strpos($mystring, "charts") !== false){
                    $colour = "gold";
                    } elseif (strpos($mystring, "search") !== false) {
                    $colour = "gold";
                    } elseif (strpos($mystring, "cart") !== false) {
                    $colour = "gold";
                    } else {
                    $colour = "white";
                    }
                @endphp
                <a href="/video-charts/newlyReleased/All" style="color: <?php if(Route::is('charts.index')){echo 'gold';}else{echo 'white';}?>; text-align:
                    center; font-size: 10px; font-weight: 100;">
                    <span style="font-size: 20px;" class="nav-link">
                        <svg class="bi bi-compass" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 15.016a6.5 6.5 0 1 0 0-13 6.5 6.5 0 0 0 0 13zm0 1a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z" />
                            <path
                                d="M6 1a1 1 0 0 1 1-1h2a1 1 0 0 1 0 2H7a1 1 0 0 1-1-1zm.94 6.44l4.95-2.83-2.83 4.95-4.95 2.83 2.83-4.95z" />
                        </svg>
                    </span>
                </a>
                <div style="display: none;">
                    {!!Form::open(['id' => 'search-form', 'action' => 'SearchController@store', 'method' => 'POST'])!!}
                    {{ Form::hidden('search', '') }}
                    {!!Form::close()!!}
                </div>
                @if(Route::is('search.store'))
                    <a href="#" style="color: gold; text-align: center; font-size: 10px; font-weight: 100;"
                        onclick="$('#search').focus()">
                        <span style="font-size: 20px;" class="nav-link">
                            <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                <path fill-rule="evenodd"
                                    d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                            </svg>
                        </span>
                    </a>
                @else
                    <a href="search" style="color: white; text-align: center; font-size: 10px; font-weight: 100;"
                        onclick='event.preventDefault(); document.getElementById("search-form").submit();'>
                        <span style="font-size: 20px;" class="nav-link">
                            <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                                <path fill-rule="evenodd"
                                    d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                            </svg>
                        </span>
                    </a>
                @endif
                <a href="/cart"
                    style="color: <?php if(Route::is('cart.index')){echo 'gold';}else{echo 'white';}?>; text-align: center; font-size: 10px; font-weight: 100;">
                    <span style="font-size: 20px;" class="nav-link">
                        <svg class="bi bi-cart3" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>
                    </span>
                </a>
                <a href="/library"
                    style="color: <?php if(Route::is('library.index')){echo 'gold';}else{echo 'white';}?>; text-align: center; font-size: 10px; font-weight: 100;">
                    <span style="font-size: 20px;" class="nav-link">
                        <svg class="bi bi-person" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 0 0 .014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 0 0 .022.004zm9.974.056v-.002.002zM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
