<x-app-layout>
    {{-- <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"> --}}
        


        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('The List Of Borrowed Books') }}
            </h2>
        </x-slot>



        

        <div class="relative overflow-x-auto max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 ">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <span class="font-medium">Success !</span><br>{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <span class="font-medium">Book Out Of Stock !</span><br>{{ session('error') }}
                </div>
            @endif
            
            <table class="w-full text-sm text-left text-gray-800 dark:text-gray-400 my-5">
                <thead class="text-xs text-gray-100 uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"> Book ID </th>
                        <th scope="col" class="px-6 py-3"> Book Title </th>
                        <th scope="col" class="px-6 py-3"> Author </th>
                        <th scope="col" class="px-6 py-3"> Return </th>
                    </tr>
                </thead>

                @foreach ($borrowedBooks as $book)

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"> {{ $book->book->id }} </td>
                    <td class="px-6 py-4"> {{ $book->book->book_title}} </td>
                    <td class="px-6 py-4"> {{ $book->book->book_author }} </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('issuances.destroy',$book) }}" method="POST">
                            
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Return
                            </button>
                        </form>
                    </td>
                    
                </tr>   
                @endforeach
            </table>
            {{ $borrowedBooks->links() }}

        </div>

            
            
    {{-- </div> --}}


</x-app-layout>