<x-layout>
    <form hx-post="{{ url('forgot-password') }}" hx-swap="outerHTML"
        class="flex justify-center m-auto max-w-screen-sm mt-5">
        @csrf
        <fieldset class="w-full p-4 grid grid-cols-1 gap-4">
            <legend class="text-primary text-2xl font-bold">Reset Password</legend>
            <x-input type="email" label="Email" id="email" />
            <x-button type="submit">Send Email</x-button>
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            @if(count($errors) > 0)
            <div class="mb-4">
                @foreach ($errors->all() as $error)
                <div class="bg-error text-error-content rounded-md p-4">
                    {{ $error }}
                </div>
                @endforeach
            </div>
            @endif
            <div>
                <x-link hx-boost="true" href="{{ url('/login') }}">Back to Login</x-link>
            </div>
        </fieldset>
    </form>
</x-layout>
