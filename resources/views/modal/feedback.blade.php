<div class="modal fade" id="feedbackModal{{ $booking->id }}" tabindex="-1" aria-labelledby="feedbackModalLabel{{ $booking->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel{{ $booking->id }}">Feedback for Booking #{{ $booking->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('feedback.submit', $booking->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="rating{{ $booking->id }}" class="form-label">Rating</label>
                        <br><select class="form-select" id="rating{{ $booking->id }}" name="rating" required>
                            <option value="1" {{ $booking->rating == 1 ? 'selected' : '' }}>1 - Poor</option>
                            <option value="2" {{ $booking->rating == 2 ? 'selected' : '' }}>2 - Fair</option>
                            <option value="3" {{ $booking->rating == 3 ? 'selected' : '' }}>3 - Good</option>
                            <option value="4" {{ $booking->rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
                            <option value="5" {{ $booking->rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <br><br><label for="feedback_message{{ $booking->id }}" class="form-label">Message</label>
                        <textarea class="form-control" id="feedback_message{{ $booking->id }}" name="feedback_message" rows="3" required>{{ $booking->feedback_message ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </form>
            </div>
        </div>
    </div>
</div>