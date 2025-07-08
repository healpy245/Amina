@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        {{ __('Create Contract') }}
    </h2>
@endsection

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="bg-cream-100/80 dark:bg-neutral-900/80 overflow-hidden shadow-sm sm:rounded-2xl backdrop-blur-lg">
            <div class="p-6 text-neutral-700 dark:text-neutral-200">
                <form method="POST" action="{{ route('contracts.store') }}" class="space-y-6">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <x-input-label for="appointment_id" :value="__('Appointment')" />
                        <select id="appointment_id" name="appointment_id" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm select2-ajax" required>
                            @if(old('appointment_id'))
                                <option value="{{ old('appointment_id') }}" selected>{{ old('appointment_id') }}</option>
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('appointment_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="contract_number" :value="'رقم العقد'" />
                        <x-text-input id="contract_number" class="block mt-1 w-full" type="text" name="contract_number" :value="old('contract_number')" required />
                        <x-input-error :messages="$errors->get('contract_number')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="client_id" :value="'الزبون'" />
                        <select id="client_id" name="client_id" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm select2-ajax" required>
                            @if(old('client_id'))
                                <option value="{{ old('client_id') }}" selected>{{ \App\Models\Client::find(old('client_id'))->name ?? '' }}</option>
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="dress_id" :value="'الفستان'" />
                        <select id="dress_id" name="dress_id" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm select2-ajax" required>
                            @if(old('dress_id'))
                                <option value="{{ old('dress_id') }}" selected>{{ \App\Models\Dress::find(old('dress_id'))->name ?? '' }}</option>
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('dress_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="amount" :value="'المبلغ'" />
                        <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" step="0.01" required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="start_date" :value="'تاريخ التسليم'" />
                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" required />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="end_date" :value="'تاريخ الترجيع'" />
                        <x-text-input id="end_date" class="block mt-1 w-full" type="date" name="end_date" :value="old('end_date')" required />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="status" :value="'الحالة'" />
                        <select id="status" name="status" class="block mt-1 w-full rounded-lg border-neutral-300 dark:border-neutral-700 bg-white dark:bg-neutral-800 text-neutral-900 dark:text-neutral-100 focus:ring-boutique-500 focus:border-boutique-500">
                            <option value="مكتمل" {{ old('status') == 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
                            <option value="معلق" {{ old('status') == 'معلق' ? 'selected' : '' }}>معلق</option>
                            <option value="ملغي" {{ old('status') == 'ملغي' ? 'selected' : '' }}>ملغي</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="deposit_paid" :value="'عربون'" />
                        <select id="deposit_paid" name="deposit_paid" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="1" {{ old('deposit_paid') == '1' ? 'selected' : '' }}>نعم</option>
                            <option value="0" {{ old('deposit_paid') == '0' ? 'selected' : '' }}>لا</option>
                        </select>
                        <x-input-error :messages="$errors->get('deposit_paid')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="signed_at" :value="'تاريخ التوقيع'" />
                        <x-text-input id="signed_at" class="block mt-1 w-full" type="date" name="signed_at" :value="old('signed_at')" required />
                        <x-input-error :messages="$errors->get('signed_at')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Create Contract') }}
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
    $('#appointment_id').select2({
        placeholder: 'اختر الموعد',
        allowClear: true,
        ajax: {
            url: '/appointments/search',
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
    $('#client_id').select2({
        placeholder: 'اختر الزبون',
        allowClear: true,
        ajax: {
            url: '{{ route('clients.search') }}',
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
    $('#dress_id').select2({
        placeholder: 'اختر الفستان',
        allowClear: true,
        ajax: {
            url: '{{ route('dresses.search') }}',
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

@push('styles')
<style>
html.dark .select2-container--default .select2-selection--single {
    background-color: #222 !important;
    color: #fff !important;
    border-color: #444 !important;
}
html.dark .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #fff !important;
}
html.dark .select2-container--default .select2-selection--single .select2-selection__arrow {
    color: #fff !important;
}
html.dark .select2-dropdown {
    background-color: #222 !important;
    color: #fff !important;
    border-color: #444 !important;
}
html.dark .select2-results__option {
    background-color: #222 !important;
    color: #fff !important;
}
html.dark .select2-results__option--highlighted {
    background-color: #333 !important;
    color: #fff !important;
}
html.dark .select2-search__field {
    background: #222 !important;
    color: #fff !important;
    border-color: #444 !important;
}
</style>
@endpush 