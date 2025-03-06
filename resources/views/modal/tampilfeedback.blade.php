 <!-- Feedback Modal -->
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
                            <p>
                                @switch($booking->rating)
                                    @case(1)
                                        1 - Poor
                                        @break
                                    @case(2)
                                        2 - Fair
                                        @break
                                    @case(3)
                                        3 - Good
                                        @break
                                    @case(4)
                                        4 - Very Good
                                        @break
                                    @case(5)
                                        5 - Excellent
                                        @break
                                    @default
                                        No rating yet.
                                @endswitch
                            </p>
                        </div>
                        <div class="mb-3">
                            <label for="feedback_message{{ $booking->id }}" class="form-label">Message</label>
                            <textarea class="form-control" id="feedback_message{{ $booking->id }}" name="feedback_message" rows="3" readonly>{{ $booking->feedback_message}}</textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>