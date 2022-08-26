<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }

    public function kompetensi(){
        return $this->belongsTo(Kompetensi::class);
    }

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function scopeFilter($query, array $search){
        // $query->when($search['tahun_awal'] ?? false, function($query, $search){
        //     return $query->where('profils.npsn', 'like', '%' . $search . '%');
        // });
    }
}
