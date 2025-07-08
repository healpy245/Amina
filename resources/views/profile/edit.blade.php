@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        {{ 'الملف الشخصي' }}
    </h2>
@endsection

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="flex flex-col items-center mb-10">
            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-boutique-400 to-boutique-700 flex items-center justify-center shadow-2xl mb-4 border-4 border-white dark:border-neutral-900">
                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <h3 class="text-3xl font-extrabold text-boutique-900 dark:text-white mb-1">{{ $user->name }}</h3>
            <p class="text-boutique-700 dark:text-boutique-200 text-lg">{{ $user->email }}</p>
        </div>
        <div class="space-y-8">
            <div class="bg-white/80 dark:bg-neutral-900/80 rounded-2xl shadow-xl p-8 backdrop-blur-lg border border-boutique-100 dark:border-neutral-800">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="bg-white/80 dark:bg-neutral-900/80 rounded-2xl shadow-xl p-8 backdrop-blur-lg border border-boutique-100 dark:border-neutral-800">
                @include('profile.partials.update-password-form')
            </div>
            <div class="bg-white/80 dark:bg-neutral-900/80 rounded-2xl shadow-xl p-8 backdrop-blur-lg border border-boutique-100 dark:border-neutral-800">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
