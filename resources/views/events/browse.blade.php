@extends('layouts.master')
@section('content')
<browse inline-template v-cloak>
    {{--
    <div class="container"> --}}
    <div class="browse">
        <div class="mobile-filter" @click="filterOpen = !filterOpen">
            <p>show filters</p>
        </div>
        <aside class="browse-aside ">
            <div class="tag-filters" :class="filterOpenClass">

                <button class="close" @click="filterOpen = false">Close</button>

                <h5>Filter by Access:</h5>
                <ul>
                    <li>
                        <a href="#">paid</a>
                    </li>
                    <li>
                        <a href="">free</a>
                    </li>
                </ul>

                <h5>Browse by Category:</h5>
                <ul>
                    <li>
                        <a href="">dwlkd</a>
                    </li>
                    <li>
                        <a href="">js frameworks</a>
                    </li>
                    <li>
                        <a href="">cdaslad</a>
                    </li>
                    <li>
                        <a href="">weoid</a>
                    </li>
                    <li>
                        <a href="">asdlas</a>
                    </li>
                    <li>
                        <a href="">qdlssd</a>
                    </li>
                </ul>

            </div>
        </aside>
        <main class="browse-main">
            <div class="filter-input">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                    <path
                        d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z" />
                </svg>
                <input type="text" placeholder="Filter Search">
                <div class="focus-line"></div>
            </div>

            <div class="events-grid">
                {{-- @foreach ($events as $event) --}}
                <a href="">
                    <article>
                        <div class="cont">
                            <div class="img-hold">
                                <img src="https://img.evbuc.com/https%3A%2F%2Fcdn.evbuc.com%2Fimages%2F56927247%2F2581145421%2F1%2Foriginal.20190216-200149?w=512&auto=compress&rect=0%2C0%2C2160%2C1080&s=acea6956bc433ee106e7096e703ef139"
                                    alt="">
                                <div class="free">Free</div>
                            </div>
                            <div class="aside">
                                <h4>Soulful Sundays Bay Area Edition</h4>
                                <div>
                                    <p>Sun, Jun 9, 2:00pm</p>
                                    <p>Complex Oakland, Oakland, CA</p>
                                    <p>Free</p>
                                </div>
                                <div class="buttons">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                        </svg>

                                    </div>

                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M6.28 3c3.236.001 4.973 3.491 5.72 5.031.75-1.547 2.469-5.021 5.726-5.021 2.058 0 4.274 1.309 4.274 4.182 0 3.442-4.744 7.851-10 13-5.258-5.151-10-9.559-10-13 0-2.676 1.965-4.193 4.28-4.192zm.001-2c-3.183 0-6.281 2.187-6.281 6.192 0 4.661 5.57 9.427 12 15.808 6.43-6.381 12-11.147 12-15.808 0-4.011-3.097-6.182-6.274-6.182-2.204 0-4.446 1.042-5.726 3.238-1.285-2.206-3.522-3.248-5.719-3.248z" />
                                        </svg>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </a>
                {{-- @endforeach --}}
            </div>
        </main>
    </div>
    {{-- </div> --}}
</browse>
@endsection