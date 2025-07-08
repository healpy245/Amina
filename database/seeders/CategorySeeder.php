<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'فستان سهرة', 'description' => 'فساتين أنيقة للمناسبات المسائية.'],
            ['name' => 'فستان زفاف', 'description' => 'فساتين جميلة لحفلات الزفاف.'],
            ['name' => 'فستان حفلة', 'description' => 'فساتين عصرية وممتعة للحفلات.'],
            ['name' => 'فستان تقليدي', 'description' => 'فساتين كلاسيكية وتراثية.'],
            ['name' => 'فستان كوكتيل', 'description' => 'فساتين قصيرة للمناسبات الرسمية.'],
            ['name' => 'فستان طويل', 'description' => 'فساتين طويلة للمناسبات الخاصة.'],
            ['name' => 'فستان عرائس', 'description' => 'فساتين مخصصة للعرائس.'],
            ['name' => 'فستان مسائي', 'description' => 'فساتين أنيقة للمناسبات المسائية.'],
            ['name' => 'فستان كلاسيكي', 'description' => 'فساتين كلاسيكية أنيقة.'],
            ['name' => 'فستان عصري', 'description' => 'فساتين عصرية وحديثة.'],
            ['name' => 'فستان تراثي', 'description' => 'فساتين تراثية تقليدية.'],
            ['name' => 'فستان رسمي', 'description' => 'فساتين رسمية للمناسبات المهمة.'],
            ['name' => 'فستان صيفي', 'description' => 'فساتين خفيفة ومناسبة للصيف.'],
            ['name' => 'فستان شتوي', 'description' => 'فساتين دافئة ومناسبة للشتاء.'],
            ['name' => 'فستان مطرز', 'description' => 'فساتين مزخرفة بالتطريز.'],
        ];

        Category::insert($categories);
    }
} 