@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <header class="bg-orange-300">
        <div class="bg-teal-900 text-white pt-6 pl-3"
             style="border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
            <!-- Top Icons-->
            <div class="flex items-center">
                <!-- Notification Bell -->
                <i class="far fa-bell text-xl pr-3"></i>
                @auth
                    @if(Auth::user()->admin == true)
                        <a href="{{ route('admin.orders') }}">
                            <i class="far fa-user-crown text-xl"></i>
                        </a>
                    @endif
                @endauth
                <button
                    class="bg-transparent hover:bg-blue-500 text-white font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded absolute top-0 right-0 mt-4 mr-3">
                    Dutch
                </button>
            </div>

            <div class="md:w-1/2 md:mx-auto mt-6">
                <!-- TODO: Greeting based on time (Good morning, afternoon, etc) -->
                <h1 class="text-3xl text-orange-300 leading-tight mb-3 font-bold">Hi, {{ Auth::user()->name }}! 👋</h1>
                <p>
                    <!-- TODO: Make this customizable in the admin panel -->
                    A good day starts with a good ☕. How do you want to start your day?
                </p>

                @auth
                    @if(\App\Order::where('user_id', Auth::id())->latest()->value('status') == 0)
                        <meta http-equiv="refresh" content="5"/>
                        <div
                            class="bg-orange-100 border-t-4 border-teal-500 rounded text-black px-4 py-3 mt-6 mr-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="fill-current text-2xl w-20 text-teal-900 mr-4">
                                    <img src="{{ asset('images/icons/icons8/process.svg') }}">
                                </div>
                                <div class="opacity-75">
                                    <p class="font-bold mb-1">Your order is being processed</p>
                                    <p class="text-sm">
                                        The barista will start brewing your coffee within a few minutes.
                                        <br>
                                        <small>
                                            Changed your mind?
                                            <a href="{{ route('product.order.cancel', \App\Order::where('user_id', Auth::id())->latest()->value('id')) }}">Cancel
                                                the order.</a>
                                            <i class="fal fa-chevron-double-right fa-xs fa-fw"></i>
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif(\App\Order::where('user_id', Auth::id())->latest()->value('status') == 1)
                        <meta http-equiv="refresh" content="5"/>
                        <div
                            class="bg-orange-100 border-t-4 border-teal-500 rounded text-black px-4 py-3 mt-6 mr-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="fill-current text-2xl w-24 text-teal-900 mr-4">
                                    <img src="{{ asset('images/icons/icons8/man_coffee_cup.svg') }}">
                                </div>
                                <div class="opacity-75">
                                    <p class="font-bold mb-1">Your coffee is being brewed</p>
                                    <p class="text-sm">
                                        Your coffee will be ready for pickup within a few minutes.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif(\App\Order::where('user_id', Auth::id())->latest()->value('status') == 2)
                        <div
                            class="bg-orange-100 border-t-4 border-purple-500 rounded text-black px-4 py-3 mt-6 mr-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="fill-current text-2xl w-24 text-teal-900 mr-4">
                                    <img src="{{ asset('images/icons/icons8/coffee_to_go.svg') }}">
                                </div>
                                <div class="opacity-75">
                                    <p class="font-bold mb-1">Your order is ready for pickup</p>
                                    <p class="text-sm">
                                        Please show the barista your QR code to receive your order.
                                        <br>
                                        <a href="#qrcode" rel="modal:open">Show QR code for pickup <i
                                                class="fal fa-chevron-double-right fa-xs fa-fw"></i></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div id="qrcode" class="modal">
                            <h1 class="text-xl leading-tight mb-3 font-bold">Show this to the barista</h1>
                            <img
                                src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl={{ \App\Order::where('user_id', Auth::id())->latest()->value('id') }}&choe=UTF-8"
                                class="object-none object-center">
                        </div>
                    @elseif(\App\Order::where('user_id', Auth::id())->latest()->value('status') == 3)
                        <div
                            class="bg-orange-100 border-t-4 border-teal-500 rounded text-black px-4 py-3 mt-6 mr-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="fill-current text-2xl w-24 text-green-900 mr-4">
                                    <img src="{{ asset('images/icons/icons8/checkmark.svg') }}">
                                </div>
                                <div class="opacity-75">
                                    <p class="font-bold mb-1">Your order has been picked up</p>
                                    <p class="text-sm">
                                        Enjoy your order, and we hope to see you again soon!
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif(\App\Order::where('user_id', Auth::id())->latest()->value('status') == 9)
                        <div
                            class="bg-orange-100 border-t-4 border-red-500 rounded text-black px-4 py-3 mt-6 mr-3 shadow-md"
                            role="alert">
                            <div class="flex">
                                <div class="fill-current text-2xl w-24 mr-4">
                                    <img src="{{ asset('images/icons/icons8/cancel.svg') }}">
                                </div>
                                <div class="opacity-75">
                                    <p class="font-bold mb-1">Your order has been cancelled</p>
                                    <p class="text-sm">
                                        The order that you made has been cancelled.
                                    </p>
                                </div>
                            </div>
                        </div>
                @endif
            @endauth

            <!-- TODO: Fix a way that the title doesn't have to be in the header to be fancy with the rounding -->
                <h1 class="pt-20 pb-6 font-bold text-xl">Coffee:</h1>
            </div>
        </div>
    </header>

    <section class="flex items-center overflow-x-auto bg-orange-300">

        @foreach($products as $product)
            <div
                class="flex-shrink-0 m-6 relative overflow-hidden rounded-lg max-w-xs shadow-lg bg-orange-100 focus:no-underline"
                onclick="location.href = `{{ route('product.show', [strtolower($product->name), $product->id]) }}`">
                <div class="relative pt-10 px-10 flex items-center justify-center">
                    <span class="absolute top-0 right-0 mt-3 mr-3">
                        <!-- Favorite Icon-->
                        @if(Auth::check() && $product->favorite()->exists() == true)
                            <a class="fas fa-heart text-lg opacity-75 hover:no-underline focus:no-underline text-red-600"
                               href="{{ route('product.unfavorite', $product->id) }}"></a>
                        @else
                            <a class="fal fa-heart text-lg opacity-50 hover:no-underline focus:no-underline hover:text-red-600 focus:text-red-600"
                               href="{{ route('product.favorite', $product->id) }}"></a>
                        @endif
                    </span>
                    <img class="relative w-40"
                         src="{{ asset('image/cappuccino.png') }}" alt="">
                </div>
                <div class="relative px-6 pb-6 mt-6">
                    <div class="flex justify-between">
                        <span class="block font-semibold text-xl">{{ $product->name }}</span>
                        <span
                            class="block text-orange-500 text-sm font-bold leading-none flex items-center">&euro; {{ $product->price }}</span>
                    </div>
                    <p class="block opacity-75 mb-1 mt-2">
                        {{ $product->description }}
                    </p>
                </div>
            </div>
        @endforeach

    </section>

    @isset($favorites)
        <h1 class="pt-20 pb-6 pl-3 font-bold text-xl">Favorites:</h1>
        <section class="flex items-center overflow-x-auto bg-orange-300">
            @foreach($favorites as $favorite)
                <div
                    class="flex-shrink-0 m-6 relative overflow-hidden rounded-lg max-w-xs shadow-lg bg-orange-100 focus:no-underline"
                    onclick="location.href = `{{ route('product.show', [strtolower($favorite->product->name), $favorite->product->id]) }}`">
                    <div class="relative pt-10 px-10 flex items-center justify-center">
                    <span class="absolute top-0 right-0 mt-3 mr-3">
                        <!-- Favorite Icon-->
                        <a class="fas fa-heart text-lg opacity-75 hover:no-underline focus:no-underline text-red-600"
                           href="{{ route('product.unfavorite', $favorite->product->id) }}"></a>
                    </span>
                        <img class="relative w-40"
                             src="{{ asset('image/cappuccino.png') }}" alt="">
                    </div>
                    <div class="relative px-6 pb-6 mt-6">
                        <div class="flex justify-between">
                            <span class="block font-semibold text-xl">{{ $favorite->product->name }}</span>
                            <span
                                class="block text-orange-500F text-sm font-bold leading-none flex items-center">&euro; {{ $favorite->product->price }}</span>
                        </div>
                        <p class="block opacity-75 mb-1 mt-2">
                            {{ $favorite->product->description }}
                        </p>
                    </div>
                </div>
            @endforeach
        </section>
    @endisset
@endsection
