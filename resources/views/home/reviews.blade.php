  <section id="reviews" class="max-w-3xl mx-auto p-6 mt-10 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">User Reviews</h2>
    
    @foreach($reviews as $review)
    <div class="review-card mb-4 p-4 border-b">
      <h3 class="text-lg font-semibold">{{ $review->username }}</h3>
      <p class="review-text text-gray-600 mb-2">{{ $review->review }}</p>
      <p class="review-rating">
        @for($i = 0; $i < $review->rating; $i++)
          ⭐
        @endfor
      </p>
    </div>
    @endforeach

  </section>


