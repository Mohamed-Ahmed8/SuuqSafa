@extends('layouts.app')

@section('content')
<section class="bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero -->
        <div class="py-12 text-center bg-white/0">
            <h1 class="text-3xl font-extrabold text-gray-900">Track Order</h1>
        </div>

        <!-- Content -->
        <div class="py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Card -->
                <div class="flex justify-center lg:justify-start">
                    <div class="w-full max-w-sm bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-semibold mb-4">Order Tracking</h3>

                        <form action="#" method="GET">
                            <div class="mb-4">
                                <label class="block text-sm text-gray-600 mb-1">Order ID</label>
                                <input name="order_id" type="text" placeholder="Order Id" class="w-full border border-gray-200 rounded px-3 py-2 focus:outline-none" />
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm text-gray-600 mb-1">Email</label>
                                <input name="email" type="email" placeholder="Billing Email" class="w-full border border-gray-200 rounded px-3 py-2 focus:outline-none" />
                            </div>

                            <div>
                                <button type="submit" class="bg-[#0b6e4f] text-white px-4 py-2 rounded">Track your order</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right: Illustration -->
                <div class="flex justify-center lg:justify-end">
                    @if (file_exists(public_path('images/tracking-image.webp')))
                        <img src="{{ asset('images/tracking-image.webp') }}" alt="Tracking illustration" class="max-w-full h-auto block" />
                    @else
                        <svg width="1000" height="480" viewBox="0 0 1000 480" preserveAspectRatio="xMidYMid meet" fill="none" xmlns="http://www.w3.org/2000/svg" class="max-w-full h-auto block">
                            <rect width="1000" height="480" fill="none"/>

                            <!-- subtle ground line -->
                            <line x1="40" y1="420" x2="960" y2="420" stroke="#e6e8eb" stroke-width="2"/>

                            <!-- phone (left) -->
                            <g transform="translate(60,40) scale(1.25)">
                                <rect x="0" y="0" width="220" height="320" rx="28" fill="#ffffff" stroke="#eef2f7" stroke-width="2"/>
                                <!-- top notch -->
                                <rect x="86" y="6" width="48" height="12" rx="6" fill="#154c3f"/>

                                <!-- screen background (map) -->
                                <rect x="18" y="28" width="184" height="264" rx="10" fill="#f8fafb"/>

                                <!-- map tiles / streets -->
                                <g fill="#eef2f6">
                                    <rect x="28" y="40" width="56" height="40" rx="4"/>
                                    <rect x="92" y="40" width="56" height="28" rx="4"/>
                                    <rect x="28" y="92" width="120" height="40" rx="4"/>
                                    <rect x="152" y="92" width="36" height="64" rx="4"/>
                                    <rect x="28" y="148" width="64" height="40" rx="4"/>
                                    <rect x="100" y="156" width="80" height="44" rx="4"/>
                                </g>

                                <!-- subtle street lines -->
                                <path d="M38 80 H190" stroke="#e6e8eb" stroke-width="2" stroke-linecap="round"/>
                                <path d="M38 132 H190" stroke="#e6e8eb" stroke-width="2" stroke-linecap="round"/>

                                <!-- map route -->
                                <path d="M72 120 C86 104, 120 100, 140 118 C160 136, 200 136, 216 118" stroke="#ef4444" stroke-width="6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>

                                <!-- route endpoints / pin -->
                                <circle cx="72" cy="120" r="7" fill="#ef4444"/>
                                <g transform="translate(216,118)">
                                    <path d="M0-12 C6-12, 12-6, 12 0 C12 8, 6 20, 0 28 C-6 20, -12 8, -12 0 C-12 -6, -6 -12, 0 -12 Z" fill="#ef4444"/>
                                    <circle cx="0" cy="4" r="4" fill="#fff"/>
                                </g>

                                <!-- small distance badge -->
                                <rect x="28" y="260" width="120" height="28" rx="8" fill="#fff" stroke="#e6e8eb"/>
                                <text x="40" y="278" fill="#6b7280" font-size="12">1,100 m</text>
                            </g>

                            <!-- scooter + rider (right, larger) -->
                            <g transform="translate(500,120) scale(2.6)">
                                <!-- shadow under wheels -->
                                <ellipse cx="60" cy="78" rx="68" ry="8" fill="#f3f4f6" opacity="0.6"/>

                                <!-- rear wheel -->
                                <circle cx="24" cy="64" r="24" fill="#cbd5e1"/>
                                <!-- front wheel -->
                                <circle cx="112" cy="64" r="24" fill="#cbd5e1"/>

                                <!-- scooter body -->
                                <path d="M0 60 L32 28 L96 20 L132 36 L104 40 L80 60 Z" fill="#ef4444"/>

                                <!-- delivery box -->
                                <rect x="54" y="6" width="46" height="46" rx="4" fill="#0b6e4f"/>

                                <!-- rider: legs/torso -->
                                <path d="M74 8 L78 20 L90 34 L96 34 L86 10 Z" fill="#ef4444"/>
                                <rect x="86" y="-8" width="18" height="26" rx="6" fill="#ef4444"/>

                                <!-- rider head -->
                                <circle cx="92" cy="-14" r="8" fill="#f6c7b3"/>
                                <!-- cap -->
                                <path d="M86 -18 L104 -18 L100 -12 L88 -12 Z" fill="#ef4444"/>

                                <!-- handle / detail dot -->
                                <circle cx="6" cy="36" r="4" fill="#111827"/>
                            </g>
                        </svg>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
