<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Book;

class BookController extends Controller
{
    //create Book
    public function createBook(Request $request){
        $book = new Book;
        $book->judul = $request->judul;
        $book->penerbit = $request->penerbit;
        $book->save();
        return redirect('/buku');
    }

    //get all Book
    public function getBooks(){
        $books = Book::all();
        return view('buku', ['books' => $books]);
    }

    //update Book
    public function updateBook(Request $request, $id){
        $book = Book::find($id);
        $book->judul = $request->judul;
        $book->penerbit = $request->penerbit;
        $su = $book->save();
        if($su){
            return redirect('/buku');
        }
    }

    //delete Book
    public function deleteBook($id){
        $book = Book::find($id);
        $su =  $book->delete();
        if($su){
            return redirect('/buku');
        }
    }

}
