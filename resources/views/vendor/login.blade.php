@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="container mx-auto px-4 lg:px-12">
            <div class="flex justify-center">
                <div class="w-full max-w-md">
                    <div class="bg-white rounded shadow p-6">
                        <h2 class="text-2xl font-bold text-center mb-4">Sign In</h2>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Username or Email</label>
                                <input name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" autofocus />
                            </div>

                            <div class="mb-3">
                                <label class="block text-sm font-medium text-gray-700">Password</label>
                                <input name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                            </div>

                            <div class="flex items-center justify-between mb-4">
                                <label class="inline-flex items-center text-sm"><input type="checkbox" name="remember" class="mr-2">Remember</label>
                                <a href="{{ route('password.request') }}" class="text-sm text-[#0b6e4f]">Forgot Password?</a>
                            </div>

                            <button type="submit" class="w-full bg-[#0b6e4f] text-white px-4 py-2 rounded">Log In</button>

                            <div class="text-center text-sm text-gray-500 mt-3">Don't have account? <a href="{{ route('vendor.register') }}" class="text-[#0b6e4f]">Signup Now</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
