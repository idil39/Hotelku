<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Daftar pembayaran customer
     */
    public function index()
    {
        $payments = Payment::with([
                'booking.room.roomType'
            ])
            ->whereHas('booking', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('customer.payment.index', compact('payments'));
    }

    /**
     * Form upload pembayaran
     */
    public function create(Booking $booking)
    {
        if ($booking->user_id != auth()->id()) {
            abort(403);
        }

        if ($booking->payment) {
            return redirect()
                ->route('customer.history')
                ->with('error', 'Booking ini sudah memiliki pembayaran.');
        }

        return view('customer.payment.create', compact('booking'));
    }

    /**
     * Simpan pembayaran
     */
    public function store(Request $request, Booking $booking)
    {
        if ($booking->user_id != auth()->id()) {
            abort(403);
        }

        if ($booking->payment) {
            return redirect()
                ->route('customer.history')
                ->with('error', 'Pembayaran sudah pernah dikirim.');
        }

        $request->validate([
            'payment_method' => 'required|string',
            'proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $proof = $request->file('proof')->store('payments', 'public');

        Payment::create([
            'booking_id'      => $booking->id,
            'amount'          => $booking->total_price,
            'payment_method'  => $request->payment_method,
            'proof'           => $proof,
            'status'          => 'pending',
        ]);

        return redirect()
            ->route('customer.payment.index')
            ->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu konfirmasi admin.');
    }

    /**
     * Detail pembayaran
     */
    public function show(Payment $payment)
    {
        if ($payment->booking->user_id != auth()->id()) {
            abort(403);
        }

        $payment->load([
            'booking.room.roomType'
        ]);

        return view('customer.payment.show', compact('payment'));
    }
}