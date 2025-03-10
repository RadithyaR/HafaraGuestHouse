<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handleWebhookXendit(Request $request)
    {
        
        $data = $request->all();
        if (!isset($data['external_id']) || !isset($data['status']) || !isset($data['payment_method'])) {
            return response()->json(['message' => 'Invalid data'], 400);
        }
        
        $external_ids = explode(',', $data['external_id']);
        $status = strtolower($data['status']);

        $payments = Payment::whereIn('external_id', $external_ids)->get();
        
        if ($payments->isEmpty()) {
            return response()->json(['message' => 'Payments not found'], 404);
        }

        foreach ($payments as $payment) {
            $payment->update([
                'status' => $status,
            ]);
        }

        return response()->json([
            'message' => 'Webhook received',
            'status' => $status,
            'payment' => $payments->toArray()
        ]);
    }
}
