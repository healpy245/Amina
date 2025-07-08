@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        {{ __('Clients') }}
    </h2>
@endsection

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
            <div class="flex items-center gap-4">
                <form method="GET" class="flex items-center">
                    <label for="perPage" class="text-neutral-400 mr-4">عرض:</label>
                    <select name="perPage" id="perPage" class="bg-boutique-800 text-white w-20 px-3 py-1 border border-boutique-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-boutique-500" onchange="this.form.submit()">
                        <option value="10" {{ request('perPage', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                        <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>الكل</option>
                    </select>
                </form>
                <form id="bulkDeleteForm" method="POST" action="{{ route('clients.bulkDelete') }}" onsubmit="return confirm('هل تريد حذف العناصر المحددة؟');">
                    @csrf
                    <input type="hidden" name="ids" id="bulkDeleteIds">
                    <button type="submit" class="ml-2 px-4 py-2 bg-red-700 hover:bg-red-800 text-white rounded-lg font-bold shadow transition disabled:opacity-50" id="bulkDeleteBtn" disabled>حذف المحدد</button>
                </form>
            </div>
            <a href="{{ route('clients.create') }}" class="inline-block px-5 py-2 bg-boutique-700 hover:bg-boutique-800 text-white rounded-lg font-bold shadow-lg ring-2 ring-boutique-700/30 hover:ring-boutique-400/40 transition">إضافة عميل</a>
        </div>
        <div class="overflow-x-auto rounded-2xl shadow-lg border-0 bg-cream-100/80 dark:bg-neutral-900/80 backdrop-blur-lg">
            <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-700 text-right rounded-2xl overflow-hidden">
                <thead class="bg-cream-200/60 dark:bg-neutral-900/60 sticky top-0 z-10">
                    <tr>
                        <th class="px-4 py-4 text-neutral-700 dark:text-neutral-200 w-8 whitespace-nowrap">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-boutique-600 bg-boutique-800 border-boutique-600 rounded focus:ring-0 transition-transform transition-opacity duration-200" onclick="toggleAllClients(this)">
                                <span class="text-boutique-700 dark:text-boutique-200 text-sm font-semibold transition-opacity duration-200">تحديد الكل</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200 text-center whitespace-nowrap">صورة</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">الاسم</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">رقم الهاتف</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">البريد الإلكتروني</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">العنوان</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">البلد</th>
                        <th class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($clients as $client)
                        <tr onclick="window.location='{{ route('clients.show', $client) }}'" class="cursor-pointer hover:bg-boutique-100 dark:hover:bg-boutique-900 transition even:bg-cream-100/30 dark:even:bg-neutral-900/30" style="cursor:pointer;" data-id="{{ $client->id }}">
                            <td class="px-4 py-4 text-center whitespace-nowrap">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-boutique-600 bg-boutique-800 border-boutique-600 rounded focus:ring-0 client-checkbox" onclick="event.stopPropagation();">
                            </td>
                            <td class="px-6 py-4 text-center whitespace-nowrap">
                                @if($client->image)
                                    <img src="{{ asset('storage/' . $client->image) }}" alt="صورة" class="w-14 h-14 rounded-xl object-cover shadow border-2 border-cream-200/40 dark:border-neutral-800 mx-auto block" />
                                @else
                                    <img src="/client-placeholder.png" alt="صورة افتراضية" class="w-14 h-14 rounded-xl object-cover shadow border-2 border-cream-200/40 dark:border-neutral-800 mx-auto block" />
                                @endif
                            </td>
                            <td class="px-6 py-4 font-extrabold text-boutique-900 dark:text-white whitespace-nowrap">{{ $client->name }}</td>
                            <td class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">{{ $client->phone }}</td>
                            <td class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">{{ $client->email }}</td>
                            <td class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">{{ $client->address }}</td>
                            <td class="px-6 py-4 text-neutral-700 dark:text-neutral-200 whitespace-nowrap">{{ $client->country ?? '-' }}</td>
                            <td class="px-6 py-4 flex gap-2 justify-end whitespace-nowrap">
                                <a href="{{ route('clients.edit', $client) }}" onclick="event.stopPropagation();" class="bg-boutique-600 hover:bg-boutique-700 text-white px-4 py-2 rounded-xl font-bold shadow transition-all duration-300 flex items-center gap-1" title="تعديل">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4 1 1-4 12.362-12.726z" />
                                    </svg>
                                </a>
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="event.stopPropagation(); return confirm('هل تريد حذف هذا الزبون؟');">
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
                            <td colspan="7" class="text-center text-neutral-500 dark:text-neutral-300 py-8">لا توجد عملاء.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-center">
            {{ $clients->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
<script>
function toggleAllClients(master) {
    document.querySelectorAll('.client-checkbox').forEach(cb => cb.checked = master.checked);
    updateBulkDeleteBtn();
}
document.querySelectorAll('.client-checkbox').forEach(cb => cb.addEventListener('change', updateBulkDeleteBtn));
function updateBulkDeleteBtn() {
    const checked = Array.from(document.querySelectorAll('.client-checkbox')).filter(cb => cb.checked);
    document.getElementById('bulkDeleteBtn').disabled = checked.length === 0;
    document.getElementById('bulkDeleteIds').value = checked.map(cb => cb.closest('tr').dataset.id).join(',');
}
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.client-checkbox').forEach(cb => cb.addEventListener('change', updateBulkDeleteBtn));
    updateBulkDeleteBtn();
});
</script>
@endsection 