<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dress;

class DressSeeder extends Seeder
{
    public function run(): void
    {
        $dresses = [
            ['name' => 'فستان حرير أحمر', 'category_id' => 1, 'status' => 'available', 'times_rented' => 5, 'price' => 120.00],
            ['name' => 'فستان زفاف أبيض', 'category_id' => 2, 'status' => 'rented', 'times_rented' => 8, 'price' => 300.00],
            ['name' => 'فستان حفلة أزرق', 'category_id' => 3, 'status' => 'washing', 'times_rented' => 3, 'price' => 80.00],
            ['name' => 'فستان تقليدي أخضر', 'category_id' => 4, 'status' => 'available', 'times_rented' => 2, 'price' => 100.00],
            ['name' => 'فستان كوكتيل أسود', 'category_id' => 5, 'status' => 'available', 'times_rented' => 7, 'price' => 150.00],
            ['name' => 'فستان طويل ذهبي', 'category_id' => 6, 'status' => 'rented', 'times_rented' => 4, 'price' => 250.00],
            ['name' => 'فستان عرائس وردي', 'category_id' => 7, 'status' => 'available', 'times_rented' => 6, 'price' => 400.00],
            ['name' => 'فستان مسائي بنفسجي', 'category_id' => 8, 'status' => 'washing', 'times_rented' => 9, 'price' => 180.00],
            ['name' => 'فستان كلاسيكي أبيض', 'category_id' => 9, 'status' => 'available', 'times_rented' => 3, 'price' => 130.00],
            ['name' => 'فستان عصري أحمر', 'category_id' => 10, 'status' => 'rented', 'times_rented' => 5, 'price' => 200.00],
            ['name' => 'فستان تراثي أخضر', 'category_id' => 11, 'status' => 'available', 'times_rented' => 2, 'price' => 90.00],
            ['name' => 'فستان رسمي أسود', 'category_id' => 12, 'status' => 'available', 'times_rented' => 4, 'price' => 160.00],
            ['name' => 'فستان صيفي أزرق', 'category_id' => 13, 'status' => 'rented', 'times_rented' => 6, 'price' => 110.00],
            ['name' => 'فستان شتوي بني', 'category_id' => 14, 'status' => 'washing', 'times_rented' => 3, 'price' => 140.00],
            ['name' => 'فستان مطرز ذهبي', 'category_id' => 15, 'status' => 'available', 'times_rented' => 8, 'price' => 220.00],
            ['name' => 'فستان سهرة فضي', 'category_id' => 1, 'status' => 'available', 'times_rented' => 4, 'price' => 170.00],
            ['name' => 'فستان زفاف كريمي', 'category_id' => 2, 'status' => 'rented', 'times_rented' => 7, 'price' => 350.00],
            ['name' => 'فستان حفلة وردي', 'category_id' => 3, 'status' => 'available', 'times_rented' => 5, 'price' => 95.00],
            ['name' => 'فستان تقليدي أزرق', 'category_id' => 4, 'status' => 'washing', 'times_rented' => 3, 'price' => 85.00],
            ['name' => 'فستان كوكتيل أحمر', 'category_id' => 5, 'status' => 'available', 'times_rented' => 6, 'price' => 135.00],
            ['name' => 'فستان طويل أسود', 'category_id' => 6, 'status' => 'rented', 'times_rented' => 9, 'price' => 280.00],
            ['name' => 'فستان عرائس أبيض', 'category_id' => 7, 'status' => 'available', 'times_rented' => 4, 'price' => 450.00],
            ['name' => 'فستان مسائي أخضر', 'category_id' => 8, 'status' => 'available', 'times_rented' => 2, 'price' => 165.00],
            ['name' => 'فستان كلاسيكي بني', 'category_id' => 9, 'status' => 'washing', 'times_rented' => 5, 'price' => 145.00],
            ['name' => 'فستان عصري أزرق', 'category_id' => 10, 'status' => 'available', 'times_rented' => 7, 'price' => 190.00],
        ];

        Dress::insert($dresses);
    }
} 