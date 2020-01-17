<div class="column is-3">
  <div class="card featured-card is-horizontal">
    <a href="{{ route('events.show', $event->slug) }}">
      <div class="card-image" style="background: url('{{ $event->image }}');">
        <div class="card-image-cast"></div>
        {{-- <img src="https://img.evbuc.com/https%3A%2F%2Fcdn.evbuc.com%2Fimages%2F36851225%2F199130051817%2F1%2Foriginal.jpg?w=800&rect=0%2C132%2C1586%2C793&s=a81d8dd23f122c65ae3497d2dc95b528" alt=""> --}}
      </div>

      <div class="card-content">
        <div class="featured-card__meta">
          <span>{{ $event->formattedDate }}</span>

          {{-- <span class="featured-card__meta--fee">
                  {!! $event->formattedPrice !!}
              </span> --}}
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
          <span>
            <a class="button" style="margin-right: 0.5rem;">
              <span class="icon is-small">
                <i class="fas fa-share-alt"></i>
              </span>
            </a>
          </span>

          <span>
            <bookmark :bookmarked="{{ json_encode($event->isBookmarked) }}" :id="{{ $event->id }}">
            </bookmark>
          </span>
        </div>
      </div>
    </a>
  </div>
</div>