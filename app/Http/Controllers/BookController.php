<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        $user = Auth::user();

        $books = Book::latest()
                    ->paginate(5);

        return view('books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        //
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {

        // dd($request->all());
        //
        $validated = $request->validate([
            'book_title' => 'required|string',
            'book_author' => 'required|string',
            'book_price'=>'required|numeric',
            'book_quantity'=>'required|numeric',
        ]);

        
        

        $request->user()->books()->create($validated);

        // return redirect(route('dashboard'))->with('success','Book Inserted Successfully !');
        return redirect(route('dashboard'))->with('success','Book Inserted Successfully !');

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book):View
    {
        //
        return view('books.edit',compact('book'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book):RedirectResponse
    {
        //
        $validated = $request->validate([
            'book_title' => 'required|string',
            'book_author' => 'required|string',
            'book_price'=>'required|numeric',
            'book_quantity'=>'required|numeric',
        ]);

        $book->update($validated);

        // return redirect(route('dashboard'))->with('success','Book details Updated Successfully !');

        return redirect(route('dashboard'))->with('success','Book details Updated Successfully !');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book):RedirectResponse
    {
        //
        $book->delete();

        return redirect(route('dashboard'))->with('d_success','Book removed successfully !');

    }
}
