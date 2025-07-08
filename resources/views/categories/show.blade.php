@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">تفاصيل الفئة</h2>
@endsection

@section('content')
<div class="py-8">
    <div class="max-w-2xl mx-auto bg-cream-100/80 dark:bg-neutral-900/80 rounded-2xl shadow-lg p-8 backdrop-blur-lg">
        <div class="flex flex-col items-center mb-8 gap-6 relative">
            <div class="absolute right-0 top-0 flex gap-2 z-10">
                <a href="{{ route('categories.edit', $category) }}" class="p-2 bg-boutique-500 hover:bg-boutique-600 text-white rounded-full shadow transition" title="تعديل">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4 12.362-12.726z" />
                    </svg>
                </a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الفئة؟');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 bg-red-700 hover:bg-red-800 text-white rounded-full shadow transition" title="حذف">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0v10a2 2 0 002 2h4a2 2 0 002-2V7" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="relative mb-4 group">
                <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('placeholder.png') }}"
                     alt="صورة الفئة"
                     class="w-56 h-56 object-cover rounded-3xl shadow-xl border-4 border-boutique-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 transition-transform duration-300 group-hover:scale-105 group-hover:shadow-[0_0_32px_0_rgba(255,180,0,0.15)]">
                <div class="absolute inset-0 rounded-3xl pointer-events-none"
                     style="background: linear-gradient(135deg, rgba(255,255,255,0.18) 0%, rgba(255,180,0,0.10) 100%); mix-blend-mode: lighten;"></div>
            </div>
            <h3 class="text-3xl font-bold text-boutique-900 dark:text-boutique-200 mb-2 text-center">{{ $category->name }}</h3>
            @if($category->description)
                <div class="text-neutral-800 dark:text-neutral-200 text-base text-center max-w-xl">{{ $category->description }}</div>
            @endif
        </div>
        <div class="mt-10">
            <h4 class="text-xl font-bold text-boutique-900 dark:text-boutique-200 mb-4">الفساتين ضمن هذه الفئة</h4>
            @if($category->dresses && $category->dresses->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($category->dresses as $dress)
                        <div class="bg-white/80 dark:bg-neutral-800/80 rounded-2xl shadow p-4 flex flex-col items-center hover:scale-105 transition-transform">
                            <img src="{{ $dress->image ? asset('storage/' . $dress->image) : asset('dress-placeholder.png') }}" alt="صورة الفستان" class="w-28 h-36 object-cover rounded-lg shadow mb-3 border border-boutique-100 dark:border-neutral-700 bg-white dark:bg-neutral-900">
                            <div class="text-lg font-semibold text-boutique-900 dark:text-boutique-200 mb-1">{{ $dress->name }}</div>
                            <div class="text-boutique-700 dark:text-boutique-300 font-bold">₪{{ number_format($dress->price, 2) }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-neutral-500 dark:text-neutral-400 text-center py-8">لا توجد فساتين ضمن هذه الفئة حالياً.</div>
            @endif
        </div>
        <a href="{{ route('categories.index') }}" class="mt-6 inline-block px-6 py-2 bg-gray-300 hover:bg-gray-400 text-boutique-900 rounded-xl font-bold shadow transition-all duration-300">رجوع</a>
    </div>
</div>
@endsection 