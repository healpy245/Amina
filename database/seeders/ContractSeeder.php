<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contract;

class ContractSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['مكتمل', 'معلق', 'ملغي'];
        $contracts = [];
        for ($i = 1; $i <= 20; $i++) {
            $contracts[] = [
                'client_id' => $i,
                'dress_id' => $i,
                'deposit_paid' => (bool)random_int(0, 1),
                'signed_at' => now()->subDays(21 - $i)->format('Y-m-d H:i:s'),
                'amount' => random_int(400, 1000),
                'start_date' => now()->addDays($i)->format('Y-m-d'),
                'end_date' => now()->addDays($i + 5)->format('Y-m-d'),
                'contract_number' => $i,
                'status' => $statuses[($i - 1) % 3],
            ];
        }

        Contract::insert($contracts);
    }
} 