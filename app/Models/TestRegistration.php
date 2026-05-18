<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'school',
        'class_name',
        'name',
        'birth_date',
        'address',
        'teacher_class_id',
        'orang_benar',
        'urutan_benar',
        'orang_salah',
        'urutan_salah',
        'total_poin',
        'tested_at',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'tested_at' => 'datetime',
        ];
    }

    public function teacherClass(): BelongsTo
    {
        return $this->belongsTo(TeacherClass::class);
    }
}
