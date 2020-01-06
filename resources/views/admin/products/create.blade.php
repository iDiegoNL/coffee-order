@extends('layouts.app')

@section('content')
    <header class="bg-orange-300">
        <div class="bg-teal-900 text-white pt-6 pl-3 pb-6"
             style="border-bottom-right-radius: 10%; border-bottom-left-radius: 10%;">
            <!-- Back Icon -->
            <a href="" onclick="window.history.back()">
                <i class="far fa-arrow-left text-xl pr-3"></i>
            </a>

            <div class="md:w-1/2 md:mx-auto mt-6">
                <!-- TODO: Greeting based on time (Good morning, afternoon, etc) -->
                <h1 class="text-2xl text-orange-300 leading-tight mb-3 font-bold">Create a new product</h1>
            </div>
        </div>
    </header>
    <form class="bg-white mt-6 ml-3 mr-3 pl-3 pr-3 pt-3 pb-3 rounded-lg" role="form" method="post"
          action="{{ route('admin.products.store')}}">

        @if ($errors->any())
            <div class="bg-orange-100 border-t-4 border-orange-500 rounded text-orange-900 px-4 py-3 shadow-md"
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
        <div>
            <div>
                <label for="name" class="font-bold mt-6 mb-2 text-lg text-black">
                    Name
                </label>
                <input
                    class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal @error('name') border-red-600 text-red-600 @enderror"
                    type="text" name="name" id="name" placeholder="Cappuccino" value="Cappuccino" value="{{ old('name') }}">
                @error('name')
                <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="description" class="font-bold mt-6 mb-2 text-lg text-black">
                    Short Description
                </label>
                <textarea
                    class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal @error('description') border-red-600 text-red-600 @enderror"
                    type="text" name="description" id="description"
                    placeholder="A double shot of espresso with equal parts steamed milk and foam">A double shot of espresso with equal parts steamed milk and foam
                </textarea>
                @error('description')
                <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="price" class="font-bold mt-6 mb-2 text-lg text-black">
                    Price
                </label>
                <div class="flex flex-row">
                    <span
                        class="flex items-center bg-grey-lighter rounded rounded-r-none px-3 font-bold text-grey-darker">&euro;</span>
                    <input
                        class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal @error('price') border-red-600 text-red-600 @enderror"
                        type="number" name="price" id="price" placeholder="3.99" value="3.99" step=".01" value="{{ old('price') }}">
                </div>
                @error('price')
                <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="visible" class="font-bold mt-6 mb-2 text-lg text-black">
                    Visible
                </label>
                <select
                    class="appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline @error('visible') border-red-600 text-red-600 @enderror"
                    name="visible" id="visible" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('visible')
                <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="in_stock" class="font-bold mt-6 mb-2 text-lg text-black">
                    In Stock
                </label>
                <select
                    class="appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline @error('in_stock') border-red-600 text-red-600 @enderror"
                    name="in_stock" id="in_stock" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('in_stock')
                <small class="text-red-600">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-6">
                <button
                    class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Add Product
                </button>
            </div>
        </div>
    </form>
@endsection
