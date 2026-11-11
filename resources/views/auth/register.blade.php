@extends('layouts.app')

@section('content')
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center py-6 bg-white/50 mb-8">
                <h1 class="text-3xl font-bold">Register</h1>
            </div>

            <div class="flex justify-center">
                <div class="w-full max-w-2xl">
                    <div class="bg-white rounded-xl shadow-md border border-gray-100 p-8">
                        <h2 class="text-2xl font-semibold mb-6">Create Account</h2>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <input id="name" name="name" type="text" placeholder="Name" value="{{ old('name') }}" required class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 focus:outline-none" />
                                    @error('name') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div>
                                    <input id="username" name="username" type="text" placeholder="Username" value="{{ old('username') }}" required class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 focus:outline-none" />
                                    @error('username') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div>
                                    <input id="email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 focus:outline-none" />
                                    @error('email') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div>
                                    <select name="country" class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 focus:outline-none">
                                        <option value="Bangladesh" selected>Bangladesh</option>
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                    </select>
                                </div>

                                <div>
                                    <input id="password" name="password" type="password" placeholder="Password" required class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 focus:outline-none" />
                                    @error('password') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div>
                                    <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" required class="w-full bg-gray-50 border border-gray-200 rounded px-4 py-3 focus:outline-none" />
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="w-full bg-[#0b6e4f] text-white px-4 py-3 rounded-lg">Create Account</button>
                            </div>
                        </form>

                        <div class="text-center text-sm text-gray-500 mt-6">Already have an account? <a href="{{ route('login') }}" class="text-[#0b6e4f]">Login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
