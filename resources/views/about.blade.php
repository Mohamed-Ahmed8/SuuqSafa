@extends('layouts.app')

@section('content')
    <div class="bg-white py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-2xl font-bold">About</h1>
            <p class="text-sm text-gray-500 mt-2">About</p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Section 1: text left, image right -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center mb-16">
            <div class="md:col-span-2">
                <h2 class="text-lg font-semibold mb-3">This is how we do. Learn something about us and our services</h2>
                <p class="text-sm text-gray-600 mb-4">There’s a whole lot of learning and discovery. Our team builds faster, better and more trusted solutions for marketplaces. We focus on speed, trust and delightful customer experience. Our delivery network and seller onboarding ensures smooth shopping for buyers and easy sell flow for partners.</p>
                <p class="text-sm text-gray-600">We believe in transparency, fast delivery and excellent customer support. Our team continuously improves platform features and seller tools so your store grows faster.</p>
            </div>

            <div class="md:col-span-1">
                <img src="/images/about-1.jpg" alt="about" class="w-full rounded shadow" onerror="this.src='/images/placeholder.png'">
            </div>
        </div>

        <!-- Section 2: image left, text right -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center mb-16">
            <div class="md:col-span-1">
                <img src="/images/about-2.jpg" alt="delivery" class="w-full rounded shadow" onerror="this.src='/images/placeholder.png'">
            </div>
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold mb-3">We Provide Express & secure home delivery</h3>
                <p class="text-sm text-gray-600">Fast delivery and secure checkout make shopping with us reliable. From packaging to doorstep delivery, our logistics partners follow strict quality processes to ensure items arrive on time.</p>
            </div>
        </div>

        <!-- Advantages -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start mb-16">
            <div class="md:col-span-2">
                <h4 class="text-base font-semibold mb-4">Our Advantages</h4>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded flex items-center justify-center">🚚</div>
                        <div>
                            <div class="font-medium">Free Shipping</div>
                            <div class="text-xs text-gray-500">On selected orders</div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded flex items-center justify-center">🔒</div>
                        <div>
                            <div class="font-medium">100% Secure Payment</div>
                            <div class="text-xs text-gray-500">Encrypted checkout</div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded flex items-center justify-center">🛍️</div>
                        <div>
                            <div class="font-medium">Fresh Product</div>
                            <div class="text-xs text-gray-500">Quality guaranteed</div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded flex items-center justify-center">📞</div>
                        <div>
                            <div class="font-medium">24/7 Support Center</div>
                            <div class="text-xs text-gray-500">We are here to help</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-1">
                <img src="/images/about-3.jpg" alt="advantages" class="w-full rounded shadow" onerror="this.src='/images/placeholder.png'">
            </div>
        </div>

        <!-- Testimonials -->
        <div class="mb-8">
            <h4 class="text-base font-semibold mb-6">Client Says</h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white border rounded p-6 shadow-sm text-sm">
                    <p class="text-gray-600 mb-4">Great service and fast delivery. The product quality was excellent and customer support was responsive.</p>
                    <div class="font-medium">Jenny R. Kulen</div>
                    <div class="text-xs text-gray-400">Buyer, California</div>
                </div>

                <div class="bg-green-600 text-white rounded p-6 shadow-sm text-sm">
                    <p class="mb-4">Amazing experience — secure checkout and fast shipping. I will order again.</p>
                    <div class="font-medium">Melinda Watson</div>
                    <div class="text-xs text-green-100">Buyer, United Kingdom</div>
                </div>

                <div class="bg-white border rounded p-6 shadow-sm text-sm">
                    <p class="text-gray-600 mb-4">Good packaging and timely delivery. Highly recommended.</p>
                    <div class="font-medium">Graham Ortega</div>
                    <div class="text-xs text-gray-400">Buyer, Germany</div>
                </div>
            </div>
        </div>
    </div>

@endsection
