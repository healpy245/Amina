<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Dress;
use App\Models\Client;
use App\Models\Appointment;
use App\Models\Contract;
use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic stats
        $stats = [
            'categories' => Category::count(),
            'dresses' => Dress::count(),
            'clients' => Client::count(),
            'appointments' => Appointment::count(),
            'contracts' => Contract::count(),
            'payments' => Payment::sum('amount'),
        ];

        // Monthly income
        $monthlyIncome = Payment::whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        // Monthly appointments
        $monthlyAppointments = Appointment::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();

        // Revenue trends (last 6 months)
        $revenueTrends = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $revenueTrends[] = [
                'month' => $date->format('M'),
                'amount' => Payment::whereMonth('paid_at', $date->month)
                    ->whereYear('paid_at', $date->year)
                    ->sum('amount')
            ];
        }

        // Appointment trends (last 6 months)
        $appointmentTrends = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $appointmentTrends[] = [
                'month' => $date->format('M'),
                'count' => Appointment::whereMonth('date', $date->month)
                    ->whereYear('date', $date->year)
                    ->count()
            ];
        }

        // Top performing categories
        $topCategories = Category::withCount('dresses')
            ->orderBy('dresses_count', 'desc')
            ->take(5)
            ->get();

        // Payment methods breakdown
        $paymentMethods = Payment::selectRaw('payment_method, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('payment_method')
            ->get()
            ->map(function ($item) {
                $methodNames = [
                    'cash' => 'نقداً',
                    'credit_card' => 'بطاقة ائتمان',
                    'bank_transfer' => 'تحويل بنكي'
                ];
                return [
                    'method' => $methodNames[$item->payment_method] ?? $item->payment_method,
                    'count' => $item->count,
                    'total' => $item->total
                ];
            });

        // Recent payments
        $recentPayments = Payment::with(['client', 'contract'])
            ->orderBy('paid_at', 'desc')
            ->take(5)
            ->get();

        // Recent appointments
        $recentAppointments = Appointment::with('client')
            ->orderBy('date', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'stats', 
            'monthlyIncome', 
            'monthlyAppointments',
            'revenueTrends',
            'appointmentTrends',
            'topCategories',
            'paymentMethods',
            'recentPayments',
            'recentAppointments'
        ));
    }
} 