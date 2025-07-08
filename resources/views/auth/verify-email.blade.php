<x-guest-layout>
    <h1 class="text-2xl font-bold mb-6">تأكيد البريد الإلكتروني</h1>
    <p class="mb-4 text-sm text-gray-600 dark:text-gray-400">شكرًا لتسجيلك! قبل البدء، يرجى تأكيد بريدك الإلكتروني من خلال النقر على الرابط الذي أرسلناه لك. إذا لم يصلك البريد، سنرسل لك رابطًا آخر بكل سرور.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            تم إرسال رابط تحقق جديد إلى بريدك الإلكتروني الذي أدخلته أثناء التسجيل.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <button form="send-verification" type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">إعادة إرسال رابط التحقق</button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">تسجيل الخروج</button>
        </form>
    </div>
</x-guest-layout>
