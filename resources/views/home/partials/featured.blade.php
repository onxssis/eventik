<section class="section">
    <div class="container">
        <h1 class="title is-4">Upcoming Events</h1>

        <div class="columns is-multiline">
            @each('home.partials.single-event', $events, 'event', 'home.partials.no-events')
        </div>

    </div>
</section>