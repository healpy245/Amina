<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ 'معلومات الملف الشخصي' }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ 'قم بتحديث معلومات ملفك الشخصي وعنوان بريدك الإلكتروني.' }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mt-10 sm:mt-0" dir="rtl">
            <div class="md:grid md:grid-cols-3 md:gap-6 text-right">
                <div class="mt-1 block w-full">
            <x-input-label for="name" :value="'الاسم'" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

                <div class="mt-1 block w-full">
            <x-input-label for="email" :value="'البريد الإلكتروني'" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-1">
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ 'عنوان بريدك الإلكتروني غير موثق.' }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ 'انقر هنا لإعادة إرسال رسالة التحقق.' }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ 'تم إرسال رابط تحقق جديد إلى بريدك الإلكتروني.' }}
                        </p>
                    @endif
                </div>
            @endif
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ 'حفظ' }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ 'تم الحفظ.' }}</p>
            @endif
        </div>
    </form>
</section>
