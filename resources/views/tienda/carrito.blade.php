@extends('layouts.tienda')

@section('content')

    @php
        $pagina = \App\Models\Pagina::where('path', '=', request()->path())->first();
    @endphp

    <div class="container mx-auto px-6">

        <section>
            <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
                <div class="mx-auto max-w-4xl">
                    <header class="text-center">
                        @if (session('laQrImage'))
                            <h2 class="text-gray-600 dark:text-gray-200 text-2xl font-medium">QR Generado</h2>
                        @else
                            <h2 class="text-gray-600 dark:text-gray-200 text-2xl font-medium">Carrito de Compras</h2>
                        @endif
                    </header>

                    @if (session('error'))
                        <div class="alert alert-danger text-red-500 flex justify-center items-center text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('laQrImage'))
                        <div class="mt-8">
                            <div class="flex justify-center items-center">
                                <img src="{{ session('laQrImage') }}" alt="QR generado">
                            </div>
                        </div>
                    @else
                        <div id="carrito-de-compras" class="mt-8">
                            <ul id="lista-carrito" class="space-y-4">

                                {{-- LISTA DE PRODUCTOS DE MI CARRITO DE COMPRAS --}}

                            </ul>

                            <div class="mt-8 flex justify-end border-t border-gray-100 pt-8">
                                <div class="w-screen max-w-lg space-y-4">
                                    <dl class="space-y-0.5 text-gray-700 dark:text-gray-300">
                                        <div class="flex justify-between">
                                            <dt>Subtotal</dt>
                                            <dd id="subTotalValue">250 Bs</dd>
                                        </div>

                                        <div class="flex justify-between">
                                            <dt>Descuento</dt>
                                            <dd id="descuentoValue">10 Bs</dd>
                                        </div>

                                        <div class="flex justify-between !text-base font-medium">
                                            <dt>Total</dt>
                                            <dd id="totalValue">200 Bs</dd>
                                        </div>
                                    </dl>

                                    <div class="flex justify-end">
                                        <span
                                            class="inline-flex items-center justify-center rounded-full bg-indigo-100 dark:bg-indigo-500 px-2.5 py-0.5 text-indigo-700 dark:text-indigo-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="-ms-1 me-1.5 h-4 w-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                                            </svg>

                                            <p class="whitespace-nowrap text-xs">Descuento de promoción aplicado</p>
                                        </span>
                                    </div>

                                    <div class="flex justify-end" x-data="{ 'showModal': false }"
                                        @keydown.escape="showModal = false" x-cloak>

                                        <button @click="showModal = true"
                                            class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                            Proceder a Pagar
                                        </button>

                                        <!--Overlay-->

                                        <div style="background-color: rgba(0,0,0,0.5)" x-show="showModal"
                                            :class="{ 'fixed inset-0 z-10 flex items-center justify-center': showModal }">
                                            <!--Dialog-->
                                            <div class="bg-white dark:bg-gray-800 w-full md:max-w-xl mx-auto rounded shadow-lg py-4 text-left px-6"
                                                x-show="showModal" @click.away="showModal = false"
                                                x-transition:enter="ease-out duration-300"
                                                x-transition:enter-start="opacity-0 scale-90">
                                                <div class="flex justify-between items-center pb-3">
                                                    <p class="text-2xl font-medium text-gray-700 dark:text-gray-300">
                                                        PagoFacil</p>
                                                    <div class="cursor-pointer z-50" @click="showModal = false">
                                                        <svg class="fill-current text-black dark:text-white"
                                                            xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            viewBox="0 0 18 18">
                                                            <path
                                                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>

                                                @if (Auth::user())
                                                    <!-- content -->
                                                    <form id="ventaForm" method="POST" action="{{ route('venta.store') }}">
                                                        @csrf

                                                        <input id="cartForm" type="hidden" name="cart" value="">
                                                        <input id="totalForm" type="hidden" name="total" value="">

                                                        <div class="flex flex-col mb-2">
                                                            <label for="nombre"
                                                                class="text-gray-600 dark:text-gray-200">Nombre y
                                                                Apellidos</label>
                                                            <input value="{{ Auth::user()->nombre }}" name="nombre"
                                                                class="form-input outline-none w-full rounded-md"
                                                                type="text" placeholder="Ricky Ramirez">
                                                        </div>
                                                        <div class="flex flex-col mb-2">
                                                            <label for="email"
                                                                class="text-gray-600 dark:text-gray-200">Email</label>
                                                            <input value="{{ Auth::user()->email }}" name="email"
                                                                class="form-input w-full rounded-md" type="email"
                                                                placeholder="ramirez@gmail.com">
                                                        </div>
                                                        <div class="flex flex-col mb-2">
                                                            <label for="telefono"
                                                                class="text-gray-600 dark:text-gray-200">Telefono</label>
                                                            <input value="{{ Auth::user()->telefono }}" name="telefono"
                                                                class="form-input w-full rounded-md" type="number"
                                                                min="0" minlength="8" placeholder="12345678">
                                                        </div>

                                                        <div class="flex flex-col mb-2">
                                                            <label for="id_servicio"
                                                                class="text-gray-600 dark:text-gray-200">Servicio Adicional
                                                                (Bs)</label>
                                                            <select name="id_servicio" id="id_servicio"
                                                                class="form-input w-full rounded-md">
                                                                <option selected value="0">Seleccionar Servicio
                                                                </option>
                                                                @foreach ($servicios as $servicio)
                                                                    <option value="{{ $servicio->id }}">
                                                                        {{ $servicio->nombre }} | Precio:
                                                                        {{ $servicio->precio }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="flex flex-col mb-2">
                                                            <label for="tipoPago"
                                                                class="text-gray-600 dark:text-gray-200">Tipo de
                                                                pago</label>
                                                            <select name="tipo_pago" id="tipoPago"
                                                                class="form-input w-full rounded-md">
                                                                <option value="1">Servicio QR</option>
                                                                <option value="2">Tigo Money</option>
                                                            </select>
                                                        </div>


                                                        <!--Footer-->
                                                        <div class="flex justify-between items-center pt-2">
                                                            <div id="formLoading"
                                                                class="flex justify-center items-center gap-2">
                                                                <p class="font-semibold text-gray-800 dark:text-gray-200">
                                                                    Generando QR</p>
                                                                <img class="h-7 w-7 bg-cover"
                                                                    src="https://i.gifer.com/origin/34/34338d26023e5515f6cc8969aa027bca.gif"
                                                                    alt="loading">
                                                            </div>
                                                            <button id="botonPagar"
                                                                class="px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                                                Pagar
                                                            </button>
                                                            {{-- <button class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2" @click="alert('Additional Action');">Action</button> --}}
                                                        </div>
                                                    </form>
                                                @else
                                                    <div class="gap-2 mt-4">
                                                        <h3 class=" font-semibold uppercase">Debe iniciar sesión para poder
                                                            comprar</h3>
                                                        <br>
                                                        <a href="{{ route('login') }}" target="_blank"
                                                            class="px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                                            Iniciar Sesión
                                                        </a>

                                                    </div>
                                                @endif

                                            </div>
                                            <!--/Dialog -->
                                        </div>

                                        <!-- /Overlay -->

                                    </div>
                                </div>
                            </div>

                        </div>

                    @endif


                </div>
            </div>
        </section>

        <footer class="mt-10">
            <h3 class="text-gray-600 dark:text-gray-200 text-xl font-medium">Visitas: {{ $pagina->visitas }}</h3>
        </footer>

    </div>

@endsection


@section('js')
@endsection
