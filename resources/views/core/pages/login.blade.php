<x-layout>
    @fragment('form')
    <form hx-post="{{url('/login')}}" hx-swap="outerHTML" class="flex justify-center m-auto max-w-screen-sm mt-5">
        @csrf
        <fieldset class="w-full p-4 grid grid-cols-1 gap-4">
            <legend class="text-primary text-2xl font-bold">Portal Login</legend>
            <x-input required :id="'email'" value="{{ old('email') }}" :label="'Email'" />
            <x-input required type="password" :id="'password'" value="{{ old('password') }}" :label="'Password'" />
            <x-checkbox :id="'remember-me'" :label="'Remember me on this computer'" />
            <x-button class="w-fit" type="submit">Sign In</x-button>
            @if(count($errors) > 0)
            <div class="mb-4">
                @foreach ($errors->all() as $error)
                <div class="bg-error text-error-content rounded-md p-4">
                    {{ $error }}
                </div>
                @endforeach
            </div>
            @endif
            <div class="flex no-wrap items-center">
                <hr class="flex-grow border-base-300 border-2" />
                <div class="mx-4 text-base-content/50">OR</div>
                <hr class="flex-grow border-base-300 border-2"/>
            </div>
            <a href="{{ url('/auth/redirect') }}">
                <button type="button"
                    class="w-full flex items-center gap-4 p-4 border rounded-md border-base-300 hover:bg-base-200">
                    <img class="w-10 h-10" src="https://orcid.filecamp.com/static/thumbs/42DBWh3MuwolJCUX-small.png" />
                    <span>
                        SIGN IN WITH ORCID
                    </span>
                </button>
            </a>

            <div>
                <p>
                    Don't have an account?
                </p>
                <x-link href="{{ url('/register') }}">Create an Account</x-link>
                <p>
                    Can't remember your password?
                </p>
                <x-link hx-boost="true" href="{{url('forgot-password')}}">Reset Password</x-link>
            </div>
        </fieldset>
    </form>
    @endfragment
</x-layout>
