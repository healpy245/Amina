@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">تفاصيل العقد</h2>
@endsection

@section('content')
<div class="py-10" dir="rtl">
    <div class="max-w-3xl mx-auto text-right">
        <div class="bg-white/90 dark:bg-neutral-900/90 rounded-3xl shadow-2xl p-0 overflow-hidden border border-boutique-100 dark:border-neutral-800">
            <div class="flex flex-col md:flex-row items-center md:items-stretch">
                <div class="flex-shrink-0 flex flex-col items-center justify-center bg-gradient-to-br from-boutique-100 to-boutique-300 dark:from-neutral-800 dark:to-neutral-900 p-8 md:w-1/2">
                    @if($contract->dress && $contract->dress->image)
                        <img src="{{ asset('storage/' . $contract->dress->image) }}" alt="صورة الفستان" class="w-64 h-64 rounded-2xl object-cover shadow-xl border-4 border-white dark:border-neutral-800" />
                    @else
                        <img src="/dress-placeholder.png" alt="صورة افتراضية" class="w-64 h-64 rounded-2xl object-cover shadow-xl border-4 border-white dark:border-neutral-800" />
                    @endif
                </div>
                <div class="flex-1 flex flex-col justify-center p-8 gap-4 text-boutique-900 dark:text-boutique-100">
                    <h3 class="text-4xl font-extrabold text-boutique-900 dark:text-white mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 text-boutique-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h2a4 4 0 014 4v2" /></svg>
                        رقم العقد: {{ $contract->contract_number }}
                    </h3>
                    <div class="flex items-center gap-4 mb-2">
                        <span class="font-bold">الزبون:</span>
                        @if($contract->client && $contract->client->image)
                            <img src="{{ asset('storage/' . $contract->client->image) }}" alt="صورة الزبون" class="w-20 h-20 rounded-full object-cover border-2 border-boutique-200" />
                        @else
                            <img src="/client-placeholder.png" alt="صورة افتراضية" class="w-20 h-20 rounded-full object-cover border-2 border-boutique-200" />
                        @endif
                        <span class="whitespace-nowrap text-lg font-semibold">{{ $contract->client->name ?? '-' }}</span>
                    </div>
                    <div class="flex flex-wrap gap-4 text-lg text-boutique-900 dark:text-boutique-100">
                        <div class="flex items-center gap-2">
                            <span class="font-bold">المبلغ:</span>
                            <span>₪{{ number_format($contract->amount, 2) }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">العربون:</span>
                            <span class="font-bold px-3 py-1 rounded-full text-xs {{ $contract->deposit_paid ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                ₪{{ number_format($contract->payments()->whereNotNull('deposit')->sum('deposit'), 2) }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $contract->deposit_paid ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                {{ $contract->deposit_paid ? 'مدفوع' : 'غير مدفوع' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">تاريخ التوقيع:</span>
                            <span>{{ $contract->signed_at ? $contract->signed_at->format('Y-m-d') : '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">تاريخ التسليم:</span>
                            <span>{{ $contract->start_date ? $contract->start_date->format('Y-m-d') : '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">تاريخ الترجيع:</span>
                            <span>{{ $contract->end_date ? $contract->end_date->format('Y-m-d') : '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold">الحالة:</span>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $contract->status === 'مكتمل' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : ($contract->status === 'معلق' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                {{ $contract->status }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('contracts.edit', $contract) }}" class="bg-boutique-600 hover:bg-boutique-700 text-white px-6 py-2 rounded-xl font-bold shadow transition-all duration-300 flex items-center gap-1" title="تعديل">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4 12.362-12.726z" />
                            </svg>
                            تعديل
                        </a>
                        <form action="{{ route('contracts.destroy', $contract) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا العقد؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-6 py-2 rounded-xl shadow transition-all duration-300 flex items-center gap-1 font-semibold" title="حذف">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0v10a2 2 0 002 2h4a2 2 0 002-2V7" />
                                </svg>
                                حذف
                            </button>
                        </form>
                        <a href="{{ route('contracts.index') }}" class="bg-gray-300 hover:bg-gray-400 text-boutique-900 px-6 py-2 rounded-xl font-bold shadow transition-all duration-300 flex items-center gap-1" title="رجوع">
                            رجوع
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 