@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        {{ __('Create Payment') }}
    </h2>
@endsection

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="bg-cream-100/80 dark:bg-neutral-900/80 overflow-hidden shadow-sm sm:rounded-2xl backdrop-blur-lg">
            <div class="p-6 text-neutral-700 dark:text-neutral-200">
                <form method="POST" action="{{ route('payments.store') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <x-input-label for="contract_id" :value="__('Contract')" />
                        <select id="contract_id" name="contract_id" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm select2-ajax" required>
                            @if(old('contract_id'))
                                <option value="{{ old('contract_id') }}" selected>{{ old('contract_id') }}</option>
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('contract_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="amount" :value="__('Amount')" />
                        <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" step="0.01" required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="paid_at" :value="__('Payment Date')" />
                        <x-text-input id="paid_at" class="block mt-1 w-full" type="date" name="paid_at" :value="old('paid_at')" required />
                        <x-input-error :messages="$errors->get('paid_at')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="payment_method" :value="__('Payment Method')" />
                        <select id="payment_method" name="payment_method" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="نقداً" {{ old('payment_method') == 'نقداً' ? 'selected' : '' }}>نقداً</option>
                            <option value="بطاقة ائتمان" {{ old('payment_method') == 'بطاقة ائتمان' ? 'selected' : '' }}>بطاقة ائتمان</option>
                            <option value="تحويل بنكي" {{ old('payment_method') == 'تحويل بنكي' ? 'selected' : '' }}>تحويل بنكي</option>
                        </select>
                        <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="مكتمل" {{ old('status') == 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
                            <option value="معلق" {{ old('status') == 'معلق' ? 'selected' : '' }}>معلق</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Create Payment') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 

@push('scripts')
<script>
$(document).ready(function() {
    $('#contract_id').select2({
        placeholder: 'اختر العقد',
        allowClear: true,
        ajax: {
            url: '{{ route('contracts.search') }}',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { q: params.term };
            },
            processResults: function (data) {
                return { results: data.results };
            },
            cache: true
        }
    });
});
</script>
@endpush 