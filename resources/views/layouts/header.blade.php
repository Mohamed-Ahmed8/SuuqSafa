<!-- Top Bar -->
<div class="bg-[#0b6e4f] text-white py-2 px-4 text-sm flex justify-between items-center">
    <div class="flex space-x-4 items-center pl-4 lg:pl-12">
        <!-- Social Icons placeholder -->
        <a href="#" class="hover:text-gray-200"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
        <a href="#" class="hover:text-gray-200"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg></a>
    </div>
    <div class="flex space-x-6 items-center pr-4 lg:pr-12 font-medium">
        <a href="{{ route('vendor.register') }}" class="hidden bg-yellow-400 text-gray-900 px-3 py-1 rounded hover:bg-yellow-500">Become a seller</a>
        <a href="{{ route('vendor.login') }}" class="hidden hover:text-gray-200">Seller login</a>
        <a href="#" class="hover:text-gray-200">FAQ</a>
        <a href="#" class="hover:text-gray-200">Contact</a>
        <a href="{{ route('shop.track-order') }}" class="hidden hover:text-gray-200">Tracking order</a>
    </div>
</div>

<!-- debug banners removed -->

<!-- Header / Branding & Search -->
<div class="container mx-auto px-4 lg:px-12 py-6 flex flex-nowrap justify-between items-center overflow-x-auto">
    <!-- Logo + mobile search button -->
    <div class="flex items-center space-x-2">
        <a href="/" class="flex items-center space-x-2">
            <svg class="w-10 h-10 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/></svg>
            <span class="text-3xl font-bold text-[#0b6e4f]">SuuqSafa</span>
        </a>

        <button id="mobile-search-btn" class="sm:hidden ml-2 p-2 rounded bg-gray-100 text-gray-700" aria-expanded="false" aria-controls="mobile-search-panel" aria-label="Open search">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </button>
    </div>

    <!-- Search Bar (desktop) -->
    <form action="/search" method="GET" class="hidden sm:flex flex-1 max-w-2xl mx-12 border-gray-200 shadow-sm border rounded items-center p-0 overflow-hidden">
        <input id="desktop-search-input" name="q" type="text" placeholder="Search For Products" class="w-full border-none px-4 py-2 focus:outline-none focus:ring-0" value="{{ request('q') }}">
        <button id="desktop-search-submit" type="submit" class="bg-[#0b6e4f] text-white px-6 py-3 hover:bg-[#09563e]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </button>
    </form>

    <!-- Order Tracking removed -->
</div>

<!-- Mobile Search Panel -->
<div id="mobile-search-panel" class="sm:hidden hidden w-full px-4 py-3 border-t bg-white">
    <form action="/search" method="GET" class="flex items-center space-x-2">
        <input id="mobile-search-input" name="q" type="text" placeholder="Search For Products" class="flex-1 px-3 py-2 border rounded-l focus:outline-none" value="{{ request('q') }}">
        <button id="mobile-search-submit" type="submit" class="bg-[#0b6e4f] text-white px-4 py-2 rounded-r">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </button>
    </form>
</div>

<!-- Navigation -->
<div class="border-y border-gray-200">
    <div class="container mx-auto px-4 lg:px-12 flex justify-between items-center py-4">
        <div class="flex flex-wrap items-center space-x-6 text-gray-700 font-medium">
            <a href="/" class="hover:text-[#0b6e4f]">Home Pages <span class="text-xs">&vee;</span></a>
            <a href="{{ route('about') }}" class="hover:text-[#0b6e4f]">About</a>
            <div class="relative">
                <button id="stores-toggle-btn" aria-expanded="false" aria-controls="stores-dropdown" class="flex items-center hover:text-[#0b6e4f] bg-transparent px-2 py-1 rounded">
                    Stores <span class="text-xs ml-1">&vee;</span>
                </button>
                @php
                    $headerStores = \App\Models\Store::where('status', 'active')->orderBy('name')->get();
                @endphp
                <div id="stores-dropdown" class="absolute left-0 mt-2 w-64 bg-white shadow-lg rounded hidden z-50">
                    <ul class="divide-y max-h-64 overflow-auto">
                        @forelse($headerStores as $hstore)
                            <li>
                                <a href="{{ route('stores.show', $hstore) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ $hstore->name }}</a>
                            </li>
                        @empty
                            <li class="px-4 py-2 text-gray-500">No stores available</li>
                        @endforelse
                        <li>
                            <a href="{{ route('stores.index') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">View all stores</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Pages and Blog links removed -->
            <a href="#" class="hover:text-[#0b6e4f]">Contact</a>
        </div>

        <div class="flex flex-wrap items-center space-x-6 text-gray-600">
                <div class="relative cursor-pointer hover:text-[#0b6e4f]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <span class="absolute -top-2 -right-2 bg-[#0b6e4f] text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center pointer-events-none header-cart-count">{{ count(session('cart', [])) }}</span>
            </div>
                
                <!-- Combined cart anchor: icon + label (larger clickable area) with dropdown -->
                @php $headerCart = session('cart', []); @endphp
                        <div class="relative">
                    <button id="cart-toggle" type="button" class="relative z-50 inline-flex items-center space-x-2 text-[#0b6e4f] hover:text-[#09563e] p-2" aria-haspopup="true" aria-expanded="false" aria-label="Toggle cart">
                        <div class="relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <span class="absolute -top-2 -right-2 bg-[#0b6e4f] text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center pointer-events-none header-cart-count">{{ count($headerCart) }}</span>
                        </div>
                        <span class="text-sm font-medium">Cart</span>
                    </button>

                    <!-- Dropdown (toggle with JS) -->
                    <div id="cart-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white shadow-lg rounded z-50" role="menu" aria-hidden="true">
                        <div class="p-4">
                            @if(empty($headerCart))
                                <div class="text-sm text-gray-500">Your cart is empty</div>
                                <a href="{{ route('stores.index') }}" class="mt-3 inline-block text-sm text-blue-600 hover:underline">Continue shopping</a>
                            @else
                                <div class="max-h-60 overflow-auto divide-y">
                                    @php $subTotal = 0; @endphp
                                    @foreach($headerCart as $id => $item)
                                        @php $line = $item['price'] * $item['quantity']; $subTotal += $line; @endphp
                                        <div class="py-2 flex items-center justify-between">
                                            <div class="text-sm">
                                                <div class="font-medium">{{ $item['name'] }}</div>
                                                <div class="text-xs text-gray-500">{{ $item['quantity'] }} × ${{ number_format($item['price'], 2) }}</div>
                                            </div>
                                            <div class="text-sm font-semibold">${{ number_format($line, 2) }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-3 border-t pt-3 flex items-center justify-between">
                                    <div id="header-cart-subtotal" class="text-sm font-bold">Total: ${{ number_format($subTotal, 2) }}</div>
                                    @php
                                        $headerStoreIds = collect($headerCart)->pluck('store_id')->unique()->filter()->values();
                                        $headerStores = $headerStoreIds->isNotEmpty() ? \App\Models\Store::whereIn('id', $headerStoreIds)->get()->keyBy('id') : collect();
                                    @endphp
                                    <div class="flex space-x-2">
                                        <a href="{{ route('cart.index') }}" class="px-3 py-2 bg-gray-200 text-gray-800 rounded text-sm">View Cart</a>
                                        @if($headerStoreIds->isNotEmpty())
                                            @foreach($headerStoreIds as $sid)
                                                @php $hs = $headerStores->get($sid); @endphp
                                                <a href="{{ route('checkout.whatsapp') }}?store={{ $sid }}" class="px-3 py-2 bg-[#25D366] text-white rounded text-sm">Checkout via WhatsApp — {{ $hs ? $hs->name : 'Store '.$sid }}</a>
                                            @endforeach
                                        @else
                                            <a href="{{ route('checkout.whatsapp') }}" class="px-3 py-2 bg-[#25D366] text-white rounded text-sm">Checkout via WhatsApp</a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <script>
                    (function(){
                        var toggle = document.getElementById('cart-toggle');
                        var dropdown = document.getElementById('cart-dropdown');

                        if (!toggle || !dropdown) return;

                        function openDropdown(){
                            dropdown.classList.remove('hidden');
                            dropdown.setAttribute('aria-hidden','false');
                            toggle.setAttribute('aria-expanded','true');
                        }
                        function closeDropdown(){
                            dropdown.classList.add('hidden');
                            dropdown.setAttribute('aria-hidden','true');
                            toggle.setAttribute('aria-expanded','false');
                        }

                        toggle.addEventListener('click', function(e){
                            e.stopPropagation();
                            if (dropdown.classList.contains('hidden')){
                                openDropdown();
                            } else {
                                closeDropdown();
                            }
                        });

                        // close when clicking outside
                        document.addEventListener('click', function(e){
                            if (!dropdown.contains(e.target) && !toggle.contains(e.target)){
                                closeDropdown();
                            }
                        });

                        // close on escape
                        document.addEventListener('keydown', function(e){
                            if (e.key === 'Escape') closeDropdown();
                        });
                    })();
                </script>
                    {{-- per-store header WhatsApp links removed (cart dropdown retains per-store buttons) --}}
            <div class="cursor-pointer hover:text-[#0b6e4f]" id="header-refresh-btn" title="Refresh">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </div>
            <!-- Login / Register -->
            @auth
                <div class="flex items-center space-x-4">
                    @php $user = auth()->user(); @endphp
                    @if($user && ($user->role ?? '') === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 hover:text-[#0b6e4f] font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            <span>Dashboard</span>
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-[#0b6e4f]">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="flex items-center space-x-2 hover:text-[#0b6e4f] font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Login</span>
                </a>
            @endauth
        </div>
    </div>
</div>
