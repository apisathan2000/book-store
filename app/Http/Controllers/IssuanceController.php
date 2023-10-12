<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Issuance;
use Auth;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IssuanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        $user = Auth::user();

        $borrowedBooks = $user->issuances()->latest()->paginate(5);

        return view('issuances.index', compact('borrowedBooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Book $book)
    {

        // dd($request->all());
        //
        // $validated = $request->validate([
        //     'book_id' => 'required|exists:books,id',
        //     'user_id' => 'required|exists:users,id', 
        // ]);

        // $request->user()->issuances()->create($validated);
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id', 
        ]);
    
        // Begin a database transaction
        DB::beginTransaction();
    
        try {
            $book = Book::findOrFail($validated['book_id']);
    
            // Check if there are available books to borrow
            if ($book->book_quantity > 0) {
                // Decrease the book_quantity by one
                $book->decrement('book_quantity', 1);
    
                // Create an issuance associated with the user
                $request->user()->issuances()->create($validated);
    
                // Commit the transaction
                DB::commit();
            } else {
                // Handle the case when there are no available books
                // return redirect()->back()->with('error', 'This book is out of stock.');
                return redirect()->route('issuances.index')->with('error', 'This book is out of stock.');
            }
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred. Please try again.');
        }
    
        return redirect()->route('issuances.index')->with('success', 'Book borrowed successfully.');

        

    }

    /**
     * Display the specified resource.
     */
    public function show(Issuance $issuance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issuance $issuance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Issuance $issuance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issuance $issuance):RedirectResponse
    {
        //
        $book = $issuance->book;

        $book->increment('book_quantity', 1);

        $issuance->delete();

        return redirect(route('dashboard'))->with('d_success','Book returned successfully !');

    }
}
