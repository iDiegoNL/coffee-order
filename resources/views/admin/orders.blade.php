@extends('layouts.app')

@section('content')
    <main class="bg-teal-900">
        <meta http-equiv="refresh" content="5"/>
        <div class="bg-teal-900 text-white pt-6 pl-3">
            <!-- Top Icons-->
            <div class="flex items-center">
                <!-- Home Icon -->
                <a href="{{ route('home') }}">
                    <i class="far fa-home text-xl pr-3"></i>
                </a>
                @auth
                    @if(Auth::user()->admin == true)
                        <i class="far fa-user-crown text-xl"></i>
                    @endif
                @endauth
                <button
                    class="bg-transparent hover:bg-blue-500 text-white font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded absolute top-0 right-0 mt-4 mr-3">
                    Dutch
                </button>
            </div>

            <div class="md:w-1/2 md:mx-auto mt-6">
                <h1 class="text-3xl text-orange-300 leading-tight mb-3 font-bold">Order overview</h1>
                @if($orders->count() > 0)
                    <h2 class="text-xl text-white leading-tight mb-3 font-bold">First order:</h2>
                    {{-- The oldest order --}}
                    <div
                        class="bg-orange-100 border-t-8 border-purple-700 rounded text-black px-4 py-3 mt-6 mr-3 shadow-md"
                        role="alert">
                        <div class="flex">
                            <div class="fill-current text-2xl w-20 text-teal-900 mr-4">
                                <img src="{{ asset('images/icons/icons8/process.svg') }}">
                            </div>
                            <div class="opacity-75">
                                <p class="mb-1">{{ \Carbon\Carbon::parse($orders->first()->created_at)->diffForHumans() }}</p>
                                <p class="font-bold mb-1">1x
                                    SMALL {{ \App\Product::findorFail($orders->first()->product_id)->name }}</p>
                                <ul class="font-bold mb-1 ml-4" style="list-style-type:disc;">
                                    <li>{{ ucfirst($orders->first()->syrup) }} syrup</li>
                                    <li>{{ ucfirst($orders->first()->milk) }} milk</li>
                                </ul>
                                <button
                                    class="bg-green-500 hover:bg-gray-100 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                    @if($orders->first()->status == 0)
                                        <a href="{{ route('admin.order.status', $orders->first()->id) }}">
                                            Start order <i class="far fa-chevron-right fa-fw t"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.order.status', $orders->first()->id) }}">
                                            Finish order <i class="far fa-check fa-fw t"></i>
                                        </a>
                                    @endif
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3">
                    {{-- Ignore the first order, since we already used that --}}
                    @foreach($orders->slice(1, count($orders)) as $order)
                        <div
                            class="bg-orange-100 border-t-4 border-teal-200 rounded text-black px-4 py-3 mt-6 mr-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="fill-current text-2xl w-20 text-teal-900 mr-4">
                                    <img src="{{ asset('images/icons/icons8/process.svg') }}">
                                </div>
                                <div class="opacity-75">
                                    <p class="mb-1">{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</p>
                                    <p class="font-bold mb-1">1x
                                        SMALL {{ \App\Product::findorFail($order->product_id)->name }}</p>
                                    <ul class="font-bold mb-1 ml-4" style="list-style-type:disc;">
                                        <li>{{ ucfirst($order->syrup) }} syrup</li>
                                        <li>{{ ucfirst($order->milk) }} milk</li>
                                    </ul>
                                    <p class="text-sm">
                                        The barista will start brewing your coffee within a few minutes.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div
                        class="bg-orange-100 border-t-4 border-teal-500 rounded text-black px-4 py-3 mt-6 mr-3 shadow-md"
                        role="alert">
                        <div class="flex">
                            <div class="fill-current text-2xl w-20 text-teal-900 mr-4">
                                <img src="{{ asset('images/icons/icons8/broom.svg') }}">
                            </div>
                            <div class="opacity-75">
                                <p class="font-bold mb-1">There currently are no new orders</p>
                                <p class="text-sm">
                                   This page will automatically refresh every 5 seconds.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
