<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function submit(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'feedback_message' => 'required|string|max:500',
        ]);

        // Temukan booking berdasarkan ID
        $booking = Booking::findOrFail($id);

        // Update kolom feedback
        $booking->update([
            'rating' => $request->rating,
            'feedback_message' => $request->feedback_message,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
}
