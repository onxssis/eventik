<section class="section">
  <div class="container">
    <h1 class="title is-4">Popular Events in {{ $location }}</h1>

    <div class="columns is-multiline">
      @each('home.partials.single-event', $eventsNearby, 'event', 'home.partials.no-events')
    </div>

  </div>
</section>