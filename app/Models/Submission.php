<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_id',
        'user_id',
        'jawaban',
        'submitted_at',
        // TODO 2: Tambahkan 'nilai' dan 'catatan_dosen' ke dalam properti $fillable
        'nilai',
        'catatan_dosen',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
        ];
    }

    public function assignment(): BelongsTo
    {
        return $this->belongsTo(Assignment::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // TODO 2: Lengkapi method accessor getStatusNilaiAttribute()
    public function getStatusNilaiAttribute(): string
    {
        if ($this->nilai === null) {
            return 'Belum Dinilai';
        }

        return $this->nilai >= 70 ? 'Lulus' : 'Perlu Perbaikan';
    }
}