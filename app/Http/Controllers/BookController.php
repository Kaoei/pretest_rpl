<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    //create Book
    public function createBook(Request $request){
        $validateBook = $request->validate([
            'judul' => 'required',
            'penerbit' => 'required'
        ]);

        $book = new Book;
        $book->judul = $validateBook['judul'];
        $book->penerbit = $validateBook['penerbit'];

        $su = $book->save();

        if($su){
            return redirect('/buku')->with('success', 'Data Berhasil Ditambahkan');
        }
    }

    //get all Book
    public function getBooks(){
        $books = Book::all();
        return view('buku', ['books' => $books]);
    }

    //update Book
    public function updateBook(Request $request, $id){
        $book = Book::find($id);
        $validateBook = $request->validate([
            'judul' => 'required',
            'penerbit' => 'required'
        ]);

        $book->judul = $validateBook['judul'];
        $book->penerbit = $validateBook['penerbit'];
        $su = $book->save();
        if($su){
            return redirect('/buku');
        }
    }

    //delete Book
    public function deleteBook($id){
        $book = Book::find($id);
        $su = $book->delete();
        if($su){
            return redirect('/buku');
        }
    }
}
