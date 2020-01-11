<section class="section">
  <div class="container">
    <h1 class="title has-text-centered">Browse By Category</h1>

    <div class="columns">
      <div class="category-wrapper">

        @foreach ($categories as $category)
        <category-card :data="{{ $category }}"></category-card>
        @endforeach

      </div>
    </div>

  </div>
</section>