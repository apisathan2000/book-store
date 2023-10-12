<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        


        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Book Details') }}
            </h2>
        </x-slot>


        <div class="max-w-20xl mx-h-20xl">
            <p class="text-5xl my-10">Book Details Edit Form </p>
        </div>

        @if(session('failure'))
            <div class="p-4 mb-4 text-sm text-red-700 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-500" role="alert">
                <span class="font-medium">Invalid Vehicle Number!</span><br>{{ session('failure') }}
            </div>
        @endif

        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">Success !</span><br>{{ session('success') }}
            </div>
        @endif
        

        <form method="POST" action="{{ route('books.update', $book) }}">
            @csrf
            @method('patch')
            <label for='title'>{{ __('Title') }}</label><br>
            <input  name ="book_title" 
                    type="text" 
                    placeholder="Book Title" 
                    id='title'
                    value="{{ $book->book_title }}"
                    class="block w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >
            <br>

            <label for='author'>{{ __('Author') }}</label><br>
            <input  name ="book_author" 
                    type="text" 
                    placeholder="Book Author" 
                    id='author'
                    value="{{ $book->book_author }}"
                    class="block w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    >

            
           

            <br>
            <label for='price'>{{ __('Price of the Book') }}</label><br>
            <input name="book_price"
                type="number"
                min="1"
                step="0.01"
                placeholder="Book Price"
                id='price'
                value="{{ $book->book_price}}"
                class="block w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >

            <br>
            <label for='quantity'>{{ __('Stock Quantity') }}</label><br>
            <input name="book_quantity"
                type="number"
                min="1"
                step="1"
                placeholder="Stock Quantity"
                id='quantity'
                value="{{ $book->book_quantity }}"
                class="block w-auto border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                >

            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Save') }}</x-primary-button>
        
        </form>
    </div>





</x-app-layout>