<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Book;

class PeminjamanController extends Controller
{
    //get all Peminjaman
    public function getPeminjaman(){
        $peminjaman = Peminjaman::all();
        $books = Book::all();
        return view('peminjaman', ['peminjaman' => $peminjaman, 'books' => $books]);
    }

    //create Peminjaman
    public function createPeminjaman(Request $request){
        $peminjaman = new Peminjaman;

        $peminjaman->book_id = $request->book_id;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->tanggal_peminjaman = $request->tanggal_peminjaman;
        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;

        $su = $peminjaman->save();
        if($su){
            return redirect('/peminjaman');
        }
    }

    //update Peminjaman
    public function updatePeminjaman(Request $request, $id){
        $peminjaman = Peminjaman::find($id);

        $peminjaman->book_id = $request->book_id;
        $peminjaman->nama_peminjam = $request->nama_peminjam;
        $peminjaman->tanggal_peminjaman = $request->tanggal_peminjaman;
        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;

        $su = $peminjaman->save();
        if($su){
            return redirect('/peminjaman');
        }
    }

    public function deletePeminjaman($id){
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();
        return redirect('/peminjaman');
    }
}
