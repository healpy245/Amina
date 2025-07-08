@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        {{ __('Edit Contract') }}
    </h2>
@endsection

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="bg-cream-100/80 dark:bg-neutral-900/80 overflow-hidden shadow-sm sm:rounded-2xl backdrop-blur-lg">
            <div class="p-6 text-neutral-700 dark:text-neutral-200">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('contracts.update', $contract) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label :value="'رقم العقد'" />
                        <div class="block mt-1 w-full px-3 py-2 bg-neutral-200 dark:bg-neutral-800 text-boutique-900 dark:text-neutral-100 rounded-md shadow-sm font-bold text-lg">
                            {{ $contract->contract_number }}
                        </div>
                        <input type="hidden" name="contract_number" value="{{ $contract->contract_number }}" />
                        <x-input-error :messages="$errors->get('contract_number')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="client_id" :value="'الزبون'" />
                        <select id="client_id" name="client_id" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="">اختر الزبون</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id', $contract->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="dress_id" :value="'الفستان'" />
                        <select id="dress_id" name="dress_id" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="">اختر الفستان</option>
                            @foreach($dresses as $dress)
                                <option value="{{ $dress->id }}" {{ old('dress_id', $contract->dress_id) == $dress->id ? 'selected' : '' }}>
                                    {{ $dress->name }} - {{ $dress->category->name ?? 'غير محدد' }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('dress_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="amount" :value="'المبلغ'" />
                        <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount', $contract->amount)" step="0.01" required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 items-end">
                        <div class="flex-1">
                            <x-input-label for="deposit_amount" :value="'مبلغ العربون'" />
                            <x-text-input id="deposit_amount" class="block mt-1 w-full" type="number" name="deposit_amount" :value="old('deposit_amount', $contract->payments()->whereNotNull('deposit')->sum('deposit'))" step="0.01" />
                            <x-input-error :messages="$errors->get('deposit_amount')" class="mt-2" />
                        </div>
                        <div class="flex-1">
                            <x-input-label for="deposit_paid" :value="'عربون مدفوع أم لا'" />
                            <select id="deposit_paid" name="deposit_paid" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                                <option value="1" {{ old('deposit_paid', $contract->deposit_paid) == '1' ? 'selected' : '' }}>نعم</option>
                                <option value="0" {{ old('deposit_paid', $contract->deposit_paid) == '0' ? 'selected' : '' }}>لا</option>
                            </select>
                            <x-input-error :messages="$errors->get('deposit_paid')" class="mt-2" />
                        </div>
                    </div>
                    <div>
                        <x-input-label for="start_date" :value="'تاريخ التسليم'" />
                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date', optional($contract->start_date)->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="end_date" :value="'تاريخ الترجيع'" />
                        <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date', optional($contract->end_date)->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="'الحالة'" />
                        <select id="status" name="status" class="block mt-1 w-full rounded-lg border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-boutique-500 focus:border-boutique-500">
                            <option value="مكتمل" {{ old('status', $contract->status) == 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
                            <option value="معلق" {{ old('status', $contract->status) == 'معلق' ? 'selected' : '' }}>معلق</option>
                            <option value="ملغي" {{ old('status', $contract->status) == 'ملغي' ? 'selected' : '' }}>ملغي</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="signed_at" :value="'تاريخ التوقيع'" />
                        <x-text-input id="signed_at" class="block mt-1 w-full" type="date" name="signed_at" :value="old('signed_at', optional($contract->signed_at)->format('Y-m-d'))" required />
                        <x-input-error :messages="$errors->get('signed_at')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Update Contract') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 