<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Room;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan.
     */
    public function index()
    {
        $totalBookings = Booking::count();

        $totalCustomers = User::where('role', 'customer')->count();

        $totalRooms = Room::count();

        $totalIncome = Payment::where('status', 'paid')
            ->sum('amount');

        $payments = Payment::with([
                'booking.user',
                'booking.room.roomType'
            ])
            ->where('status', 'paid')
            ->latest()
            ->paginate(10);

        return view('admin.reports.index', compact(
            'totalBookings',
            'totalCustomers',
            'totalRooms',
            'totalIncome',
            'payments'
        ));
    }

    /**
     * Export laporan ke PDF.
     */
    public function exportPdf()
    {
        $payments = Payment::with([
                'booking.user',
                'booking.room.roomType'
            ])
            ->where('status', 'paid')
            ->latest()
            ->get();

        $totalBookings = Booking::count();

        $totalCustomers = User::where('role', 'customer')->count();

        $totalRooms = Room::count();

        $totalIncome = Payment::where('status', 'paid')
            ->sum('amount');

        $pdf = Pdf::loadView('admin.reports.pdf', compact(
            'payments',
            'totalBookings',
            'totalCustomers',
            'totalRooms',
            'totalIncome'
        ));

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan-HOTEL-ADIMULIA.pdf');
    }
}