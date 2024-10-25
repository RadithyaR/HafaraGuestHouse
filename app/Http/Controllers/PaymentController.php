<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoices;
use Xendit\Invoice\InvoiceApi;
use Xendit\Xendit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function success($id)
    {
        $payment = Payment::where('external_id', $id)->first();
        if (!$payment) {
            return redirect()->route('home');
        }

        return view('payment.success', compact('payment'));
    }

    public function failure($id)
    {
        $payment = Payment::where('external_id', $id)->first();

        if (!$payment) {
            return redirect()->route('home');
        }

        return view('payment.failure', compact('payment'));
    }
}
