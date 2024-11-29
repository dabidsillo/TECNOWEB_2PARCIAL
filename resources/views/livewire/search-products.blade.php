<div class="container mx-auto px-6">
    <div class="relative mt-6 max-w-lg mx-auto flex justify-center items-center">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                <path
                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>

        {{-- BUSCADOR --}}
        <input wire:model.live="search" type="search"
            class="w-full border dark:bg-gray-900 dark:text-gray-200 rounded-md pl-10 pr-4 py-2 focus:border-blue-500 dark:focus:border-gray-500 focus:outline-none focus:shadow-outline"
            placeholder="Buscar">
    </div>

    {{-- Resultados de la búsqueda --}}
    <div class="relative mt-6 max-w-4xl mx-auto flex justify-center items-center mb-4">
        @if ($products->isNotEmpty())
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  mt-12">
                @foreach ($products as $producto)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"
                            style="background-image: url('{{ $producto->imagen }}')">
                            {{-- ADICIONAR AL CARRITO --}}
                            <button.
                                onclick="addToCart({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }}, '{{ $producto->imagen }}', {{ $producto->promocion->descuento ?? 0 }})"
                                class="cursor-pointer p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                </button>
                        </div>
                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 dark:text-gray-200"> {{ $producto->nombre }} </h3>
                            <span class="text-gray-500 dark:text-gray-300 mt-2">Precio: {{ $producto->precio }}
                                Bs</span>
                            <br>
                            <span class="text-gray-500 dark:text-gray-300 mt-2">Stock: {{ $producto->stock }}</span>
                            <br>
                            <span class="text-gray-500 dark:text-gray-300 mt-2">Descuento:
                                {{ $producto->promocion->descuento ?? 0 }} %</span>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
