@extends('layouts.master')
@section('main-class', 'show')
@section('content')

<section class="show-event">
    <img src="{{ $event->image }}" alt="blurred bg" class="blurred-bg-img is-hidden-mobile"
        style="border-bottom: 1px solid black;">
    <div class="container">

        <header class="event-head has-background-white p-b-lg">

            <div class="event-head-inner">

                <div class="left">

                    <figure>
                        <img class="event-image" src="{{ $event->image }}" alt="{{ $event->title }}" />
                    </figure>

                </div>

                <div class="right has-background-light">

                    <div class="p-lg">

                        <div class="time-head">
                            <time>
                                <p>{{ $event->start_date->format('M') }}</p>
                                <p>{{ $event->start_date->format('d') }}</p>
                            </time>
                        </div>

                        <div class="time-body p-t-md">
                            <h1 class="is-uppercase title is-size-4">{{ $event->title }}</h1>

                            <div class="m-t-lg">
                                <div class="l-media clrfix listing-organizer-title">
                                    <div class="l-align-left">
                                        by
                                        <a href="#listing-organizer">
                                            {{ $event->user->name }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="is-flex event-head-footer p-md">
                <div>
                    <a class="button">
                        <span class="icon is-small">
                            <i class="fas fa-share-alt"></i>
                        </span>
                    </a>

                    <bookmark :bookmarked="{{ json_encode($event->isBookmarked) }}" :id="{{ $event->id }}"
                        :auth="{{ json_encode(Auth::check()) }}">
                    </bookmark>
                </div>

                <div>
                    <attend-event :active="{{ json_encode($event->isAttending) }}" :event-id="{{ $event->id }}"
                        :auth="{{ json_encode(Auth::check()) }}">
                    </attend-event>
                </div>
            </div>

        </header>

        <div class="has-background-white">
            <div class="container is-fluid">

                <div class="columns">
                    <div class="column is-8">
                        <aside>
                            <h4 class="title is-6">Description</h4>

                            <div>
                                {!! $event->description !!}
                            </div>
                        </aside>
                    </div>

                    <div class="column is-4 m-l-auto m-r-auto">

                        <aside>
                            <h4 class="title is-6">Date and Time</h4>

                            <div class="event-details__data m-b-md">
                                <meta content="2019-07-20T08:00:00+01:00">
                                <meta content="2019-07-20T16:00:00+01:00">
                                <time class="clrfix" data-automation="event-details-time">
                                    <p>{{ $event->start_date->format('D, M d, Y') }}</p>
                                    <p>{{ $event->start_date->format('h:i A') }} – {{ $event->start_date->format('h:i A') }}</p>
                                    <p class="hide-small hide-medium m-t-md is-hidden">
                                        <a>Add to Calendar</a>
                                    </p>
                                </time>
                            </div>

                            <h4 class="title is-6">Location</h4>

                            <div class="event-details__data">
                                <p>{{ ucwords($event->address) }}</p>

                                @if ($event->location['lng'] != null)
                                <p class="m-t-md">
                                    <a class="" href="#map-target">View Map</a>
                                </p>
                                @endif

                            </div>
                        </aside>
                    </div>



                </div>

                <div class="share-wrapper p-t-lg p-b-lg">

                    <h5 class="m-b-sm">Share With Friends</h5>
                    <div class="is-flex">
                        <span class="fa-layers fa-3x m-r-xs" style="color: #f05537">
                            <i class="fa fa-circle"></i>
                            <i class="fab fa-facebook-f fa-inverse"
                                data-fa-transform="shrink-3.5 down-1.6 right-1.25"></i>
                        </span>

                        <span class="fa-layers fa-3x m-r-xs" style="color: #f05537">
                            <i class="fa fa-circle"></i>
                            <i class="fab fa-twitter fa-inverse" data-fa-transform="shrink-6 down-.25 right-.25"></i>
                        </span>


                        <span class="fa-layers fa-3x" style="color: #f05537">
                            <i class="fa fa-circle"></i>
                            <i class="fa fa-envelope fa-inverse" data-fa-transform="shrink-6"></i>
                        </span>
                    </div>

                </div>

                <div class="colums">
                    <div class="column is-12 has-text-centered justify-content-center">

                        @if ($event->location['lng'] != null)
                        <div id="map-target" class="column is-12 has-text-centered justify-content-center"
                            style="height: 500px">
                            <event-map :lat="{{ $event->location['lat'] }}" :lng="{{ $event->location['lng'] }}"
                                :events="[{{ $event }}]">
                            </event-map>
                        </div>
                        @endif

                    </div>


                </div>

            </div>
        </div>

    </div>
</section>
@endsection