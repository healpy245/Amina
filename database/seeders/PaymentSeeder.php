<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $payments = [
            ['client_id' => 1, 'contract_id' => 1, 'amount' => 100.00, 'deposit' => 200, 'payment_number' => '1', 'status' => 'مكتمل', 'payment_method' => 'cash', 'paid_at' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s')],
            ['client_id' => 2, 'contract_id' => 2, 'amount' => 200.00, 'deposit' => 300, 'payment_number' => '2', 'status' => 'معلق', 'payment_method' => 'credit_card', 'paid_at' => Carbon::now()->subDays(10)->format('Y-m-d H:i:s')],
            ['client_id' => 3, 'contract_id' => 3, 'amount' => 150.00, 'deposit' => 30, 'payment_number' => '3', 'status' => 'ملغي', 'payment_method' => 'bank_transfer', 'paid_at' => Carbon::now()->subDays(15)->format('Y-m-d H:i:s')],
            ['client_id' => 4, 'contract_id' => 4, 'amount' => 120.00, 'deposit' => 20, 'payment_number' => '4', 'status' => 'مكتمل', 'payment_method' => 'cash', 'paid_at' => Carbon::now()->subDays(20)->format('Y-m-d H:i:s')],
            ['client_id' => 5, 'contract_id' => 5, 'amount' => 180.00, 'deposit' => 30, 'payment_number' => '5', 'status' => 'معلق', 'payment_method' => 'credit_card', 'paid_at' => Carbon::now()->subDays(25)->format('Y-m-d H:i:s')],
            ['client_id' => 6, 'contract_id' => 6, 'amount' => 250.00, 'deposit' => 50, 'payment_number' => '6', 'status' => 'ملغي', 'payment_method' => 'bank_transfer', 'paid_at' => Carbon::now()->subDays(30)->format('Y-m-d H:i:s')],
            ['client_id' => 7, 'contract_id' => 7, 'amount' => 400.00, 'deposit' => 80, 'payment_number' => '7', 'status' => 'مكتمل', 'payment_method' => 'cash', 'paid_at' => Carbon::now()->subMonths(1)->format('Y-m-d H:i:s')],
            ['client_id' => 8, 'contract_id' => 8, 'amount' => 180.00, 'deposit' => 30, 'payment_number' => '8', 'status' => 'معلق', 'payment_method' => 'credit_card', 'paid_at' => Carbon::now()->subMonths(1)->subDays(5)->format('Y-m-d H:i:s')],
            ['client_id' => 9, 'contract_id' => 9, 'amount' => 130.00, 'deposit' => 20, 'payment_number' => '9', 'status' => 'ملغي', 'payment_method' => 'bank_transfer', 'paid_at' => Carbon::now()->subMonths(1)->subDays(10)->format('Y-m-d H:i:s')],
            ['client_id' => 10, 'contract_id' => 10, 'amount' => 200.00, 'deposit' => 40, 'payment_number' => '10', 'status' => 'مكتمل', 'payment_method' => 'cash', 'paid_at' => Carbon::now()->subMonths(2)->format('Y-m-d H:i:s')],
            ['client_id' => 11, 'contract_id' => 11, 'amount' => 90.00, 'deposit' => 10, 'payment_number' => '11', 'status' => 'معلق', 'payment_method' => 'credit_card', 'paid_at' => Carbon::now()->subMonths(2)->subDays(5)->format('Y-m-d H:i:s')],
            ['client_id' => 12, 'contract_id' => 12, 'amount' => 160.00, 'deposit' => 20, 'payment_number' => '12', 'status' => 'ملغي', 'payment_method' => 'bank_transfer', 'paid_at' => Carbon::now()->subMonths(2)->subDays(10)->format('Y-m-d H:i:s')],
            ['client_id' => 13, 'contract_id' => 13, 'amount' => 110.00, 'deposit' => 10, 'payment_number' => '13', 'status' => 'مكتمل', 'payment_method' => 'cash', 'paid_at' => Carbon::now()->subMonths(3)->format('Y-m-d H:i:s')],
            ['client_id' => 14, 'contract_id' => 14, 'amount' => 140.00, 'deposit' => 20, 'payment_number' => '14', 'status' => 'معلق', 'payment_method' => 'credit_card', 'paid_at' => Carbon::now()->subMonths(3)->subDays(5)->format('Y-m-d H:i:s')],
            ['client_id' => 15, 'contract_id' => 15, 'amount' => 220.00, 'deposit' => 40, 'payment_number' => '15', 'status' => 'ملغي', 'payment_method' => 'bank_transfer', 'paid_at' => Carbon::now()->subMonths(4)->format('Y-m-d H:i:s')],
            ['client_id' => 16, 'contract_id' => 16, 'amount' => 170.00, 'deposit' => 20, 'payment_number' => '16', 'status' => 'مكتمل', 'payment_method' => 'cash', 'paid_at' => Carbon::now()->subMonths(4)->subDays(5)->format('Y-m-d H:i:s')],
            ['client_id' => 17, 'contract_id' => 17, 'amount' => 350.00, 'deposit' => 60, 'payment_number' => '17', 'status' => 'معلق', 'payment_method' => 'credit_card', 'paid_at' => Carbon::now()->subMonths(5)->format('Y-m-d H:i:s')],
            ['client_id' => 18, 'contract_id' => 18, 'amount' => 95.00, 'deposit' => 10, 'payment_number' => '18', 'status' => 'ملغي', 'payment_method' => 'bank_transfer', 'paid_at' => Carbon::now()->subMonths(5)->subDays(5)->format('Y-m-d H:i:s')],
            ['client_id' => 19, 'contract_id' => 19, 'amount' => 85.00, 'deposit' => 10, 'payment_number' => '19', 'status' => 'مكتمل', 'payment_method' => 'cash', 'paid_at' => Carbon::now()->subMonths(5)->subDays(10)->format('Y-m-d H:i:s')],
            ['client_id' => 20, 'contract_id' => 20, 'amount' => 135.00, 'deposit' => 20, 'payment_number' => '20', 'status' => 'معلق', 'payment_method' => 'credit_card', 'paid_at' => Carbon::now()->subMonths(5)->subDays(15)->format('Y-m-d H:i:s')],
        ];

        Payment::insert($payments);
    }
} 