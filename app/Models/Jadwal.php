<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = "jadwals";

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'namakegiatan',
        'tanggalkegiatan',
        'tanggalselesai',
        'lokasi_id',
        'waktu_mulai',
        'waktu_berakhir'
    ];

    public function lokasis()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function activities()
    {
    	return $this->hasMany(Activity::class);
    }
}
