@extends('layouts.master')

@section('main-class', 'show')

@section('content')

    <section class="show-event">
        <div class="container">

            <header class="m-t-lg event-head has-background-white p-b-lg">

                <div class="columns is-tablet head-columns">

                    <div class="column is-8 p-b-none p-t-none p-r-none">

                        <figure>
                            <img class="image" src="{{ asset('storage/' . $event->image) }}" alt="" style="height: 100%">
                        </figure>

                    </div>

                    <div class="column is-3 p-b-none p-t-none has-background-white" style="background-color: rgba(255,255,255,0.9);">

                        <div class="p-lg">

                            <div class="time-head">
                                <time>
                                    <p>Apr</p>
                                    <p>04</p>
                                </time>
                            </div>

                            <div class="time-body p-t-md">
                                <h1 class="is-uppercase">{{ $event->title }}</h1>

                                <div class="m-t-lg">
                                    <div class="l-media clrfix listing-organizer-title">
                                        <div class="l-align-left">
                                            <a href="#listing-organizer" class="js-d-scroll-to listing-organizer-name text-default" data-d-duration="1500" data-d-offset="-70" data-d-destination="#listing-organizer" dorsal-guid="09cfa659-d6b1-57ca-03c7-38a47db86d74" data-xd-wired="scroll-to">
                                                by {{ $event->user->name }}
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

                        <a class="button">
                            <span class="icon is-small">
                                <i class="far fa-bookmark"></i>
                            </span>
                        </a>
                    </div>

                    <div>
                        <button class="is-success button is-fullwidth-desktop ticker-button p-r-xl p-l-xl">
                            Register
                        </button>
                    </div>
                </div>

            </header>

            <div class="has-background-white">
                <div class="wrapper">

                        <div class="columns">
                            <div class="column is-7">
                                <aside>
                                    <h4 class="title is-6">Description</h4>

                                    <div>
                                        {!! $event->description !!}
                                    </div>
                                </aside>
                            </div>

                            <div class="column is-3 m-l-auto m-r-auto">

                                <aside>
                                    <h4 class="title is-6">Date and Time</h4>

                                    <div class="event-details__data m-b-md">
                                        <meta content="2019-07-20T08:00:00+01:00">
                                        <meta content="2019-07-20T16:00:00+01:00">
                                        <time class="clrfix" data-automation="event-details-time">
                                            <p>Sat, July 20, 2019</p>
                                            <p>8:00 AM – 4:00 PM WAT</p>
                                                <p class="hide-small hide-medium">
                                                    <a class="js-add-to-calendar-modal js-d-dialog-trigger" href="#add-to-calendar-modal" data-automation="add-to-calendar" role="button" aria-haspopup="true" dorsal-guid="4e221c02-457d-7c00-e435-a9567aa434e1" data-xd-wired="dialog-trigger">Add to Calendar</a>
                                                </p>
                                        </time>
                                    </div>

                                    <h4 class="title is-6">Location</h4>

                                    <div class="event-details__data">
                                        <p>{{ ucwords($event->address) }}</p>

                                        @if ($event->longitude != null)
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
                                    <i class="fab fa-facebook-f fa-inverse" data-fa-transform="shrink-3.5 down-1.6 right-1.25"></i>
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

                                <div class="profile-info p-t-lg p-b-lg">

                                    <h3 class="title is-5 is-uppercase has-text-danger is-spaced">{{ $event->user->name }}</h3>

                                    <p class="subtitle is-6 m-b-md">Organizer of <span class="is-uppercase">{{ $event->title }}</span></p>

                                    <div class="profile-social is-flex items-center justify-content-center">
                                        <span class="fa-1x m-l-md m-r-md is-flex items-center justify-content-center">
                                            <i class="fab fa-facebook m-r-xs has-text-danger"></i> profile
                                        </span>
                                        <span class="fa-1x m-l-md m-r-md is-flex items-center justify-content-center">
                                            <i class="fab fa-twitter m-r-xs has-text-danger"></i> profile
                                        </span>
                                    </div>

                                    <div class="m-t-md m-b-md">

                                        <button class="button is-medium p-l-lg p-r-lg">Contact</button>

                                    </div>

                                </div>
                            </div>

                            @if ($event->longitude != null)
                                <div id="map-target" class="column is-12 has-text-centered justify-content-center">
                                    MAP
                                </div>
                            @endif
                        </div>

                </div>
            </div>

        </div>
    </section>

@endsection