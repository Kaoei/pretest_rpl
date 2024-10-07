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
        $validatePeminjaman = $request->validate([
            'book_id' => 'required',
            'nama_peminjam' => 'required || string',
            'tanggal_peminjaman' => 'required || date',
            'tanggal_pengembalian' => 'required || date'
        ]);

        $peminjaman = new Peminjaman;
        $peminjaman->book_id = $validatePeminjaman['book_id'];
        $peminjaman->nama_peminjam = $validatePeminjaman['nama_peminjam'];
        $peminjaman->tanggal_peminjaman = $validatePeminjaman['tanggal_peminjaman'];
        $peminjaman->tanggal_pengembalian = $validatePeminjaman['tanggal_pengembalian'];
        
        $su = $peminjaman->save();

        if($su){
            return redirect('/peminjaman')->with('success', 'Data Berhasil Ditambahkan');
        }
    }

    //update Peminjaman
    public function updatePeminjaman(Request $request, $id){
        $peminjaman = Peminjaman::find($id);

        $validatePeminjaman = $request->validate([
            'book_id' => 'required',
            'nama_peminjam' => 'required',
            'tanggal_peminjaman' => 'required',
            'tanggal_pengembalian' => 'required'
        ]);

        $peminjaman->book_id = $validatePeminjaman['book_id'];
        $peminjaman->nama_peminjam = $validatePeminjaman['nama_peminjam'];
        $peminjaman->tanggal_peminjaman = $validatePeminjaman['tanggal_peminjaman'];
        $peminjaman->tanggal_pengembalian = $validatePeminjaman['tanggal_pengembalian'];

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
