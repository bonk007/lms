<x-layouts.blank>
    <x-slot:title>Reset Password</x-slot:title>
    <div class="flex justify-center items-center h-full">
        <form method="post" class="w-1/4 flex flex-col gap-4">
            @csrf
            <x-forms.inputs.password
                autocomplete="false"
                required
                name="password"
                id="password"
                label="Password" />
            <x-forms.inputs.password
                required
                autocomplete="false"
                name="password_confirmation"
                id="password_confirmation"
                label="Password Confirmation" />

            <div class="flex justify-end items-center mt-8">
                <button class="bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded">{{ __("Reset Password") }}</button>
            </div>
        </form>
    </div>
</x-layouts.blank>
