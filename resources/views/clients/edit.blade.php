@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        {{ __('Edit Client') }}
    </h2>
@endsection

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="bg-cream-100/80 dark:bg-neutral-900/80 overflow-hidden shadow-sm sm:rounded-2xl backdrop-blur-lg">
            <div class="p-6 text-neutral-700 dark:text-neutral-200">
                <form method="POST" action="{{ route('clients.update', $client) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $client->name)" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $client->email)" required autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone', $client->phone)" required autocomplete="tel" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <textarea id="address" name="address" rows="3" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm">{{ old('address', $client->address) }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="country" :value="'البلد'" />
                        <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country', $client->country)" />
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Image')" />
                        @if($client->image)
                            <div class="mt-2 mb-4">
                                <img src="{{ asset('storage/' . $client->image) }}" alt="Current image" class="w-32 h-32 object-cover rounded-lg border-2 border-boutique-300 dark:border-neutral-600">
                            </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*" class="block mt-1 w-full border-boutique-300 dark:border-neutral-700 dark:bg-neutral-900 text-boutique-900 dark:text-neutral-300 focus:border-boutique-500 dark:focus:border-boutique-600 focus:ring-boutique-500 dark:focus:ring-boutique-600 rounded-md shadow-sm" />
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Update Client') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 