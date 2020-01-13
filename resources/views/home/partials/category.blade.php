<section class="section" style="background: #f9f9f9;">
  <div class="container">
    <h1 class="title is-4">Browse By Category</h1>

    <div class="columns" style="position: relative;">
      <div class="category-wrapper">

        @foreach ($categories as $category)
        <category-card :data="{{ $category }}"></category-card>
        @endforeach

      </div>
    </div>

  </div>
</section>