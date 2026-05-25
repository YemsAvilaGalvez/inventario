@php
    $links = [
        [
            'header' => 'Principal',
        ],
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'name' => 'inventario',
            'icon' => 'fa-solid fa-boxes-stacked',
            'active' => request()->routeIs([
                'admin.categories.*',
                'admin.products.*',
                'admin.warehouses.*',
            ]),
            'submenu' => [
                [
                    'name' => 'Categorías',
                    'href' => route('admin.categories.index'),
                    'active' => request()->routeIs('admin.categories.*'),
                ],
                [
                    'name' => 'Productos',
                    'href' => route('admin.products.index'),
                    'active' => request()->routeIs('admin.products.*'),
                ],
                [
                    'name' => 'Almacenes',
                    'href' => route('admin.warehouses.index'),
                    'active' => request()->routeIs('admin.warehouses.*'),
                ],
            ],
        ],
        [
            'name' => 'Compras',
            'icon' => 'fa-solid fa-cart-shopping',
            'active' => request()->routeIs([
                'admin.suppliers.*',
                'admin.purchase-orders.*',
                'admin.purchases.*',
            ]),
            'submenu' => [
                [
                    'name' => 'Proveedores',
                    'href' => route('admin.suppliers.index'),
                    'active' => request()->routeIs('admin.suppliers.*'),
                ],
                [
                    'name' => 'Ordenes de Compra',
                    'href' => route('admin.purchase-orders.index'),
                    'active' => request()->routeIs('admin.purchase-orders.*'),
                ],
                [
                    'name' => 'Compras',
                    'href' => route('admin.purchases.index'),
                    'active' => request()->routeIs('admin.purchases.*'),
                ],
                
            ],
        ],
        [
            'name' => 'Ventas',
            'icon' => 'fa-solid fa-cash-register',
            'active' => request()->routeIs([
                'admin.customers.*',
            ]),
            'submenu' => [
                [
                    'name' => 'Clientes',
                    'href' => route('admin.customers.index'),
                    'active' => request()->routeIs('admin.customers.*'),
                ],
                [
                    'name' => 'Cotizaciones',
                    'href' => '#',
                    'active' => false,
                ],
                [
                    'name' => 'Ventas',
                    'href' => '#',
                    'active' => false,
                ],
                
            ],
        ],
        [
            'name' => 'Movimientos',
            'icon' => 'fa-solid fa-arrows-rotate',
            'active' => request()->routeIs([
                
            ]),
            'submenu' => [
                [
                    'name' => 'Entradas y Salidas   ',
                    'href' => '#',
                    'active' => false,
                ],
                [
                    'name' => 'Transferencias',
                    'href' => '#',
                    'active' => false,
                ],
                
            ],
        ],
        [
            'name' => 'Reportes',
            'icon' => 'fa-solid fa-chart-line',
            'href' => '#',
            'active' => false,
        ],
        [
            'header' => 'Configuración',
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users',
            'href' => '#',
            'active' => false,
        ],
        [
            'name' => 'Roles',
            'icon' => 'fa-solid fa-user-shield',
            'href' => '#',
            'active' => false,
        ],
        [
            'name' => 'Permisos',
            'icon' => 'fa-solid fa-key',
            'href' => '#',
            'active' => false,
        ],
        [
            'name' => 'Configuración General',
            'icon' => 'fa-solid fa-cogs',
            'href' => '#',
            'active' => false,
        ]
    ];
@endphp

<aside id="top-bar-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-primary-soft border-e border-default">
        <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3" alt="Flowbite Logo" />
            <span class="self-center text-lg text-heading font-semibold whitespace-nowrap">Flowbite</span>
        </a>
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    @isset($link['header'])
                        <div class="px-2 py-2 text-xs font-semibold text-gray-500 uppercase">{{ $link['header'] }}</div>
                    @else
                        @isset($link['submenu'])
                            <div x-data="{
                                open:{{ $link['active'] ? 'true' : 'false' }}
                            }">
                                <button type="button"
                                    class="flex items-center w-full justify-between px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group" @click="open = !open">
                                    <span class="w-6 h-6 inline-flex justify-center items-center text-gray-500"><i
                                            class="{{ $link['icon'] }}"></i></span>
                                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $link['name'] }}</span>
                                    <i class="text-sm" :class="open ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'"></i>
                                </button>
                                <ul x-show="open" x-cloak class="py-2 space-y-2">
                                    @foreach ($link['submenu'] as $item)
                                        <li>
                                            <a href="{{ $item['href'] }}" class="pl-10 flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ $item['active'] ? 'bg-gray-100' : '' }}">{{ $item['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <a href="{{ $link['href'] }}"
                                class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group {{ $link['active'] ? 'bg-gray-100' : '' }}">
                                <span class="w-6 h-6 inline-flex justify-center items-center text-gray-500"><i
                                        class="{{ $link['icon'] }}"></i></span>
                                <span class="ms-3">{{ $link['name'] }}</span>
                            </a>
                        @endisset
                    @endisset
                </li>
            @endforeach


        </ul>
    </div>
</aside>
