<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Order Summary</h3>
                <div class="mb-6 border-b pb-6">
                    <p class="text-lg">Total Amount to Pay: <span class="font-bold text-gray-900">${{ number_format($total, 2) }}</span></p>
                </div>
                
                <div class="mb-4">
                    <label class="block font-medium text-sm text-gray-700">Payment Information</label>
                    <div class="p-4 border rounded bg-gray-50 text-gray-500 italic mt-1">
                        Payment is handled via WhatsApp for each store. Use the "Place Order on WhatsApp" button below to send your order to the store.
                    </div>
                </div>

                @php
                    $hasMultipleStores = isset($storeGroups) && count($storeGroups) > 1;
                @endphp

                @if($hasMultipleStores)
                    <div class="space-y-4">
                        @foreach($storeGroups as $group)
                            @php
                                $sid = $group['store_id'];
                                $store = $storeModels[$sid] ?? null;
                                $label = $store?->name ?? 'Store';
                                $phone = $store?->whatsapp_number ?? env('WHATSAPP_NUMBER', '');
                            @endphp
                            <div class="p-4 border rounded">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="font-semibold">{{ $label }}</div>
                                        <div class="text-sm text-gray-600">Subtotal: ${{ number_format($group['subtotal'], 2) }}</div>
                                        @if(!empty($phone))
                                            <div class="text-sm text-gray-600">WhatsApp: +{{ preg_replace('/\D+/', '', $phone) }}</div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <a href="{{ route('checkout.whatsapp') }}?store={{ $sid }}" target="_blank" class="inline-block px-4 py-2 bg-[#25D366] text-white rounded-md hover:opacity-90 font-bold">Place Order on WhatsApp</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    @if(!empty($singleStoreId))
                        @php $store = $storeModels[$singleStoreId] ?? null; $phone = $store?->whatsapp_number ?? env('WHATSAPP_NUMBER', ''); @endphp
                        <a href="{{ route('checkout.whatsapp') }}?store={{ $singleStoreId }}" target="_blank" class="mt-4 block px-6 py-3 bg-[#25D366] text-white rounded-md hover:opacity-90 font-bold text-center">Place Order on WhatsApp ({{ $store?->name ?? 'Store' }})</a>
                        @if(!empty($phone))
                            <div class="mt-2 text-sm text-gray-600">Store WhatsApp: +{{ preg_replace('/\D+/', '', $phone) }}</div>
                        @endif
                    @else
                        <a href="{{ route('checkout.whatsapp') }}" target="_blank" class="mt-4 block px-6 py-3 bg-[#25D366] text-white rounded-md hover:opacity-90 font-bold text-center">Place Order on WhatsApp</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
