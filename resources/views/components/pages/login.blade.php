<x-layouts.blank>
    <x-slot:title>Login</x-slot:title>
    <div class="flex justify-center items-center h-full">
        <form method="post" class="w-1/4 flex flex-col gap-4">
            @csrf
            <x-forms.inputs.email
                autocomplete="false"
                autofocus
                name="email"
                id="email"
                label="Email" />
            <x-forms.inputs.password
                autocomplete="false"
                name="password"
                id="password"
                label="Password" />
            <x-forms.inputs.checkbox
                name="remember"
                label="keep me signed in"
                label-position="right" />
            <div class="flex justify-between items-center mt-8">
                <a href="" class="text-blue-400 hover:text-red-500">{{ __("Forgot password") }}</a>
                <button class="bg-slate-950 dark:bg-green-600 dark:hover:bg-green-400 hover:bg-red-500 text-slate-50 px-8 py-3 rounded">Login</button>
            </div>
            <div class="flex justify-center items-center">
                <a href="" class="text-blue-400 hover:text-red-500">{{ __("Doesn't have account?") }}</a>
            </div>
        </form>
    </div>
</x-layouts.blank>
