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
        $id = explode(',', $id);
        $payment = Payment::whereIn('external_id', $id)->get();
        if (!$payment) {
            return redirect()->route('home');
        }

        $payment = $payment->first();
        $payment->external_id = implode(',', $id);
        return view('payment.success', compact('payment'));
    }

    public function failure($id)
    {
        $id = explode(',', $id);
        $payment = Payment::whereIn('external_id', $id)->get();
        if (!$payment) {
            return redirect()->route('home');
        }

        $payment = $payment->first();
        $payment->external_id = implode(',', $id);

        return view('payment.failure', compact('payment'));
    }
}
