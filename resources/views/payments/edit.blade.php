@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        تعديل الدفعة
    </h2>
@endsection

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="bg-cream-100/80 dark:bg-neutral-900/80 overflow-hidden shadow-sm sm:rounded-2xl backdrop-blur-lg">
            <div class="p-6 text-neutral-700 dark:text-neutral-200">
                <form method="POST" action="{{ route('payments.update', $payment) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="payment_number" :value="'رقم الدفعة'" />
                        <x-text-input id="payment_number" class="block mt-1 w-full bg-gray-100 cursor-not-allowed" type="text" name="payment_number" :value="old('payment_number', $payment->payment_number)" readonly tabindex="-1" />
                        <x-input-error :messages="$errors->get('payment_number')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contract_id" :value="'العقد'" />
                        <select id="contract_id" name="contract_id" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="">اختر العقد</option>
                            @foreach($contracts as $contract)
                                <option value="{{ $contract->id }}" {{ old('contract_id', $payment->contract_id) == $contract->id ? 'selected' : '' }}>
                                    {{ $contract->contract_number }} - {{ $contract->client->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('contract_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="amount" :value="'المبلغ'" />
                        <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount', $payment->amount)" step="0.01" required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="paid_at" :value="'تاريخ الدفع'" />
                        <x-text-input id="paid_at" class="block mt-1 w-full" type="date" name="paid_at" :value="old('paid_at', $payment->paid_at ? $payment->paid_at->format('Y-m-d') : '')" required />
                        <x-input-error :messages="$errors->get('paid_at')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="payment_method" :value="'طريقة الدفع'" />
                        <select id="payment_method" name="payment_method" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="نقداً" {{ old('payment_method', $payment->payment_method) == 'نقداً' ? 'selected' : '' }}>نقداً</option>
                            <option value="بطاقة ائتمان" {{ old('payment_method', $payment->payment_method) == 'بطاقة ائتمان' ? 'selected' : '' }}>بطاقة ائتمان</option>
                            <option value="تحويل بنكي" {{ old('payment_method', $payment->payment_method) == 'تحويل بنكي' ? 'selected' : '' }}>تحويل بنكي</option>
                        </select>
                        <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="'الحالة'" />
                        <select id="status" name="status" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="مكتمل" {{ old('status', $payment->status) == 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
                            <option value="معلق" {{ old('status', $payment->status) == 'معلق' ? 'selected' : '' }}>معلق</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            إلغاء
                        </x-secondary-button>
                        <x-primary-button>
                            تحديث الدفعة
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 