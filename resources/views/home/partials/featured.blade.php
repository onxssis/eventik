<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Upcoming Events</h1>

        <div class="columns">
            @foreach ($events as $event)

            <div class="column is-4">
                <a href="{{ route('events.show', $event->slug) }}">
                    <div class="card featured-card is-horizontal">
                        <div class="card-image">
                            <img src="https://img.evbuc.com/https%3A%2F%2Fcdn.evbuc.com%2Fimages%2F36851225%2F199130051817%2F1%2Foriginal.jpg?w=800&rect=0%2C132%2C1586%2C793&s=a81d8dd23f122c65ae3497d2dc95b528" alt="">
                            {{-- <img src="{{ $event->image }}" alt=""> --}}
                        </div>

                        <div class="card-content">
                            <div class="featured-card__meta">
                                <span>{{ $event->start_date }}</span>

                                <span class="featured-card__meta--fee">
                                    {!! $event->formattedPrice !!}
                                </span>
                            </div>

                            <div class="title">
                                {{ $event->title }}
                            </div>

                            <div class="subtitle">
                                <span>
                                    <i class="fas fa-map-marker-alt has-text-danger m-r-xs"></i>
                                </span>

                                <span>
                                    {{ $event->address }}
                                </span>
                            </div>

                            <div class="featured-card__footer">
                                <span class=>
                                    <a class="button">
                                        <span class="icon is-small">
                                            <i class="fas fa-share-alt"></i>
                                        </span>
                                    </a>
                                </span>

                                <span>
                                    <bookmark :bookmarked="{{ json_encode($event->isBookmarked) }}" :id="{{ $event->id }}"></bookmark>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @endforeach
        </div>

    </div>
</section> 