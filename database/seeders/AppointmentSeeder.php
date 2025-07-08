<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $types = ['عروس', 'سهرة'];
        $dressTypes = ['تصميم', 'جاهز'];
        $appointments = [
            ['client_id' => 1, 'date' => Carbon::now()->subDays(5)->format('Y-m-d'), 'time' => '15:00:00', 'notes' => 'استشارة لفستان مسائي.', 'type' => $types[0], 'dress_type' => $dressTypes[1]],
            ['client_id' => 2, 'date' => Carbon::now()->subDays(10)->format('Y-m-d'), 'time' => '11:00:00', 'notes' => 'قياسات لفستان زفاف.', 'type' => $types[0], 'dress_type' => $dressTypes[0]],
            ['client_id' => 3, 'date' => Carbon::now()->subDays(15)->format('Y-m-d'), 'time' => '17:30:00', 'notes' => 'تجربة فستان حفلة.', 'type' => $types[1], 'dress_type' => $dressTypes[1]],
            ['client_id' => 4, 'date' => Carbon::now()->subDays(20)->format('Y-m-d'), 'time' => '14:00:00', 'notes' => 'استشارة لفستان تقليدي.', 'type' => $types[1], 'dress_type' => $dressTypes[0]],
            ['client_id' => 5, 'date' => Carbon::now()->subDays(25)->format('Y-m-d'), 'time' => '16:00:00', 'notes' => 'قياسات لفستان كوكتيل.', 'type' => $types[0], 'dress_type' => $dressTypes[1]],
            ['client_id' => 6, 'date' => Carbon::now()->subDays(30)->format('Y-m-d'), 'time' => '10:30:00', 'notes' => 'تجربة فستان طويل.', 'type' => $types[1], 'dress_type' => $dressTypes[0]],
            ['client_id' => 7, 'date' => Carbon::now()->subMonths(1)->format('Y-m-d'), 'time' => '13:00:00', 'notes' => 'استشارة لفستان عرائس.', 'type' => $types[0], 'dress_type' => $dressTypes[0]],
            ['client_id' => 8, 'date' => Carbon::now()->subMonths(1)->subDays(5)->format('Y-m-d'), 'time' => '18:00:00', 'notes' => 'قياسات لفستان مسائي.', 'type' => $types[1], 'dress_type' => $dressTypes[1]],
            ['client_id' => 9, 'date' => Carbon::now()->subMonths(1)->subDays(10)->format('Y-m-d'), 'time' => '12:00:00', 'notes' => 'تجربة فستان كلاسيكي.', 'type' => $types[0], 'dress_type' => $dressTypes[0]],
            ['client_id' => 10, 'date' => Carbon::now()->subMonths(2)->format('Y-m-d'), 'time' => '15:30:00', 'notes' => 'استشارة لفستان عصري.', 'type' => $types[1], 'dress_type' => $dressTypes[1]],
            ['client_id' => 11, 'date' => Carbon::now()->subMonths(2)->subDays(5)->format('Y-m-d'), 'time' => '11:30:00', 'notes' => 'قياسات لفستان تراثي.', 'type' => $types[0], 'dress_type' => $dressTypes[0]],
            ['client_id' => 12, 'date' => Carbon::now()->subMonths(2)->subDays(10)->format('Y-m-d'), 'time' => '17:00:00', 'notes' => 'تجربة فستان رسمي.', 'type' => $types[1], 'dress_type' => $dressTypes[1]],
            ['client_id' => 13, 'date' => Carbon::now()->subMonths(3)->format('Y-m-d'), 'time' => '14:30:00', 'notes' => 'استشارة لفستان صيفي.', 'type' => $types[0], 'dress_type' => $dressTypes[1]],
            ['client_id' => 14, 'date' => Carbon::now()->subMonths(3)->subDays(5)->format('Y-m-d'), 'time' => '16:30:00', 'notes' => 'قياسات لفستان شتوي.', 'type' => $types[1], 'dress_type' => $dressTypes[0]],
            ['client_id' => 15, 'date' => Carbon::now()->subMonths(4)->format('Y-m-d'), 'time' => '10:00:00', 'notes' => 'تجربة فستان مطرز.', 'type' => $types[0], 'dress_type' => $dressTypes[0]],
            ['client_id' => 16, 'date' => Carbon::now()->subMonths(4)->subDays(5)->format('Y-m-d'), 'time' => '13:30:00', 'notes' => 'استشارة لفستان سهرة.', 'type' => $types[1], 'dress_type' => $dressTypes[1]],
            ['client_id' => 17, 'date' => Carbon::now()->subMonths(5)->format('Y-m-d'), 'time' => '18:30:00', 'notes' => 'قياسات لفستان زفاف.', 'type' => $types[0], 'dress_type' => $dressTypes[1]],
            ['client_id' => 18, 'date' => Carbon::now()->subMonths(5)->subDays(5)->format('Y-m-d'), 'time' => '12:30:00', 'notes' => 'تجربة فستان حفلة.', 'type' => $types[1], 'dress_type' => $dressTypes[0]],
            ['client_id' => 19, 'date' => Carbon::now()->subMonths(5)->subDays(10)->format('Y-m-d'), 'time' => '15:00:00', 'notes' => 'استشارة لفستان تقليدي.', 'type' => $types[0], 'dress_type' => $dressTypes[0]],
            ['client_id' => 20, 'date' => Carbon::now()->subMonths(5)->subDays(15)->format('Y-m-d'), 'time' => '11:00:00', 'notes' => 'قياسات لفستان كوكتيل.', 'type' => $types[1], 'dress_type' => $dressTypes[1]],
        ];

        Appointment::insert($appointments);
    }
} 