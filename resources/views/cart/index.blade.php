<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Cart view (styled) --}}
            @php
                // Ensure view always reads the cart directly from session (avoids any controller/view mismatch)
                $cart = session('cart', []);
                $total = collect($cart)->reduce(function($carry, $item){ return $carry + ($item['price'] * $item['quantity']); }, 0);
            @endphp
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(empty($cart))
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-semibold">Your Shopping Cart</h2>
                            @if(!empty($cart) && count($cart) > 0)
                                <a href="{{ route('checkout.start') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">
                                    Proceed to Checkout
                                </a>
                            @endif
                        </div>
                    <a href="{{ route('stores.index') }}" class="mt-4 inline-block text-blue-600 hover:underline">&larr; Continue Shopping</a>
                @else
                    <form action="{{ route('cart.update') }}" method="POST" id="cart-update-form">
                        @csrf
                        <div class="overflow-x-auto -mx-4 px-4 sm:mx-0 sm:px-0 mb-6">
                            <table class="min-w-[720px] w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium text-gray-500 tracking-wider">Product Name</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-500 tracking-wider">Unite Price</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-500 tracking-wider">Quantity</th>
                                    <th class="px-6 py-3 text-left font-medium text-gray-500 tracking-wider">Total Price</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($cart as $id => $item)
                                    @php $product = \App\Models\Product::find($item['id']); @endphp
                                    <tr data-id="{{ $id }}" data-price="{{ $item['price'] }}">
                                        <td class="px-6 py-4 flex items-center space-x-4">
                                            @if($product && $product->image)
                                                <img src="{{ route('storage.file', ['type' => 'products', 'filename' => basename($product->image)]) }}" alt="" class="w-16 h-16 object-contain">
                                            @else
                                                <div class="w-16 h-16 bg-gray-100 flex items-center justify-center text-xs">No Image</div>
                                            @endif
                                            <div>
                                                <div class="font-medium">{{ $item['name'] }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">${{ number_format($item['price'], 2) }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <button type="button" class="px-2 py-1 bg-gray-200" onclick="(function(){var q=this.nextElementSibling; q.stepDown(); q.dispatchEvent(new Event('input',{bubbles:true})); q.dispatchEvent(new Event('change',{bubbles:true}));}).call(this)">−</button>
                                                <input type="number" name="quantities[{{ $id }}]" value="{{ $item['quantity'] }}" min="0" class="w-16 text-center border mx-2" />
                                                <button type="button" class="px-2 py-1 bg-gray-200" onclick="(function(){var q=this.previousElementSibling; q.stepUp(); q.dispatchEvent(new Event('input',{bubbles:true})); q.dispatchEvent(new Event('change',{bubbles:true}));}).call(this)">+</button>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-bold row-total">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                        <td class="px-6 py-4">
                                            <button type="button" data-remove-url="{{ route('cart.remove', $id) }}" class="inline-block bg-red-500 text-white px-3 py-1 rounded delete-cart-item">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-right font-bold">Grand Total: <span id="cart-grand-total">${{ number_format($total,2) }}</span></div>

                        <div class="flex items-center justify-start space-x-4">
                            <button type="submit" class="bg-cyan-500 text-white px-5 py-2 rounded">Update Cart</button>
                            <a href="{{ route('checkout.start') }}" class="bg-green-700 text-white px-5 py-2 rounded">Checkout</a>
                        </div>
                    </form>

                    <script>
                        (function(){
                            function formatMoney(n){ return '$' + n.toFixed(2); }

                            var updateTimer = null;
                            var token = '{{ csrf_token() }}';
                            var updateUrl = '{{ route('cart.update') }}';

                            function recalcAll(){
                                var grand = 0;
                                document.querySelectorAll('tr[data-price]').forEach(function(tr){
                                    var price = parseFloat(tr.dataset.price) || 0;
                                    var input = tr.querySelector('input[name^="quantities"]');
                                    var qty = parseInt(input.value) || 0;
                                    var rowTotal = price * qty;
                                    var rowEl = tr.querySelector('.row-total');
                                    if (rowEl) rowEl.textContent = formatMoney(rowTotal);
                                    grand += rowTotal;
                                });
                                var gEl = document.getElementById('cart-grand-total');
                                if (gEl) gEl.textContent = formatMoney(grand);
                            }

                            function doAutoUpdate(){
                                var qs = {};
                                document.querySelectorAll('input[name^="quantities"]').forEach(function(inp){
                                    var m = inp.name.match(/^quantities\[(.*)\]$/);
                                    if (m) qs[m[1]] = parseInt(inp.value) || 0;
                                });

                                fetch(updateUrl, {
                                    method: 'POST',
                                    credentials: 'same-origin',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': token,
                                        'X-Requested-With': 'XMLHttpRequest'
                                    },
                                    body: JSON.stringify({ quantities: qs })
                                }).then(function(res){
                                    if (!res.ok) throw res;
                                    return res.json();
                                }).then(function(json){
                                    if (json) {
                                        if (json.total !== undefined){
                                            var g = document.getElementById('cart-grand-total');
                                            if (g) g.textContent = formatMoney(json.total);
                                        }
                                        // update header counts and subtotal
                                        try {
                                            var totalCount = 0;
                                            if (json.cart) {
                                                Object.keys(json.cart).forEach(function(k){ totalCount += (json.cart[k].quantity||0); });
                                            }
                                            document.querySelectorAll('.header-cart-count').forEach(function(el){ el.textContent = totalCount; });
                                            var hs = document.getElementById('header-cart-subtotal');
                                            if (hs && json.total !== undefined) hs.textContent = 'Total: ' + formatMoney(json.total);
                                        } catch(e){ console.error(e); }
                                    }
                                }).catch(function(err){
                                    console.error('Auto-update failed', err);
                                });
                            }

                            // wire quantity inputs with debounce
                            document.querySelectorAll('input[name^="quantities"]').forEach(function(inp){
                                inp.addEventListener('input', function(){
                                    recalcAll();
                                    if (updateTimer) clearTimeout(updateTimer);
                                    updateTimer = setTimeout(function(){ doAutoUpdate(); }, 700);
                                });
                                inp.addEventListener('change', function(){
                                    recalcAll();
                                });
                            });

                            // delete buttons: build and submit a small form to avoid nested forms
                            document.querySelectorAll('.delete-cart-item').forEach(function(btn){
                                btn.addEventListener('click', function(){
                                    if (!confirm('Remove this item from cart?')) return;
                                    var url = this.dataset.removeUrl;
                                    var f = document.createElement('form');
                                    f.method = 'POST';
                                    f.action = url;
                                    var i1 = document.createElement('input'); i1.type='hidden'; i1.name='_token'; i1.value=token; f.appendChild(i1);
                                    var i2 = document.createElement('input'); i2.type='hidden'; i2.name='_method'; i2.value='DELETE'; f.appendChild(i2);
                                    document.body.appendChild(f);
                                    f.submit();
                                });
                            });

                            // initial calc
                            recalcAll();
                        })();
                    </script>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
