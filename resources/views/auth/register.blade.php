<x-guest-layout>
    @php
$pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
@endphp

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="nombre" :value="__('Nombre')" />
            <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" :value="old('nombre')" required autofocus autocomplete="nombre" />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Telefono -->
        <div>
            <x-input-label for="telefono" :value="__('Telefono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autofocus autocomplete="telefono" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>
        
        <!-- Direccion -->
        <div>
            <x-input-label for="direccion" :value="__('Direccion')" />
            <x-text-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" :value="old('direccion')" required autofocus autocomplete="direccion" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <!-- Ci -->
        <div>
            <x-input-label for="ci" :value="__('Ci')" />
            <x-text-input id="ci" class="block mt-1 w-full" type="text" name="ci" :value="old('ci')" required autofocus autocomplete="ci" />
            <x-input-error :messages="$errors->get('ci')" class="mt-2" />
        </div>
        

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('¿Ya registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
    <footer class="mt-10">
        <h3 class="text-gray-600 dark:text-gray-400 text-xl font-medium">Visitas: {{ $pagina->visitas }}</h3>
      </footer>
</x-guest-layout>
