@extends('layouts.app')

@section('content')
    <section class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-8 text-center bg-white/50">
                <h1 class="text-3xl font-bold">Sign In</h1>
            </div>

            <div class="py-12">
                <div class="flex justify-center">
                    <div class="w-full max-w-md">
                            <div class="bg-white rounded-lg shadow-md border border-gray-100 p-6">
                                <h2 class="text-2xl font-semibold mb-4">Sign In</h2>

                                @if (session('status'))
                                    <div class="text-sm text-green-600 mb-4">{{ session('status') }}</div>
                                @endif

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-4">
                                        <label class="block text-sm text-gray-600 mb-1">Email Or User Name</label>
                                        <input id="email" name="email" type="text" value="{{ old('email') }}" required autofocus class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 focus:outline-none" />
                                        @error('email') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm text-gray-600 mb-1">Password</label>
                                        <input id="password" name="password" type="password" required class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 focus:outline-none" />
                                        @error('password') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <button type="submit" class="w-full bg-[#0b6e4f] text-white px-4 py-3 rounded">Sign In</button>
                                    </div>

                                    <div class="flex items-center justify-between text-sm">
                                        <label class="inline-flex items-center text-sm text-gray-600">
                                            <input type="checkbox" name="remember" class="mr-2" /> Remember Me
                                        </label>
                                        <a href="{{ route('password.request') }}" class="text-[#0b6e4f]">Forgot Password</a>
                                    </div>

                                    <div class="my-4 border-t pt-4 text-center">
                                        <span class="inline-block bg-white px-3 text-sm text-gray-400">Or</span>
                                    </div>
                                </form>

                                @if(app()->environment('local'))
                                    <div class="text-center text-sm text-gray-500">Don't have an account? <a href="{{ route('register') }}" class="text-[#0b6e4f]">Create one</a></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
