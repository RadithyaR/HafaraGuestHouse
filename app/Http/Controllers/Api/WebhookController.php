<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment; // Import model Payment
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handleWebhookXendit(Request $request)
    {
        $data = $request->all();
        
        if (!isset($data['external_id']) || !isset($data['status']) || !isset($data['payment_method'])) {
            return response()->json(['message' => 'Invalid data'], 400);
        }

        $external_id = $data['external_id'];
        $status = strtolower($data['status']);
        $payment_method = $data['payment_method'];

        $payment = Payment::where('external_id', $external_id);

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->update([
            'status' => $status,
        ]);

        return response()->json([
            'message' => 'Webhook received',
            'status' => $status,
            'payment_method' => $payment_method,
            'payment' => $payment
        ]);
    }
}
