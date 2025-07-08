@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        {{ __('Appointments') }}
    </h2>
@endsection

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
            <div class="flex items-center gap-4">
                <form method="GET" class="flex items-center gap-4">
                    <label for="perPage" class="text-neutral-400">عرض:</label>
                    <select name="perPage" id="perPage" class="bg-boutique-800 text-white w-20 px-3 py-1 border border-boutique-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-boutique-500" onchange="this.form.submit()">
                        <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                        <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>الكل</option>
                    </select>
                    
                    <label for="sort" class="text-neutral-400 mr-4">ترتيب:</label>
                    <select name="sort" id="sort" class="bg-boutique-800 text-white px-3 py-1 border border-boutique-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-boutique-500" onchange="this.form.submit()">
                        <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>الأحدث أولاً</option>
                        <option value="asc" {{ request('sort', 'desc') == 'asc' ? 'selected' : '' }}>الأقدم أولاً</option>
                    </select>
                    
                    @if(request('perPage') || request('sort'))
                        <a href="{{ route('appointments.index') }}" class="text-neutral-400 hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    @endif
                </form>
                
                <form id="bulkDeleteForm" method="POST" action="{{ route('appointments.bulkDelete') }}" onsubmit="return confirm('هل تريد حذف العناصر المحددة؟');">
                    @csrf
                    <input type="hidden" name="ids" id="bulkDeleteIds">
                    <button type="submit" class="px-4 py-2 bg-red-700 hover:bg-red-800 text-white rounded-lg font-bold shadow transition disabled:opacity-50" id="bulkDeleteBtn" disabled>حذف المحدد</button>
                </form>
            </div>
            <a href="{{ route('appointments.create') }}" class="inline-block px-5 py-2 bg-boutique-700 hover:bg-boutique-800 text-white rounded-lg font-bold shadow-lg ring-2 ring-boutique-700/30 hover:ring-boutique-400/40 transition">إضافة موعد</a>
        </div>
        <div class="overflow-x-auto rounded-2xl shadow-lg border-0 bg-cream-100/80 dark:bg-neutral-900/80 backdrop-blur-lg">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 text-right rounded-2xl overflow-hidden">
                <thead class="bg-cream-200/60 dark:bg-neutral-900/60 sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-4 text-neutral-700 dark:text-neutral-200 w-8">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-boutique-600 bg-boutique-800 border-boutique-600 rounded focus:ring-0 transition-transform transition-opacity duration-200 select-all-animate" onclick="toggleAllAppointments(this)">
                                <span class="text-boutique-700 dark:text-boutique-200 text-sm font-semibold transition-opacity duration-200 select-all-animate">تحديد الكل</span>
                            </div>
                        </th>
                        <th class="px-4 py-4 text-neutral-700 dark:text-neutral-200">رقم الموعد</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200 text-center">صورة الزبون</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200">اسم الزبون</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200">التاريخ</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200">الوقت</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200">نوع الموعد</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200">نوع الفستان</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200">ملاحظة</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($appointments as $appointment)
                        <tr onclick="window.location='{{ route('appointments.show', $appointment) }}'" class="cursor-pointer hover:bg-boutique-100 dark:hover:bg-boutique-900 transition even:bg-cream-100/30 dark:even:bg-neutral-900/30" style="cursor:pointer;" data-id="{{ $appointment->id }}">
                            <td class="px-4 py-4 text-center">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-boutique-600 bg-boutique-800 border-boutique-600 rounded focus:ring-0 appointment-checkbox" onclick="event.stopPropagation();">
                            </td>
                            <td class="px-6 py-4 font-bold text-boutique-700 dark:text-boutique-200">#{{ $appointment->id }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($appointment->client && $appointment->client->image)
                                    <img src="{{ asset('storage/' . $appointment->client->image) }}" alt="صورة الزبون" class="w-14 h-14 rounded-full object-cover border-2 border-white/40 dark:border-gray-800 shadow-lg mx-auto block" />
                                @else
                                    <img src="/client-placeholder.png" alt="صورة افتراضية" class="w-14 h-14 rounded-full object-cover border-2 border-white/40 dark:border-gray-800 shadow-lg mx-auto block" />
                                @endif
                            </td>
                            <td class="px-6 py-4 font-extrabold text-boutique-900 dark:text-white">{{ $appointment->client->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-neutral-700 dark:text-neutral-200">{{ $appointment->date }}</td>
                            <td class="px-6 py-4 text-neutral-700 dark:text-neutral-200">{{ $appointment->time }}</td>
                            <td class="px-6 py-4 text-neutral-700 dark:text-neutral-200">{{ $appointment->type }}</td>
                            <td class="px-6 py-4 text-neutral-700 dark:text-neutral-200">{{ $appointment->dress_type }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block bg-cream-200/30 dark:bg-neutral-900/60 text-neutral-700 dark:text-neutral-200 px-4 py-1 rounded-full text-xs font-bold shadow">{{ $appointment->notes }}</span>
                            </td>
                            <td class="px-6 py-4 flex gap-2 justify-end">
                                <a href="{{ route('appointments.edit', $appointment) }}" onclick="event.stopPropagation();" class="bg-boutique-600 hover:bg-boutique-700 text-white px-4 py-2 rounded-xl font-bold shadow transition-all duration-300 flex items-center gap-1" title="تعديل">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4 12.362-12.726z" />
                                    </svg>
                                </a>
                                <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" onsubmit="event.stopPropagation(); return confirm('هل تريد حذف هذا الموعد؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded-xl shadow transition-all duration-300 flex items-center gap-1 font-semibold" title="حذف">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7h12M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0v10a2 2 0 002 2h4a2 2 0 002-2V7" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-neutral-500 dark:text-neutral-300 py-8">لا توجد مواعيد.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-center">
            {{ $appointments->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
<script>
function toggleAllAppointments(master) {
    document.querySelectorAll('.appointment-checkbox').forEach(cb => cb.checked = master.checked);
    updateBulkDeleteBtn();
}
document.querySelectorAll('.appointment-checkbox').forEach(cb => cb.addEventListener('change', updateBulkDeleteBtn));
function updateBulkDeleteBtn() {
    const checked = Array.from(document.querySelectorAll('.appointment-checkbox')).filter(cb => cb.checked);
    document.getElementById('bulkDeleteBtn').disabled = checked.length === 0;
    document.getElementById('bulkDeleteIds').value = checked.map(cb => cb.closest('tr').dataset.id).join(',');
}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.appointment-checkbox').forEach(cb => cb.addEventListener('change', updateBulkDeleteBtn));
    updateBulkDeleteBtn();
});

document.querySelectorAll('.select-all-animate').forEach(el => {
    el.addEventListener('mousedown', function() {
        this.classList.add('scale-110', 'opacity-70');
    });
    el.addEventListener('mouseup', function() {
        setTimeout(() => this.classList.remove('scale-110', 'opacity-70'), 200);
    });
    el.addEventListener('mouseleave', function() {
        this.classList.remove('scale-110', 'opacity-70');
    });
});
</script>
@endsection 

@push('styles')
<style>
    .select-all-animate:active, .select-all-animate:focus {
        transform: scale(1.1);
        opacity: 0.7;
        transition: transform 0.2s, opacity 0.2s;
    }
</style>
@endpush 