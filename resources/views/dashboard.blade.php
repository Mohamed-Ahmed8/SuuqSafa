@extends('layouts.app')

@section('content')
    <div class="bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-xl font-semibold">User Dashboard</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Sidebar -->
            <aside class="lg:col-span-1 lg:sticky lg:top-24 lg:self-start lg:max-h-[calc(100vh-6rem)] lg:overflow-auto">
                <div class="rounded overflow-hidden shadow-sm">
                    <div class="flex items-center bg-[#0b76ef] text-white px-3 py-3">
                        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center mr-2 text-xs">◎</div>
                        <div class="font-medium text-sm">{{ auth()->user()->name ?? 'Full Name' }}</div>
                    </div>

                    <div class="bg-white border border-gray-100">
                        <ul class="text-sm">
                            <li class="border-b">
                                <a href="#" class="block px-2 py-2 pl-3 border-l-4 border-[#0b76ef] bg-gray-50 text-sm">Dashboard</a>
                            </li>
                            <li class="border-b"><a href="#" class="block px-2 py-2 pl-3 hover:bg-gray-50 text-sm">Edit Profile</a></li>
                            <li class="border-b"><a href="#" class="block px-2 py-2 pl-3 hover:bg-gray-50 text-sm">Change Password</a></li>
                            <li class="border-b"><a href="#" class="block px-2 py-2 pl-3 hover:bg-gray-50 text-sm">My Orders</a></li>
                            <li class="border-b"><a href="#" class="block px-2 py-2 pl-3 hover:bg-gray-50 text-sm">Chat List</a></li>
                            <li class="border-b"><a href="#" class="block px-2 py-2 pl-3 hover:bg-gray-50 text-sm">Refund Request</a></li>
                            <li class="border-b"><a href="#" class="block px-2 py-2 pl-3 hover:bg-gray-50 text-sm">Wallet history</a></li>
                            <li class="border-b"><a href="#" class="block px-2 py-2 pl-3 hover:bg-gray-50 text-sm">Shipping Address</a></li>
                            <li class="border-b"><a href="#" class="block px-2 py-2 pl-3 hover:bg-gray-50 text-sm">Support Ticket</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-2 py-2 pl-3 hover:bg-gray-50 text-sm">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>

            <!-- Main content -->
            <main class="lg:col-span-11 lg:pl-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="relative bg-[#15171b] text-white rounded-lg p-6 shadow min-h-[120px] overflow-hidden">
                        <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full bg-gray-800/30"></div>
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="w-20 h-20 rounded-full bg-[#111214] flex items-center justify-center ring-4 ring-[#2b2d31]">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h8v6H8z"/></svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <div class="text-sm opacity-80">Total Orders</div>
                                <div class="text-4xl font-bold">0</div>
                            </div>
                        </div>
                    </div>

                    <div class="relative bg-[#15171b] text-white rounded-lg p-6 shadow min-h-[120px] overflow-hidden">
                        <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full bg-gray-800/30"></div>
                        <div class="flex items-center">
                            <div class="relative">
                                <div class="w-20 h-20 rounded-full bg-[#111214] flex items-center justify-center ring-4 ring-[#2b2d31]">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h8v6H8z"/></svg>
                                </div>
                            </div>
                            <div class="ml-6">
                                <div class="text-sm opacity-80">Support Tickets</div>
                                <div class="text-4xl font-bold">2</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders table -->
                <div class="bg-white border border-gray-100 rounded shadow">
                    <div class="p-4">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-gray-600">
                                    <th class="py-3">Order</th>
                                    <th class="py-3">Date</th>
                                    <th class="py-3">Status</th>
                                    <th class="py-3">Amount</th>
                                    <th class="py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="py-4">#379</td>
                                    <td class="py-4">February 20, 2026</td>
                                    <td class="py-4"><span class="text-xs bg-yellow-400 text-yellow-900 px-2 py-1 rounded">Pending</span></td>
                                    <td class="py-4">$444.00</td>
                                    <td class="py-4"><a href="#" class="inline-block bg-gray-800 text-white px-3 py-1 rounded shadow">view details</a></td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-4">#378</td>
                                    <td class="py-4">January 18, 2026</td>
                                    <td class="py-4"><span class="text-xs bg-yellow-400 text-yellow-900 px-2 py-1 rounded">Pending</span></td>
                                    <td class="py-4">$444.00</td>
                                    <td class="py-4"><a href="#" class="inline-block bg-gray-800 text-white px-3 py-1 rounded shadow">view details</a></td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-4">#376</td>
                                    <td class="py-4">January 04, 2026</td>
                                    <td class="py-4"><span class="text-xs bg-yellow-400 text-yellow-900 px-2 py-1 rounded">Pending</span></td>
                                    <td class="py-4">$924.00</td>
                                    <td class="py-4"><a href="#" class="inline-block bg-gray-800 text-white px-3 py-1 rounded shadow">view details</a></td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-4">#375</td>
                                    <td class="py-4">January 04, 2026</td>
                                    <td class="py-4"><span class="text-xs bg-yellow-400 text-yellow-900 px-2 py-1 rounded">Pending</span></td>
                                    <td class="py-4">$444.00</td>
                                    <td class="py-4"><a href="#" class="inline-block bg-gray-800 text-white px-3 py-1 rounded shadow">view details</a></td>
                                </tr>
                                <tr class="border-t">
                                    <td class="py-4">#373</td>
                                    <td class="py-4">January 02, 2026</td>
                                    <td class="py-4"><span class="text-xs bg-green-300 text-green-800 px-2 py-1 rounded">Complete</span></td>
                                    <td class="py-4">$444.00</td>
                                    <td class="py-4"><a href="#" class="inline-block bg-gray-800 text-white px-3 py-1 rounded shadow">view details</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection
