@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">تفاصيل الموعد</h2>
@endsection

@section('content')
<div class="py-10" dir="rtl">
    <div class="max-w-3xl mx-auto text-right">
        <div class="bg-white/90 dark:bg-neutral-900/90 rounded-3xl shadow-2xl p-0 overflow-hidden border border-boutique-100 dark:border-neutral-800">
            <div class="flex flex-col md:flex-row items-center md:items-stretch">
                <div class="flex-shrink-0 flex flex-col items-center justify-center bg-gradient-to-br from-boutique-100 to-boutique-300 dark:from-neutral-800 dark:to-neutral-900 p-8 md:w-1/2">
                    @if($appointment->client && $appointment->client->image)
                        <img src="{{ asset('storage/' . $appointment->client->image) }}" alt="صورة الزبون" class="w-64 h-64 rounded-full object-cover shadow-xl border-4 border-white dark:border-neutral-800" />
                    @else
                        <img src="/client-placeholder.png" alt="صورة افتراضية" class="w-64 h-64 rounded-full object-cover shadow-xl border-4 border-white dark:border-neutral-800" />
                    @endif
                </div>
                <div class="flex-1 flex flex-col justify-center p-8 gap-4 text-boutique-900 dark:text-boutique-100">
                    <h3 class="text-4xl font-extrabold text-boutique-900 dark:text-white mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 text-boutique-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3" /></svg>
                        رقم الموعد: #{{ $appointment->id }}
                    </h3>
                    <div class="flex items-center gap-4 mb-2">
                        <span class="font-bold">الزبون:</span>
                        <span class="whitespace-nowrap text-lg font-semibold">{{ $appointment->client->name ?? '-' }}</span>
                    </div>
                    <div class="flex flex-wrap gap-4 text-lg text-boutique-900 dark:text-boutique-100">
                        <div class="flex items-center gap-2">
                            <span class="font-bold">الفستان:</span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-boutique-100 dark:bg-neutral-800">{{ $appointment->dress_type ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">التاريخ:</span>
                            <span>{{ $appointment->date }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">الوقت:</span>
                            <span>{{ $appointment->time }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">نوع الموعد:</span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $appointment->type === 'قياس' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">{{ $appointment->type }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">ملاحظة:</span>
                            <span>{{ $appointment->notes ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('appointments.edit', $appointment) }}" class="bg-boutique-600 hover:bg-boutique-700 text-white px-6 py-2 rounded-xl font-bold shadow transition-all duration-300 flex items-center gap-1" title="تعديل">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4 12.362-12.726z" />
                            </svg>
                            تعديل
                        </a>
                        <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا الموعد؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-6 py-2 rounded-xl shadow transition-all duration-300 flex items-center gap-1 font-semibold" title="حذف">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0v10a2 2 0 002 2h4a2 2 0 002-2V7" />
                                </svg>
                                حذف
                            </button>
                        </form>
                        <a href="{{ route('appointments.index') }}" class="bg-gray-300 hover:bg-gray-400 text-boutique-900 px-6 py-2 rounded-xl font-bold shadow transition-all duration-300 flex items-center gap-1" title="رجوع">
                            رجوع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 