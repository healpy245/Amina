<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            ['name' => 'سارة أحمد', 'phone' => '555-1234', 'email' => 'sarah@example.com', 'notes' => 'تفضل المواعيد المسائية.', 'country' => 'فلسطين'],
            ['name' => 'إيميلي سميث', 'phone' => '555-5678', 'email' => 'emily@example.com', 'notes' => 'تعاني من حساسية لبعض الأقمشة.', 'country' => 'فلسطين'],
            ['name' => 'أوليفيا براون', 'phone' => '555-8765', 'email' => 'olivia@example.com', 'notes' => 'عميلة مميزة.', 'country' => 'فلسطين'],
            ['name' => 'فاطمة محمد', 'phone' => '555-1111', 'email' => 'fatima@example.com', 'notes' => 'تفضل الفساتين التقليدية.', 'country' => 'فلسطين'],
            ['name' => 'نور الهدى', 'phone' => '555-2222', 'email' => 'nour@example.com', 'notes' => 'عميلة جديدة.', 'country' => 'فلسطين'],
            ['name' => 'مريم علي', 'phone' => '555-3333', 'email' => 'maryam@example.com', 'notes' => 'تفضل الألوان الفاتحة.', 'country' => 'فلسطين'],
            ['name' => 'زينب حسن', 'phone' => '555-4444', 'email' => 'zainab@example.com', 'notes' => 'عميلة منتظمة.', 'country' => 'فلسطين'],
            ['name' => 'خديجة أحمد', 'phone' => '555-5555', 'email' => 'khadija@example.com', 'notes' => 'تفضل الفساتين الطويلة.', 'country' => 'فلسطين'],
            ['name' => 'عائشة محمد', 'phone' => '555-6666', 'email' => 'aisha@example.com', 'notes' => 'عميلة مميزة.', 'country' => 'فلسطين'],
            ['name' => 'حفصة علي', 'phone' => '555-7777', 'email' => 'hafsa@example.com', 'notes' => 'تفضل المواعيد الصباحية.', 'country' => 'فلسطين'],
            ['name' => 'أسماء أحمد', 'phone' => '555-8888', 'email' => 'asma@example.com', 'notes' => 'عميلة جديدة.', 'country' => 'فلسطين'],
            ['name' => 'رنا محمد', 'phone' => '555-9999', 'email' => 'rana@example.com', 'notes' => 'تفضل الفساتين العصرية.', 'country' => 'فلسطين'],
            ['name' => 'ليلى علي', 'phone' => '555-0000', 'email' => 'layla@example.com', 'notes' => 'عميلة منتظمة.', 'country' => 'فلسطين'],
            ['name' => 'نورا أحمد', 'phone' => '555-1212', 'email' => 'nora@example.com', 'notes' => 'تفضل الألوان الداكنة.', 'country' => 'فلسطين'],
            ['name' => 'سلمى محمد', 'phone' => '555-1313', 'email' => 'salma@example.com', 'notes' => 'عميلة مميزة.', 'country' => 'فلسطين'],
            ['name' => 'يارا علي', 'phone' => '555-1414', 'email' => 'yara@example.com', 'notes' => 'تفضل الفساتين القصيرة.', 'country' => 'فلسطين'],
            ['name' => 'تالا أحمد', 'phone' => '555-1515', 'email' => 'tala@example.com', 'notes' => 'عميلة جديدة.', 'country' => 'فلسطين'],
            ['name' => 'لينا محمد', 'phone' => '555-1616', 'email' => 'lina@example.com', 'notes' => 'تفضل الفساتين الكلاسيكية.', 'country' => 'فلسطين'],
            ['name' => 'نادين علي', 'phone' => '555-1717', 'email' => 'nadeen@example.com', 'notes' => 'عميلة منتظمة.', 'country' => 'فلسطين'],
            ['name' => 'ملاك أحمد', 'phone' => '555-1818', 'email' => 'malak@example.com', 'notes' => 'تفضل الفساتين المطرزة.', 'country' => 'فلسطين'],
        ];

        Client::insert($clients);
    }
} 