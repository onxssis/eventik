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
            <main class="browse-main">main content</main>
        </div>
        {{-- </div> --}}
</browse>
@endsection