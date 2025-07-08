@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-boutique-900 dark:text-boutique-200 leading-tight">
        لوحة التحكم
    </h2>
@endsection

<style>
.tooltip {
    position: fixed;
    background: linear-gradient(135deg, #7a5a28 0%, #946e2e 100%);
    color: #fefcf9;
    padding: 16px 20px;
    border-radius: 12px;
    font-size: 14px;
    line-height: 1.5;
    white-space: pre-line;
    z-index: 1000;
    pointer-events: none;
    opacity: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    max-width: 320px;
    text-align: right;
    direction: rtl;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4), 0 4px 16px rgba(0, 0, 0, 0.2);
    border: 1px solid rgba(230, 192, 133, 0.2);
    backdrop-filter: blur(8px);
    font-weight: 500;
}

.tooltip::before {
    content: '';
    position: absolute;
    top: 50%;
    right: -8px;
    transform: translateY(-50%);
    width: 0;
    height: 0;
    border-left: 8px solid #946e2e;
    border-top: 8px solid transparent;
    border-bottom: 8px solid transparent;
}

.tooltip[style*="--arrow-position: left"]::before {
    right: auto;
    left: -8px;
    border-left: none;
    border-right: 8px solid #946e2e;
}

.tooltip.show {
    opacity: 1;
    transform: translateY(0);
}

.tooltip:not(.show) {
    transform: translateY(5px);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentTooltip = null;
    let currentElement = null;
    let hoverTimeout = null;
    let hideTimeout = null;
    let isHovering = false;
    
    // Function to remove existing tooltip
    function removeTooltip() {
        if (currentTooltip) {
            currentTooltip.classList.remove('show');
            setTimeout(() => {
                if (currentTooltip && currentTooltip.parentNode) {
                    currentTooltip.parentNode.removeChild(currentTooltip);
                }
                currentTooltip = null;
                currentElement = null;
            }, 150);
        }
        if (hoverTimeout) {
            clearTimeout(hoverTimeout);
            hoverTimeout = null;
        }
        if (hideTimeout) {
            clearTimeout(hideTimeout);
            hideTimeout = null;
        }
        isHovering = false;
    }
    
    // Function to create and show tooltip
    function showTooltip(element, e) {
        // Clear any existing timeouts
        if (hoverTimeout) {
            clearTimeout(hoverTimeout);
        }
        if (hideTimeout) {
            clearTimeout(hideTimeout);
            hideTimeout = null;
        }
        
        const tooltipText = element.getAttribute('data-tooltip');
        if (!tooltipText) return;
        
        // If we're already showing a tooltip for this element, don't recreate
        if (currentElement === element && currentTooltip) {
            return;
        }
        
        // Remove any existing tooltip
        if (currentTooltip) {
            currentTooltip.classList.remove('show');
            if (currentTooltip.parentNode) {
                currentTooltip.parentNode.removeChild(currentTooltip);
            }
        }
        
        currentTooltip = document.createElement('div');
        currentTooltip.className = 'tooltip';
        currentTooltip.textContent = tooltipText;
        
        document.body.appendChild(currentTooltip);
        currentElement = element;
        isHovering = true;
        
        // Position tooltip beside cursor but fixed
        let left = e.clientX + 20;
        let top = e.clientY - 30;
        
        // Adjust if tooltip goes off screen
        const tooltipRect = currentTooltip.getBoundingClientRect();
        
        if (left + tooltipRect.width > window.innerWidth - 20) {
            left = e.clientX - tooltipRect.width - 20;
            currentTooltip.style.setProperty('--arrow-position', 'left');
        } else {
            currentTooltip.style.setProperty('--arrow-position', 'right');
        }
        
        if (top + tooltipRect.height > window.innerHeight - 20) {
            top = e.clientY - tooltipRect.height - 10;
        }
        
        if (top < 20) {
            top = e.clientY + 20;
        }
        
        currentTooltip.style.left = left + 'px';
        currentTooltip.style.top = top + 'px';
        
        // Show tooltip immediately for better responsiveness
        hoverTimeout = setTimeout(() => {
            if (currentTooltip && currentElement === element && isHovering) {
                currentTooltip.classList.add('show');
            }
        }, 50);
    }
    
    // Debounced hide function
    function debouncedHide() {
        if (hideTimeout) {
            clearTimeout(hideTimeout);
        }
        hideTimeout = setTimeout(() => {
            if (!isHovering) {
                removeTooltip();
            }
        }, 100);
    }
    
    // Event delegation for better performance
    document.addEventListener('mouseover', function(e) {
        const target = e.target.closest('[data-tooltip]');
        if (target) {
            isHovering = true;
            showTooltip(target, e);
        }
    });
    
    document.addEventListener('mouseout', function(e) {
        const target = e.target.closest('[data-tooltip]');
        if (target && currentElement === target) {
            isHovering = false;
            debouncedHide();
        }
    });
    
    // Handle mouse movement to prevent tooltip from disappearing during fast movements
    document.addEventListener('mousemove', function(e) {
        const target = e.target.closest('[data-tooltip]');
        if (target && currentElement === target) {
            isHovering = true;
        }
    });
    
    // Clean up tooltips when mouse leaves the window
    document.addEventListener('mouseleave', function() {
        isHovering = false;
        removeTooltip();
    });
    
    // Clean up on page unload
    window.addEventListener('beforeunload', function() {
        removeTooltip();
    });
});
</script>

@section('content')
<div class="py-6" dir="rtl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-right">
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-boutique-900 dark:text-white mb-2 transition-all duration-500">مرحباً بعودتك، {{ Auth::user()->name }}!</h3>
            <p class="text-neutral-600 dark:text-neutral-300 transition-all duration-500">إليك لمحة سريعة عن نشاط عملك.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('categories.index') }}" class="bg-boutique-500 text-white rounded-xl shadow-lg p-6 flex items-center gap-4 transform hover:scale-105 transition-transform duration-300 focus:ring-4 focus:ring-boutique-200 outline-none">
                <div class="bg-white/20 rounded-full p-3">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                </div>
                <div>
                    <div class="text-lg font-bold">{{ $stats['categories'] ?? '--' }}</div>
                    <div class="text-sm">الفئات</div>
                </div>
            </a>
            <a href="{{ route('dresses.index') }}" class="bg-boutique-600 text-white rounded-xl shadow-lg p-6 flex items-center gap-4 transform hover:scale-105 transition-transform duration-300 focus:ring-4 focus:ring-boutique-200 outline-none">
                <div class="bg-white/20 rounded-full p-3">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 11h14l1 9a2 2 0 01-2 2H6a2 2 0 01-2-2l1-9z" /></svg>
                </div>
                <div>
                    <div class="text-lg font-bold">{{ $stats['dresses'] ?? '--' }}</div>
                    <div class="text-sm">الفساتين</div>
                </div>
            </a>
            <a href="{{ route('clients.index') }}" class="bg-boutique-700 text-white rounded-xl shadow-lg p-6 flex items-center gap-4 transform hover:scale-105 transition-transform duration-300 focus:ring-4 focus:ring-boutique-200 outline-none">
                <div class="bg-white/20 rounded-full p-3">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <div>
                    <div class="text-lg font-bold">{{ $stats['clients'] ?? '--' }}</div>
                    <div class="text-sm">الزبائن</div>
                </div>
            </a>
            <a href="{{ route('appointments.index') }}" class="bg-boutique-800 text-white rounded-xl shadow-lg p-6 flex items-center gap-4 transform hover:scale-105 transition-transform duration-300 focus:ring-4 focus:ring-boutique-200 outline-none">
                <div class="bg-white/20 rounded-full p-3">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div>
                    <div class="text-lg font-bold">{{ $stats['appointments'] ?? '--' }}</div>
                    <div class="text-sm">المواعيد</div>
                </div>
            </a>
            <a href="{{ route('contracts.index') }}" class="bg-boutique-900 text-white rounded-xl shadow-lg p-6 flex items-center gap-4 transform hover:scale-105 transition-transform duration-300 focus:ring-4 focus:ring-boutique-200 outline-none">
                <div class="bg-white/20 rounded-full p-3">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v16z" /></svg>
                </div>
                <div>
                    <div class="text-lg font-bold">{{ $stats['contracts'] ?? '--' }}</div>
                    <div class="text-sm">العقود</div>
                </div>
            </a>
            <a href="{{ route('payments.index') }}" class="bg-green-600 text-white rounded-xl shadow-lg p-6 flex items-center gap-4 transform hover:scale-105 transition-transform duration-300 focus:ring-4 focus:ring-green-200 outline-none">
                <div class="bg-white/20 rounded-full p-3 flex items-center justify-center">
                    <svg class="h-8 w-8 text-white" viewBox="0 0 24 24">
                        <text x="50%" y="50%" text-anchor="middle" dominant-baseline="central" font-size="18" font-family="Arial, sans-serif" fill="currentColor">₪</text>
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">₪ {{ $stats['payments'] ?? '--' }}</div>
                    <div class="text-sm">المدفوعات</div>
                </div>
            </a>
        </div>
        <!-- Revenue and Appointments Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <a href="{{ route('payments.index') }}" class="block">
                <div class="bg-cream-100/80 dark:bg-neutral-900/80 rounded-xl shadow-lg p-6 transition-all duration-500 hover:bg-cream-200/90 dark:hover:bg-neutral-900/90 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">الدخل الشهري ({{ now()->format('Y/m') }})</h4>
                        <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <div class="h-48 flex flex-col items-center justify-center text-neutral-700 dark:text-neutral-200 text-3xl font-bold">
                        ₪ {{ number_format($monthlyIncome, 2) }}
                    </div>
                </div>
            </a>
            <a href="{{ route('appointments.index') }}" class="block">
                <div class="bg-cream-100/80 dark:bg-neutral-900/80 rounded-xl shadow-lg p-6 transition-all duration-500 hover:bg-cream-200/90 dark:hover:bg-neutral-900/90 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">المواعيد الشهرية ({{ now()->format('Y/m') }})</h4>
                        <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <div class="h-48 flex flex-col items-center justify-center text-boutique-700 dark:text-boutique-200 text-3xl font-bold">
                        {{ $monthlyAppointments }}
                    </div>
                </div>
            </a>
        </div>

        <!-- Revenue Trends Chart -->
        <a href="{{ route('payments.index') }}" class="block">
            <div class="bg-cream-100/80 dark:bg-neutral-900/80 rounded-xl shadow-lg p-6 mb-8 transition-all duration-500 hover:bg-cream-200/90 dark:hover:bg-neutral-900/90 cursor-pointer">
                                    <div class="flex items-center justify-between mb-6">
                        <h4 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">تطور الإيرادات (آخر 6 أشهر)</h4>
                        <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
                <div class="h-64 flex items-end justify-between gap-2">
                    @foreach($revenueTrends as $trend)
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-full bg-boutique-600 rounded-t-lg transition-all duration-300 hover:bg-boutique-700" 
                                 style="height: {{ $trend['amount'] > 0 ? max(20, ($trend['amount'] / max(array_column($revenueTrends, 'amount'))) * 200) : 20 }}px;">
                            </div>
                            <div class="text-xs text-neutral-600 dark:text-neutral-400 mt-2 text-center">
                                {{ $trend['month'] }}
                            </div>
                            <div class="text-xs font-semibold text-neutral-800 dark:text-neutral-200 mt-1">
                                ₪{{ number_format($trend['amount'], 0) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </a>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top Categories -->
            <a href="{{ route('categories.index') }}" class="block">
                <div class="bg-cream-100/80 dark:bg-neutral-900/80 rounded-xl shadow-lg p-6 transition-all duration-500 hover:bg-cream-200/90 dark:hover:bg-neutral-900/90 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">أفضل الفئات</h4>
                        <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <div class="space-y-3">
                        @forelse($topCategories as $category)
                            <div class="flex items-center justify-between group relative cursor-pointer" 
                                 data-tooltip="فئة: {{ $category->name }}&#10;عدد الفساتين: {{ $category->dresses_count }}&#10;النسبة: {{ $category->dresses_count > 0 ? round(($category->dresses_count / $stats['dresses']) * 100, 1) : 0 }}% من إجمالي الفساتين">
                                <div class="flex items-center gap-3">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-8 h-8 rounded-lg object-cover">
                                    @else
                                        <div class="w-8 h-8 bg-neutral-300 dark:bg-neutral-600 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <span class="font-medium text-neutral-800 dark:text-neutral-200">{{ $category->name }}</span>
                                </div>
                                <span class="text-sm font-bold text-boutique-600 dark:text-boutique-400">{{ $category->dresses_count }} عدد الفساتين</span>
                            </div>
                        @empty
                            <p class="text-neutral-500 dark:text-neutral-400 text-center py-4">لا توجد فئات</p>
                        @endforelse
                    </div>
                </div>
            </a>

            <!-- Payment Methods -->
            <a href="{{ route('payments.index') }}" class="block">
                <div class="bg-cream-100/80 dark:bg-neutral-900/80 rounded-xl shadow-lg p-6 transition-all duration-500 hover:bg-cream-200/90 dark:hover:bg-neutral-900/90 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-neutral-800 dark:text-neutral-200">طرق الدفع</h4>
                        <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <div class="space-y-3">
                        @forelse($paymentMethods as $method)
                            <div class="flex items-center justify-between group relative cursor-pointer" 
                                 data-tooltip="طريقة الدفع: {{ $method['method'] }}&#10;عدد العمليات: {{ $method['count'] }}&#10;إجمالي المبلغ: ₪{{ number_format($method['total'], 0) }}&#10;النسبة: {{ $method['count'] > 0 ? round(($method['count'] / $stats['payments']) * 100, 1) : 0 }}% من إجمالي العمليات">
                                                                    <span class="font-medium text-neutral-800 dark:text-neutral-200">{{ $method['method'] }}</span>
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-neutral-600 dark:text-neutral-400">{{ $method['count'] }} عمليات</span>
                                    <span class="text-sm font-bold text-boutique-600 dark:text-boutique-400">₪{{ number_format($method['total'], 0) }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-neutral-500 dark:text-neutral-400 text-center py-4">لا توجد مدفوعات</p>
                        @endforelse
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Payments -->
            <a href="{{ route('payments.index') }}" class="block">
                <div class="bg-white/20 dark:bg-gray-900/80 rounded-xl shadow-lg p-6 transition-all duration-500 hover:bg-white/30 dark:hover:bg-gray-900/90 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">آخر المدفوعات</h4>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <div class="space-y-3">
                        @forelse($recentPayments as $payment)
                            <div class="flex items-center justify-between p-3 bg-white/10 dark:bg-gray-800/50 rounded-lg group relative cursor-pointer" 
                                 data-tooltip="الزبون: {{ $payment->client->name ?? 'غير محدد' }}&#10;المبلغ: ₪{{ number_format($payment->amount, 0) }}&#10;طريقة الدفع: {{ $payment->method == 'cash' ? 'نقداً' : ($payment->method == 'credit_card' ? 'بطاقة ائتمان' : 'تحويل بنكي') }}&#10;تاريخ الدفع: {{ \Carbon\Carbon::parse($payment->paid_at)->format('Y-m-d H:i') }}&#10;رقم العقد: {{ $payment->contract_id ?? 'غير محدد' }}">
                                <div class="flex items-center gap-3">
                                    @if($payment->client && $payment->client->image)
                                        <img src="{{ asset('storage/' . $payment->client->image) }}" alt="صورة الزبون" class="w-8 h-8 rounded-full object-cover">
                                    @else
                                        <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-800 dark:text-gray-200">{{ $payment->client->name ?? 'غير محدد' }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($payment->paid_at)->format('Y-m-d H:i') }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="font-bold text-green-600 dark:text-green-400">₪{{ number_format($payment->amount, 0) }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        @if($payment->method == 'cash')
                                            نقداً
                                        @elseif($payment->method == 'credit_card')
                                            بطاقة ائتمان
                                        @else
                                            تحويل بنكي
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-center py-4">لا توجد مدفوعات حديثة</p>
                        @endforelse
                    </div>
                </div>
            </a>

            <!-- Recent Appointments -->
            <a href="{{ route('appointments.index') }}" class="block">
                <div class="bg-white/20 dark:bg-gray-900/80 rounded-xl shadow-lg p-6 transition-all duration-500 hover:bg-white/30 dark:hover:bg-gray-900/90 cursor-pointer">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">آخر المواعيد</h4>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <div class="space-y-3">
                        @forelse($recentAppointments as $appointment)
                            <div class="flex items-center justify-between p-3 bg-white/10 dark:bg-gray-800/50 rounded-lg group relative cursor-pointer" 
                                 data-tooltip="الزبون: {{ $appointment->client->name ?? 'غير محدد' }}&#10;التاريخ: {{ $appointment->date }}&#10;الوقت: {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}&#10;الملاحظات: {{ $appointment->notes ?? 'لا توجد ملاحظات' }}">
                                <div class="flex items-center gap-3">
                                    @if($appointment->client && $appointment->client->image)
                                        <img src="{{ asset('storage/' . $appointment->client->image) }}" alt="صورة الزبون" class="w-8 h-8 rounded-full object-cover">
                                    @else
                                        <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-800 dark:text-gray-200">{{ $appointment->client->name ?? 'غير محدد' }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $appointment->date }} - {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-xs px-2 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900/60 dark:text-blue-300 rounded-full">
                                        موعد
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400 text-center py-4">لا توجد مواعيد حديثة</p>
                        @endforelse
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
