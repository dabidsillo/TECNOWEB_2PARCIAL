<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-100 via-white to-blue-100">
        <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full">
            <h2 class="text-3xl font-bold text-center mb-6 text-red-600">American Gianna</h2>
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-blue-700">Correo electrónico</label>
                    <div class="relative">
                        <x-text-input 
                            id="email" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required autofocus 
                            class="w-full px-4 py-3 rounded-lg bg-blue-50 border focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="john.doe@example.com"/>
                        <span class="absolute inset-y-0 right-3 flex items-center text-blue-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 4a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H4a2 2 0 01-2-2V4z" />
                            </svg>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-blue-700">Contraseña</label>
                    <div class="relative">
                        <x-text-input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            class="w-full px-4 py-3 rounded-lg bg-blue-50 border focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Introduce tu contraseña"/>
                        <span class="absolute inset-y-0 right-3 flex items-center text-blue-400">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 10h12M9 3l3 3-3 3M6 6v6h6" />
                            </svg>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <x-primary-button class="w-full py-3 rounded-lg bg-red-500 text-white font-semibold hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    {{ __('Iniciar sesión') }}
                </x-primary-button>
            </form>
            <p class="text-center text-gray-600 mt-4">¿No tienes una cuenta? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Registrar</a></p>
        </div>
    </div>
</x-guest-layout>
