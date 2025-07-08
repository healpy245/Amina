@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">تفاصيل الزبون</h2>
@endsection

@section('content')
<div class="py-10" dir="rtl">
    <div class="max-w-4xl mx-auto text-right">
        <div class="bg-white/90 dark:bg-neutral-900/90 rounded-3xl shadow-2xl p-0 overflow-hidden border border-boutique-100 dark:border-neutral-800">
            <div class="flex flex-col md:flex-row items-center md:items-stretch">
                <div class="flex-shrink-0 flex flex-col items-center justify-center bg-gradient-to-br from-boutique-100 to-boutique-300 dark:from-neutral-800 dark:to-neutral-900 p-8 md:w-1/2">
                    @if($client->image)
                        <img src="{{ asset('storage/' . $client->image) }}" alt="صورة الزبون" class="w-64 h-64 rounded-full object-cover shadow-xl border-4 border-white dark:border-neutral-800" />
                    @else
                        <img src="/client-placeholder.png" alt="صورة افتراضية" class="w-64 h-64 rounded-full object-cover shadow-xl border-4 border-white dark:border-neutral-800" />
                    @endif
                </div>
                <div class="flex-1 flex flex-col justify-center p-8 gap-4 text-boutique-900 dark:text-boutique-100">
                    <h3 class="text-4xl font-extrabold text-boutique-900 dark:text-white mb-2 flex items-center gap-3">
                        <svg class="w-8 h-8 text-boutique-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        {{ $client->name }}
                    </h3>
                    <div class="flex flex-wrap gap-4 text-lg text-boutique-900 dark:text-boutique-100">
                        <div class="flex items-center gap-2">
                            <span class="font-bold dark:text-boutique-100">رقم الهاتف:</span>
                            <span class="dark:text-boutique-100">{{ $client->phone }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold dark:text-boutique-100">البريد الإلكتروني:</span>
                            <span class="dark:text-boutique-100">{{ $client->email ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold dark:text-boutique-100">الدولة:</span>
                            <span class="dark:text-boutique-100">{{ $client->country ?? '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-bold dark:text-boutique-100">ملاحظات:</span>
                            <span class="dark:text-boutique-100">{{ $client->notes ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 mt-4">
                        @php
                            $now = now();
                            $activeAppointment = $client->appointments->where('date', '>=', $now->toDateString())->sortBy('date')->first();
                            $activeContract = $client->contracts->where('end_date', '>=', $now->toDateString())->sortBy('end_date')->first();
                        @endphp
                        <span class="font-bold">الحالة الحالية:</span>
                        @if($activeAppointment)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">لديه موعد نشط</span>
                        @elseif($activeContract)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">لديه عقد نشط</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-800 dark:bg-neutral-800 dark:text-neutral-200">غير نشط حالياً</span>
                        @endif
                    </div>
                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('clients.edit', $client) }}" class="bg-boutique-600 hover:bg-boutique-700 text-white px-6 py-2 rounded-xl font-bold shadow transition-all duration-300 flex items-center gap-1" title="تعديل">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4 12.362-12.726z" />
                            </svg>
                            تعديل
                        </a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا الزبون؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-6 py-2 rounded-xl shadow transition-all duration-300 flex items-center gap-1 font-semibold" title="حذف">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0v10a2 2 0 002 2h4a2 2 0 002-2V7" />
                                </svg>
                                حذف
                            </button>
                        </form>
                        <a href="{{ route('clients.index') }}" class="bg-gray-300 hover:bg-gray-400 text-boutique-900 px-6 py-2 rounded-xl font-bold shadow transition-all duration-300 flex items-center gap-1" title="رجوع">
                            رجوع
                        </a>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <h4 class="text-2xl font-bold mb-4 dark:text-boutique-100">جميع المواعيد</h4>
                <div class="overflow-x-auto mb-8">
                    <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 rounded-xl overflow-hidden text-right">
                        <thead class="bg-cream-200/60 dark:bg-neutral-900/60">
                            <tr>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">التاريخ</th>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">الوقت</th>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">نوع الموعد</th>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">ملاحظات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @forelse($client->appointments as $appointment)
                                <tr class="hover:bg-cream-100/50 dark:hover:bg-neutral-900/50 transition">
                                    <td class="px-4 py-2 font-bold text-boutique-700 dark:text-boutique-100">{{ $appointment->date }}</td>
                                    <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">{{ $appointment->time }}</td>
                                    <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">{{ $appointment->type }}</td>
                                    <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">{{ $appointment->notes ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-neutral-500 dark:text-neutral-300 py-4">لا توجد مواعيد.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <h4 class="text-2xl font-bold mb-4 dark:text-boutique-100">جميع العقود</h4>
                <div class="overflow-x-auto mb-8">
                    <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 rounded-xl overflow-hidden text-right">
                        <thead class="bg-cream-200/60 dark:bg-neutral-900/60">
                            <tr>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">رقم العقد</th>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">المبلغ</th>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">تاريخ التسليم</th>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">الحالة</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @forelse($client->contracts as $contract)
                                <tr class="hover:bg-cream-100/50 dark:hover:bg-neutral-900/50 transition">
                                    <td class="px-4 py-2 font-bold text-boutique-700 dark:text-boutique-100">{{ $contract->contract_number }}</td>
                                    <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">₪{{ number_format($contract->amount, 2) }}</td>
                                    <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">{{ $contract->start_date }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $contract->status === 'مكتمل' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : ($contract->status === 'معلق' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                            {{ $contract->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-neutral-500 dark:text-neutral-300 py-4">لا توجد عقود.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <h4 class="text-2xl font-bold mb-4 dark:text-boutique-100">جميع الدفعات</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 rounded-xl overflow-hidden text-right">
                        <thead class="bg-cream-200/60 dark:bg-neutral-900/60">
                            <tr>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">رقم الدفعة</th>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">المبلغ</th>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">طريقة الدفع</th>
                                <th class="px-4 py-2 text-boutique-900 dark:text-boutique-100">تاريخ الدفع</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @forelse($client->payments as $payment)
                                <tr class="hover:bg-cream-100/50 dark:hover:bg-neutral-900/50 transition">
                                    <td class="px-4 py-2 font-bold text-boutique-700 dark:text-boutique-100">{{ $payment->payment_number }}</td>
                                    <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">₪{{ number_format($payment->amount, 2) }}</td>
                                    <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">{{ $payment->payment_method }}</td>
                                    <td class="px-4 py-2 text-boutique-900 dark:text-boutique-100">{{ $payment->paid_at }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center text-neutral-500 dark:text-neutral-300 py-4">لا توجد دفعات.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 