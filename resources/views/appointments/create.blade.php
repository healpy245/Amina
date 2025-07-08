@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        {{ __('Create Appointment') }}
    </h2>
@endsection

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="bg-cream-100/80 dark:bg-neutral-900/80 overflow-hidden shadow-sm sm:rounded-2xl backdrop-blur-lg">
            <div class="p-6 text-neutral-700 dark:text-neutral-200">
                <form method="POST" action="{{ route('appointments.store') }}" class="space-y-6">
                    @csrf
                    
                    <div>
                        <x-input-label for="client_id" :value="__('Client')" />
                        <select id="client_id" name="client_id" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm select2-ajax" required>
                            @if(old('client_id'))
                                <option value="{{ old('client_id') }}" selected>{{ \App\Models\Client::find(old('client_id'))->name ?? '' }}</option>
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('client_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="dress_id" :value="__('Dress')" />
                        <select id="dress_id" name="dress_id" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm select2-ajax" required>
                            @if(old('dress_id'))
                                <option value="{{ old('dress_id') }}" selected>{{ \App\Models\Dress::find(old('dress_id'))->name ?? '' }}</option>
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('dress_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="type" :value="__('نوع الموعد')" />
                        <select id="type" name="type" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="">اختر نوع الموعد</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="dress_type" :value="__('نوع الفستان')" />
                        <select id="dress_type" name="dress_type" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" required>
                            <option value="">اختر نوع الفستان</option>
                            @foreach($dressTypes as $dressType)
                                <option value="{{ $dressType }}" {{ old('dress_type') == $dressType ? 'selected' : '' }}>{{ $dressType }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('dress_type')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="date" :value="__('Date')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="time" :value="__('Time')" />
                        <x-text-input id="time" class="block mt-1 w-full" type="time" name="time" :value="old('time')" required />
                        <x-input-error :messages="$errors->get('time')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="notes" :value="__('Notes')" />
                        <textarea id="notes" name="notes" rows="3" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Create Appointment') }}
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
    $('#client_id').select2({
        placeholder: 'اختر العميل',
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