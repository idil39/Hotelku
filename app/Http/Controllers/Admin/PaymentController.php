<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Menampilkan semua pembayaran
     */
    public function index()
    {
        $payments = Payment::with([
            'booking.user',
            'booking.room.roomType'
        ])
        ->latest()
        ->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Detail pembayaran
     */
    public function show(Payment $payment)
    {
        $payment->load([
            'booking.user',
            'booking.room.roomType'
        ]);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Approve pembayaran
     */
    public function approve(Payment $payment)
    {
        $payment->update([
            'status' => 'paid',
        ]);

        $payment->booking->update([
            'status' => 'confirmed',
        ]);

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil disetujui.');
    }

    /**
     * Reject pembayaran
     */
    public function reject(Payment $payment)
    {
        $payment->update([
            'status' => 'failed',
        ]);

        $payment->booking->update([
            'status' => 'pending',
        ]);

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil ditolak.');
    }
}