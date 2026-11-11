@extends('layouts.app')

@section('content')
    <!-- Page Title / Breadcrumb -->
    <div class="bg-gray-100 py-6">
        <div class="container mx-auto px-4 lg:px-12 text-center">
            <h1 class="text-lg font-semibold">Vendor Registration</h1>
            <div class="text-xs text-gray-500 mt-1">Home &nbsp;/&nbsp; Registration</div>
        </div>
    </div>

    <div class="py-12">
        <div class="container mx-auto px-4 lg:px-12">
            <div class="flex justify-center">
                <div class="w-full max-w-xs">
                    <form action="{{ route('vendor.register.store') }}" method="POST" class="bg-white border border-gray-200 rounded p-4 shadow-sm">
                        @csrf
                        <div class="text-sm font-semibold mb-3">Basic Info*</div>

                        <div class="space-y-2">
                            <div>
                                <input name="owner_name" value="{{ old('owner_name') }}" placeholder="Owner Name" class="w-full text-sm px-2 py-2 border border-gray-200 rounded focus:outline-none" />
                            </div>
                            <div>
                                <input name="business_name" value="{{ old('business_name') }}" placeholder="Business Name" class="w-full text-sm px-2 py-2 border border-gray-200 rounded focus:outline-none" />
                            </div>
                            <div>
                                <input name="email" type="email" value="{{ old('email') }}" placeholder="Email" class="w-full text-sm px-2 py-2 border border-gray-200 rounded focus:outline-none" />
                            </div>
                            <div>
                                <input name="username" value="{{ old('username') }}" placeholder="Username" class="w-full text-sm px-2 py-2 border border-gray-200 rounded focus:outline-none" />
                            </div>
                            <div>
                                <input name="password" type="password" placeholder="Password" class="w-full text-sm px-2 py-2 border border-gray-200 rounded focus:outline-none" />
                            </div>
                            <div>
                                <input name="password_confirmation" type="password" placeholder="Confirm Password" class="w-full text-sm px-2 py-2 border border-gray-200 rounded focus:outline-none" />
                            </div>
                            <div>
                                <input name="category" value="{{ old('category') }}" placeholder="Business Category" class="w-full text-sm px-2 py-2 border border-gray-200 rounded focus:outline-none" />
                            </div>
                            <div>
                                <textarea name="description" rows="3" placeholder="Description" class="w-full text-sm px-2 py-2 border border-gray-200 rounded focus:outline-none">{{ old('description') }}</textarea>
                            </div>

                            <div class="flex items-center">
                                <input id="accept" name="accept" type="checkbox" class="mr-2" />
                                <label for="accept" class="text-xs">Accept all Terms and Conditions &amp; Privacy Policy</label>
                            </div>

                            <div>
                                <button type="submit" class="w-full text-sm bg-[#0b6e4f] text-white px-3 py-2 rounded">Submit For Registration</button>
                            </div>
                            <div class="text-center text-xs text-gray-500">Already have account? <a href="{{ route('login') }}" class="text-[#0b6e4f]">Login</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
