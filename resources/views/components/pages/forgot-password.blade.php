<x-layouts.blank>
    <x-slot:title>Request Reset Link</x-slot:title>
    <div class="flex justify-center items-center h-full">
        <form method="post" class="w-1/4 flex flex-col gap-4">
            @csrf
            <x-forms.inputs.email
                autocomplete="false"
                autofocus
                required
                value="{{ old('email') }}"
                name="email"
                id="email"
                label="Email" />

            <div class="flex justify-between items-center mt-8">
                <a href="" class="text-blue-400 hover:text-red-500">{{ __("Forget it, I remember my password") }}</a>
                <button class="bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded">{{ __("Send me reset link") }}</button>
            </div>
        </form>
    </div>
</x-layouts.blank>
