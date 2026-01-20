<x-layout>
    <form class="flex flex-col w-full max-w-2xl ml-auto mr-auto" method="POST" action="/register">
        @csrf
        @if ($errors->any())
            <div>
                <span class="text-red-500">
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br/>
                    @endforeach
                </span>
            </div>
        @endif
        <div>
            <x-input-label for="lastname" value="Last Name" />
            <x-text-input id="lastname" name="lastname" class="mt-1 w-full" required />
        </div>
        <div>
            <x-input-label for="firstname" value="First Name" />
            <x-text-input id="firstname" name="firstname" class="mt-1 w-full" required />
        </div>
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input type="email" id="email" name="email" class="mt-1 w-full" required />
        </div>
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input type="password" id="password" name="password" class="mt-1 w-full" required />
        </div>
        <div>
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 w-full" required />
        </div>
        <div class="mt-6">
            <x-action-button class="w-full" type="submit">Create Account</x-action-button>
        </div>
    </form>
</x-layout>
