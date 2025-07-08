@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        تفاصيل الفستان
    </h2>
@endsection

@section('content')
<div class="py-10" dir="rtl">
    <div class="max-w-3xl mx-auto text-right">
        <div class="bg-white/90 dark:bg-neutral-900/90 rounded-3xl shadow-2xl p-0 overflow-hidden border border-boutique-100 dark:border-neutral-800">
            <div class="flex flex-col md:flex-row items-center md:items-stretch">
                <div class="flex-shrink-0 flex flex-col items-center justify-center bg-gradient-to-br from-boutique-100 to-boutique-300 dark:from-neutral-800 dark:to-neutral-900 p-8 md:w-1/2">
                    @if($dress->image)
                        <img src="{{ asset('storage/' . $dress->image) }}" alt="صورة الفستان" class="w-64 h-64 rounded-2xl object-cover shadow-xl border-4 border-white dark:border-neutral-800" />
                    @else
                        <img src="/dress-placeholder.png" alt="صورة افتراضية" class="w-64 h-64 rounded-2xl object-cover shadow-xl border-4 border-white dark:border-neutral-800" />
                    @endif
                </div>
                <div class="flex-1 flex flex-col justify-center p-8 gap-4 text-boutique-900 dark:text-boutique-100">
                    <h3 class="text-4xl font-extrabold text-boutique-900 dark:text-white mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 text-boutique-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 9a2 2 0 01-2 2H6a2 2 0 01-2-2l1-9z" /></svg>
                        {{ $dress->name }}
                    </h3>
                    <div class="flex flex-wrap gap-4 text-lg text-boutique-900 dark:text-boutique-100">
                        <div class="flex items-center gap-2">
                            <span class="font-bold">الفئة:</span>
                            <span>{{ $dress->category->name ?? 'غير محدد' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">السعر:</span>
                            <span>₪{{ number_format($dress->price, 2) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">الحالة:</span>
                            <span class="flex items-center gap-1">
                                @if($dress->status === 'available')
                                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10" /></svg>
                                @else
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><circle cx="10" cy="10" r="10" /></svg>
                                @endif
                                @php
                                    $statusMap = [
                                        'available' => 'متاح',
                                        'under_measurement' => 'قيد القياس',
                                        'rented' => 'مؤجر',
                                        'returned' => 'مُعاد',
                                        'washing' => 'في الغسيل',
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $dress->status === 'available' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                    {{ $statusMap[$dress->status] ?? $dress->status }}
                                </span>
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">عدد مرات التأجير:</span>
                            <span>{{ $rentedCount }}</span>
                        </div>
                    </div>
                    @if($dress->description)
                        <div class="mt-2 text-boutique-900 dark:text-neutral-200 text-base">
                            <span class="font-bold">الوصف:</span> {{ $dress->description }}
                        </div>
                    @endif
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('dresses.edit', $dress) }}" class="bg-boutique-600 hover:bg-boutique-700 text-white px-6 py-2 rounded-xl font-bold shadow transition-all duration-300 flex items-center gap-1" title="تعديل">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4 12.362-12.726z" />
                            </svg>
                            تعديل
                        </a>
                        <form action="{{ route('dresses.destroy', $dress) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا الفستان؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-6 py-2 rounded-xl shadow transition-all duration-300 flex items-center gap-1 font-semibold" title="حذف">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0v10a2 2 0 002 2h4a2 2 0 002-2V7" />
                                </svg>
                                حذف
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="p-8">
                @if($clients->count())
                    <div class="mb-4 text-lg text-boutique-900 dark:text-neutral-200">
                        <span class="font-bold">العملاء الذين استأجروا الفستان:</span>
                        <div class="overflow-x-auto mt-2">
                            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 rounded-xl overflow-hidden text-right">
                                <thead class="bg-cream-200/60 dark:bg-neutral-900/60">
                                    <tr>
                                        <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">الزبون</th>
                                        <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">رقم العقد</th>
                                        <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">تاريخ التسليم</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                                    @foreach($dress->contracts as $contract)
                                        @if($contract->client)
                                            <tr class="hover:bg-cream-100/50 dark:hover:bg-neutral-900/50 transition">
                                                <td class="px-4 py-2 font-bold text-boutique-700 dark:text-boutique-200">{{ $contract->client->name }}</td>
                                                <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">{{ $contract->contract_number }}</td>
                                                <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">{{ $contract->start_date }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 