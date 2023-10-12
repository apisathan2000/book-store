<x-app-layout>
    {{-- <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"> --}}
        


        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('The List Of Books') }}
            </h2>
        </x-slot>

        <div class="relative overflow-x-auto max-w-6xl mx-auto p-4 sm:p-6 lg:p-8 ">
            <table class="w-full text-sm text-left text-gray-800 dark:text-gray-400 my-5">
                <thead class="text-xs text-gray-100 uppercase bg-gray-500 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3"> Book Title </th>
                        <th scope="col" class="px-6 py-3"> Author </th>
                        <th scope="col" class="px-6 py-3"> Price</th>
                        <th scope="col" class="px-6 py-3"> Quantity </th>
                        <th scope="col" class="px-6 py-3"> Borrow </th>
                        <th scope="col" class="px-6 py-3"> Edit/Delete </th>
                    </tr>
                </thead>

                @foreach ($books as $book )

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"> {{ $book->book_title }} </td>
                    <td class="px-6 py-4"> {{ $book->book_author}} </td>
                    <td class="px-6 py-4"> {{ $book->book_price }} </td>
                    <td class="px-6 py-4"> {{ $book->book_quantity }} </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('issuances.store',$book)}}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <input type="hidden" name="user_id" value="{{ $book->user_id}}">
                            <button type="submit" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Borrow
                            </button>
                            
                        </form>
                    </td>
                    <td class="px-6 py-4"> 
                        <form action="{{ route('books.destroy',$book) }}" method="POST">
                            <button type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                <a class="font-medium text-white" href="{{ route('books.edit',$book) }}">Edit</a>
                            </button>
                            
                            
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete
                            </button>
                            
                        </form>
                    </td>
                </tr>   
                @endforeach
            </table>
            {{ $books->links() }}

        </div>

            
            
    {{-- </div> --}}


</x-app-layout>