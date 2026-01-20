<x-layout>
    <form class="flex flex-col w-full max-w-2xl ml-auto mr-auto" method="POST" action="/login">
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
            <x-input-label for="email" value="Email" />
            <x-text-input type="email" id="email" name="email" class="mt-1 w-full" required />
        </div>
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input type="password" id="password" name="password" class="mt-1 w-full" required />
        </div>
        <div class="mt-6 flex gap-6 items-center">
            <x-action-button class="w-full" type="submit">Log In</x-action-button>
            <label class="whitespace-nowrap">
                <input type="checkbox" name="remember">
                Remember me
            </label>
        </div>
    </form>
</x-layout>
