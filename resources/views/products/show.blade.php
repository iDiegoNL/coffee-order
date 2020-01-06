@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <header class="bg-orange-300">
        <div class="bg-white pt-6 pl-3"
             style="border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
            <!-- Top Icons-->
            <div class="flex items-center">
                <!-- Back Arrow -->
                <a class="far fa-arrow-left text-xl pr-3 opacity-75 hover:no-underline" href="{{ route('home') }}"></a>
                <!-- Admin Icon -->
                @auth
                    @if(Auth::user()->admin == true)
                        <i class="far fa-user-crown text-xl"></i>
                    @endif
                @endauth
            <!-- Favorite Icon-->
                @if(Auth::check() && $product->favorite()->exists() == true)
                    <a class="fas fa-heart text-xl py-2 px-4 absolute top-0 right-0 mt-4 opacity-75 hover:no-underline focus:no-underline text-red-600"
                       href="{{ route('product.unfavorite', $product->id) }}"></a>
                @else
                    <a class="far fa-heart text-xl py-2 px-4 absolute top-0 right-0 mt-4 opacity-75 hover:no-underline focus:no-underline hover:text-red-600 focus:text-red-600"
                       href="{{ route('product.favorite', $product->id) }}"></a>
                @endif
            </div>

            <div class="md:w-1/2 md:mx-auto mt-6">
                <h1 class="text-3xl leading-tight mb-2 font-bold">{{ $product->name }}</h1>
                <hr class="py-2" style="width: 45px; border-top: 2px solid black">
                <p class="block opacity-75 mb-1 mt-2 pb-12">
                    {{ $product->description }}
                </p>
            </div>
        </div>
    </header>

    <!-- Customization Options -->
    <form class="bg-white mt-6 ml-3 mr-3 pl-3 pr-3 pt-3 pb-3 rounded-lg" role="form" method="post"
          action="{{ route('product.order')}}">

        @if ($errors->any())
            <div class="bg-orange-100 border-t-4 border-orange-500 rounded text-orange-900 px-4 py-3 mb-3 shadow-md"
                 role="alert">
                <div class="flex">
                    <div class="fill-current text-2xl h-6 w-6 mr-4">
                        <i class="far fa-exclamation-circle"></i>
                    </div>
                    <div>
                        <p class="font-bold mb-1">
                            Please check the following errors before continuing
                        </p>
                        <ul class="text-sm" style="list-style-type:circle;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
    @endif

        @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}" required>

        <!-- Size -->
        <div>
            <h2 class="font-bold mb-2 text-lg">What size would you like?</h2>
            <!-- Medium -->
            <div class="flex">
                <div class="flex-1 py-2 opacity-75 text-sm">Small (354 ml)</div>
                <div class="flex-1">
                    <input type="number" name="size"
                           class="text-center bg-grey-lighter text-grey-darker py-2 font-normal text-grey-darkest border border-grey-lighter font-bold w-5 float-right mr-6"
                           min="0" value="1" required>
                </div>
            </div>
            <!-- Large -->
            <div class="flex">
                <div class="flex-1 py-2 opacity-75 text-sm">Large (473 ml)</div>
                <div class="flex-1">
                    <input type="number" name=""
                           class="text-center bg-grey-lighter text-grey-darker py-2 font-normal text-grey-darkest border border-grey-lighter font-bold w-5 float-right mr-6"
                           min="0" value="0" required disabled="disabled">
                </div>
            </div>
        </div>
        <div>
            <label for="syrup" class="font-bold mt-6 mb-2 text-lg text-black">Would you like to add some syrup?</label>
            <select
                class="appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                name="syrup" id="syrup" required>
                <option value="no" selected>No, thank you</option>
                <option value="caramel">Caramel</option>
                <option value="hazelnut">Hazelnut</option>
                <option value="vanilla">Vanilla</option>
            </select>
        </div>
        <div>
            <label for="milk" class="font-bold mt-6 mb-2 text-lg text-black">What kind of milk would you like us to
                use?</label>
            <select
                class="appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline"
                name="milk" id="milk" required>
                <option value="regular" selected>Regular milk</option>
                <option value="nonfat">Nonfat milk</option>
                <option value="soy">Soy</option>
                <option value="almond">Almond</option>
            </select>
        </div>
        <div class="mt-6">
            <button
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                type="submit">
                Order
            </button>
        </div>
    </form>
@endsection
