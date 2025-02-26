<x-layouts.blank>
    <x-slot:title>Register</x-slot:title>
    <div class="flex justify-center items-center h-full">
        <form method="post" class="w-1/4 flex flex-col gap-4">
            @if(!empty($message))
                <div class="{{ $success ? 'border-green-600 bg-green-500/30' : 'border-red-600 bg-red-500/30' }} px-6 py-3">
                    {{ $message }}
                </div>
            @endif
            @csrf
            <x-forms.inputs.text
                autocomplete="false"
                autofocus
                required
                value="{{ old('name') }}"
                name="name"
                id="name"
                label="Name" />
            <x-forms.inputs.email
                autocomplete="false"
                autofocus
                required
                value="{{ old('email') }}"
                name="email"
                id="email"
                label="Email" />
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

            <div class="flex justify-between items-center mt-8">
                <a href="" class="text-blue-400 hover:text-red-500">{{ __("Already have account?") }}</a>
                <button class="bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded">Register</button>
            </div>
        </form>
    </div>
</x-layouts.blank>
