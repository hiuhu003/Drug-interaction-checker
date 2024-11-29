

  <div class="max-w-3xl mx-auto p-6 mt-10 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">We'd love to hear your feedback!</h2>

    <form action="/review" method="POST">
      @csrf
      <div class="mb-4">
        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
        <input type="text" id="username" name="username" class="w-full p-3 border border-gray-300 rounded-md" required>
      </div>

      <div class="mb-4">
        <label for="review" class="block text-sm font-medium text-gray-700 mb-2">Share your review:</label>
        <textarea id="review" name="review" rows="4" class="block w-full p-3 border border-gray-300 rounded-md" placeholder="Write your review here..." required></textarea>
      </div>

      <div class="mb-4">
        <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rate your experience:</label>
        <div class="flex space-x-2">
          @for($i = 1; $i <= 5; $i++)
            <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}" class="form-radio text-yellow-500" required>
            <label for="rating-{{ $i }}">★</label>
          @endfor
        </div>
      </div>

      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Submit Review</button>
    </form>
  </div>
