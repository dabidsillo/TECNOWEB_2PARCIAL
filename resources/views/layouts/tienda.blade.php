<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>American Gianna</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="{{ $modo }}">

    <div x-data="{ cartOpen: false, isOpen: false }" class="bg-white dark:bg-gray-800">
        <header>
            <div class="container mx-auto px-6 py-3">
                <div class="flex items-center justify-between">
                    <div class="hidden w-full text-gray-600 dark:text-gray-300 md:flex md:items-center">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.06298 10.063 6.27212 12.2721 6.27212C14.4813 6.27212 16.2721 8.06298 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16755 11.1676 8.27212 12.2721 8.27212C13.3767 8.27212 14.2721 9.16755 14.2721 10.2721Z"
                                fill="currentColor" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.39409 5.48178 3.79417C8.90918 0.194243 14.6059 0.054383 18.2059 3.48178C21.8058 6.90918 21.9457 12.6059 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.97318 6.93028 5.17324C9.59603 2.3733 14.0268 2.26452 16.8268 4.93028C19.6267 7.59603 19.7355 12.0268 17.0698 14.8268Z"
                                fill="currentColor" />
                        </svg>
                        <span class="mx-1 text-sm">Bolivia</span>
                    </div>
                    <div class="w-full text-gray-700 dark:text-gray-200 md:text-center text-2xl font-semibold">
                        American Gianna
                    </div>
                    <div class="flex items-center justify-end w-full">
                        <button @click="cartOpen = !cartOpen"
                            class="text-gray-600 dark:text-gray-300 focus:outline-none mx-4 sm:mx-0">
                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </button>
                        <form action="{{ route('tienda.setTheme') }}" method="POST">
                            @csrf
                            @if ($modo == 'dark')
                                <button type="submit"
                                    class="text-gray-600 dark:text-gray-200 focus:outline-none mx-4 sm:mx-3 py-1">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M494.2 221.9l-59.8-40.5 13.7-71c2.6-13.2-1.6-26.8-11.1-36.4-9.6-9.5-23.2-13.7-36.2-11.1l-70.9 13.7-40.4-59.9c-15.1-22.3-51.9-22.3-67 0l-40.4 59.9-70.8-13.7C98 60.4 84.5 64.5 75 74.1c-9.5 9.6-13.7 23.1-11.1 36.3l13.7 71-59.8 40.5C6.6 229.5 0 242 0 255.5s6.7 26 17.8 33.5l59.8 40.5-13.7 71c-2.6 13.2 1.6 26.8 11.1 36.3 9.5 9.5 22.9 13.7 36.3 11.1l70.8-13.7 40.4 59.9C230 505.3 242.6 512 256 512s26-6.7 33.5-17.8l40.4-59.9 70.9 13.7c13.4 2.7 26.8-1.6 36.3-11.1 9.5-9.5 13.6-23.1 11.1-36.3l-13.7-71 59.8-40.5c11.1-7.5 17.8-20.1 17.8-33.5-.1-13.6-6.7-26.1-17.9-33.7zm-112.9 85.6l17.6 91.2-91-17.6L256 458l-51.9-77-90.9 17.6 17.6-91.2-76.8-52 76.8-52-17.6-91.2 91 17.6L256 53l51.9 76.9 91-17.6-17.6 91.1 76.8 52-76.8 52.1zM256 152c-57.3 0-104 46.7-104 104s46.7 104 104 104 104-46.7 104-104-46.7-104-104-104zm0 160c-30.9 0-56-25.1-56-56s25.1-56 56-56 56 25.1 56 56-25.1 56-56 56z" />
                                    </svg>
                                </button>
                            @else
                                <button type="submit"
                                    class="text-gray-600 dark:text-gray-200 focus:outline-none mx-4 sm:mx-3 py-1">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M279.1 512c78.8 0 151-35.8 198.8-94.8 28.3-34.8-2.6-85.7-46.2-77.4-82.3 15.7-158.3-47.3-158.3-130.8 0-48.4 26.1-92.3 67.4-115.8 38.7-22.1 29-80.8-15-88.9A257.9 257.9 0 0 0 279.1 0c-141.4 0-256 114.6-256 256 0 141.4 114.6 256 256 256zm0-464c13 0 25.7 1.2 38 3.5-54.8 31.2-91.7 90-91.7 157.6 0 113.8 103.6 199.2 215.3 177.9C402.6 434 344.4 464 279.1 464c-114.9 0-208-93.1-208-208s93.1-208 208-208z" />
                                    </svg>
                                </button>
                            @endif
                        </form>

                        @if (Auth::user())
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="mx-4 sm:mx-3 text-sm px-2 py-2 bg-red-600 text-white font-medium rounded hover:bg-red-500 focus:outline-none focus:bg-red-500">
                                    Cerrar Sesión
                                </button>
                            </form>
                            <a href="{{ route('dashboard') }}" target="_blank"
                                class="mx-4 sm:mx-3 text-sm px-2 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" target="_blank"
                                class="mx-4 sm:mx-3 text-sm px-2 py-2 bg-blue-600 text-white font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                Iniciar Sesión
                            </a>
                        @endif

                        {{-- Movil --}}
                        <div class="flex sm:hidden">
                            <button @click="isOpen = !isOpen" type="button"
                                class="text-gray-600 dark:text-gray-300 hover:text-gray-500 focus:outline-none focus:text-gray-500"
                                aria-label="toggle menu">
                                <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                                    <path fill-rule="evenodd"
                                        d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                                    </path>
                                </svg>
                            </button>
                        </div>

                    </div>
                </div>
                <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                    <div class="flex flex-col sm:flex-row">
                        <a class="mt-3 text-gray-600 dark:text-gray-300 hover:underline sm:mx-3 sm:mt-0"
                            href="{{ route('tienda.index') }}">Tienda</a>
                        <a class="mt-3 text-gray-600 dark:text-gray-300 hover:underline sm:mx-3 sm:mt-0"
                            href="{{ route('carrito') }}">Carrito de Compras</a>
                    </div>
                </nav>

            </div>
        </header>

        {{-- CARRITO DE COMPRAS --}}
        <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'"
            class="fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto bg-white dark:bg-gray-800 border-l-2 border-gray-300 dark:border-gray-600">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl font-medium text-gray-700 dark:text-gray-200">Tú carrito</h3>
                <button @click="cartOpen = !cartOpen" class="text-gray-600 dark:text-gray-200 focus:outline-none">
                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <hr class="my-3">

            {{-- AQUI SE CARGAN TODOS LOS PRODUCTOS ADICIONADOS AL CARRITO --}}
            <div id="carrito">

            </div>
            <a href="{{ route('carrito') }}"
                class="flex items-center justify-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                <span>Ver carrito</span>
                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>


        <main class="my-8">

            @section('content')

            @show

        </main>

        <footer class="bg-gray-200 dark:bg-gray-900">
            <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                <a href="#"
                    class="text-xl font-bold text-gray-500 dark:text-gray-200 hover:text-gray-400">American Gianna</a>
                <h3 class="text-gray-600 dark:text-gray-200 text-xl font-medium">Visitas: {{ $pagina->visitas }}</h3>

                <p class="py-2 text-gray-500 sm:py-0">Todos los derechos reservados</p>
            </div>
        </footer>
    </div>

    @livewireScripts

    {{-- IMPORTANTE ESTE SCRIPT PARA CUANDO ESTA SUBIDO AL SERVIDOR --}}
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}

    <script>
        const updateCartUI = () => {
            const cartContainer = document.getElementById('carrito');

            cartContainer.innerHTML = '';

            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            cart.forEach(product => {
                const productElement = document.createElement('div');
                productElement.className = 'flex justify-between mt-6';

                productElement.innerHTML = `
      <div class="flex">
        <img class="h-20 w-14 object-cover rounded" src="${product.imagen}" alt="${product.nombre}">
        <div class="mx-3">
          <h3 class="text-sm text-gray-600 dark:text-gray-200">${product.nombre}</h3>
          <div class="flex items-center mt-2">
            <button onclick="incrementarCantidad(${product.id})" class="text-gray-500 dark:text-gray-200 focus:outline-none focus:text-gray-600">
              <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </button>
            <span class="text-gray-700 dark:text-gray-300 mx-2">${product.cantidad}</span>
            <button onclick="decrementarCantidad(${product.id})" class="text-gray-500 dark:text-gray-200 focus:outline-none focus:text-gray-600">
              <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </button>
          </div>
        </div>
      </div>
      <span class="text-gray-600 dark:text-gray-200">${product.precio * product.cantidad}$</span>
    `;

                // Agregar el producto al contenedor del carrito
                cartContainer.appendChild(productElement);
            });
        }

        // Se debe ejecutar al cargar la página para que recupera todos los productos 
        // que estén en el carrito almacenados en el LocalStorage
        updateCartUI();
    </script>

    @section('js')

    @show


    <script>
        const formLoading = document.getElementById('formLoading');
        if (formLoading) {
            formLoading.classList.add('hidden'); // oculta el loading de carga
        }


        document.addEventListener('DOMContentLoaded', function() {
            const formulario = document.getElementById('ventaForm');
            const botonSubmit = document.getElementById('botonPagar');
            const formLoading = document.getElementById('formLoading');

            if (formulario) {
                formulario.addEventListener('submit', function() {
                    botonSubmit.disabled = true;

                    formLoading.classList.remove('hidden'); // muestra el loading de carga

                    localStorage.removeItem('cart'); // Eliminamos el carrito de compras

                    return true; // Continuar con el envío del formulario de la venta
                });
            }

        });

        const pagarForm = () => {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartForm = document.getElementById('cartForm');
            const totalForm = document.getElementById('totalForm');

            if (cartForm && totalForm) {
                // const subTotal = cart.reduce((total, product) => {
                //   return total + (product.precio * product.cantidad);
                // }, 0);

                const {
                    subTotal,
                    descuentoTotal
                } = cart.reduce((result, product) => {
                    result.subTotal += product.precio * product.cantidad;

                    result.descuentoTotal += (product.descuento / 100) * product.precio * product.cantidad;
                    return result;
                }, {
                    subTotal: 0,
                    descuentoTotal: 0
                });

                // CALCULAR EL DESCUENTO DE PROMOCION
                const total = subTotal - descuentoTotal;

                cartForm.value = JSON.stringify(cart);
                totalForm.value = total;
            }

        }

        const calcularTotal = () => {
            const subTotalElement = document.getElementById('subTotalValue');
            const descuentoElement = document.getElementById('descuentoValue');
            const totalElement = document.getElementById('totalValue');

            if (!subTotalElement) {
                return;
            }

            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            const {
                subTotal,
                descuentoTotal
            } = cart.reduce((result, product) => {
                result.subTotal += product.precio * product.cantidad;

                result.descuentoTotal += (product.descuento / 100) * product.precio * product.cantidad;
                return result;
            }, {
                subTotal: 0,
                descuentoTotal: 0
            });

            // const subTotal = cart.reduce((total, product) => {
            //   return total + (product.precio * product.cantidad);
            // }, 0);

            subTotalElement.textContent = subTotal + ' Bs';
            descuentoElement.textContent = descuentoTotal + ' Bs';
            totalElement.textContent = (subTotal - descuentoTotal) + ' Bs';
        }


        const actualizarListaDeCarrito = () => {
            const listaCarrito = document.getElementById('lista-carrito');

            if (!listaCarrito) {
                return;
            }


            listaCarrito.innerHTML = '';

            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            cart.forEach(product => {
                const listItem = document.createElement('li');
                const descuento = product.precio * (product.descuento / 100);
                const precioDescuento = product.precio - descuento;
                listItem.className = 'flex items-center gap-4';
                listItem.innerHTML = `
        <img src="${product.imagen}" alt="${product.nombre}" class="h-32 w-32 rounded object-cover">

        <div>
          <h3 class="text-gray-700 dark:text-gray-300">${product.nombre}</h3>

          <dl class="mt-0.5 space-y-px text-sm text-gray-500 dark:text-gray-200">
            <div>
              <dt class="inline">Nombre:</dt>
              <dd class="inline">${product.nombre}</dd>
            </div>
            <div>
              <dt class="inline">Precio:</dt>
              <dd class="inline">${product.precio} Bs</dd>
            </div>
            <div>
              <dt class="inline">Cantidad:</dt>
              <dd class="inline">${product.cantidad}</dd>
            </div>
            <div>
              <dt class="inline">Descuento:</dt>
              <dd class="inline">${product.descuento} %</dd>
            </div>
            <div>
              <dt class="inline">Total:</dt>
              <dd class="inline">${precioDescuento * product.cantidad} Bs</dd>
            </div>
          </dl>
        </div>

        <div class="flex flex-1 items-center justify-end gap-2">
          <button onclick="incrementarCantidad(${product.id})" class="text-gray-500 dark:text-gray-200 focus:outline-none focus:text-gray-600">
            <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 9v3m0 0v3m0-3h3m-3 0H9"></path></svg>
          </button>
          <span class="text-gray-700 dark:text-gray-300 mx-2">${product.cantidad}</span>
          <button onclick="decrementarCantidad(${product.id})" class="text-gray-500 dark:text-gray-200 focus:outline-none focus:text-gray-600">
            <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M15 12H9"></path></svg>
          </button>
          <br>

          <button onclick="eliminarProductoDelCarrito(${product.id})" class="text-gray-600 dark:text-gray-200 transition hover:text-red-600">
            <span class="sr-only">Remove item</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
            </svg>
          </button>
        </div>
      `;

                // Agregar el elemento a la lista
                listaCarrito.appendChild(listItem);
            });


        }

        pagarForm();
        actualizarListaDeCarrito();
        calcularTotal();
    </script>

    <script>
        const addToCart = (productoId, productoNombre, productoPrecio, productoImagen,
            productoDescuento) => {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Verificar si el producto ya está en el carrito
            const existingProduct = cart.find(item => item.id === productoId);

            if (existingProduct) {
                // Incrementar la cantidad si ya está en el carrito
                existingProduct.cantidad++;
            } else {
                cart.push({
                    id: productoId,
                    nombre: productoNombre,
                    precio: productoPrecio,
                    cantidad: 1,
                    imagen: productoImagen,
                    descuento: productoDescuento
                });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Producto agregado al carrito: ' + productoNombre);

            updateCartUI(); // Actualizar la interfaz de usuario del carrito (Ventana Emergente)
            actualizarListaDeCarrito(); // Actualizar la interfaz de la pagina del carrito de compras
            calcularTotal(); // Actualiza la interfaz de la pagina carrito de compras la seccion de total
            pagarForm(); // Actualiza los datos del formulario para pagar el carrito de compras


        }

        const incrementarCantidad = (productId) => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            const product = cart.find(item => item.id === productId);

            if (product) {
                product.cantidad++;

                localStorage.setItem('cart', JSON.stringify(cart));

                updateCartUI(); // Actualizar la interfaz de usuario del carrito (Ventana Emergente)
                actualizarListaDeCarrito(); // Actualizar la interfaz de la pagina del carrito de compras
                calcularTotal();
                pagarForm();
            }
        };

        const decrementarCantidad = (productId) => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            const product = cart.find(item => item.id === productId);

            if (product) {
                product.cantidad--;

                if (product.cantidad <= 0) {
                    const index = cart.indexOf(product);
                    if (index !== -1) {
                        cart.splice(index, 1);
                    }
                }

                localStorage.setItem('cart', JSON.stringify(cart));

                updateCartUI();
                actualizarListaDeCarrito();
                calcularTotal();
                pagarForm();
            }
        }

        const eliminarProductoDelCarrito = (productId) => {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            const product = cart.find(item => item.id === productId);

            if (product) {
                const index = cart.indexOf(product);
                cart.splice(index, 1);

                localStorage.setItem('cart', JSON.stringify(cart));

                // Actualizar la interfaz de usuario del carrito
                updateCartUI();
                actualizarListaDeCarrito();
                calcularTotal();
                pagarForm();
            }
        }
    </script>



</body>

</html>
