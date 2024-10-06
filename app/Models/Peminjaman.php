<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'nama_peminjam', 'tanggal_peminjaman', 'tanggal_pengembalian'];
    protected $table = 'peminjamans';

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id'); 
    }
}
