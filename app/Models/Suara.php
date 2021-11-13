<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suara extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TYPE_SELECT = [
        'BEM' => 'BEM',
        'DPM' => 'DPM',
    ];

    public $table = 'suaras';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'calon_id',
        'peserta_id',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function calon()
    {
        return $this->belongsTo(Calon::class, 'calon_id');
    }

    public function peserta()
    {
        return $this->belongsTo(Pesertum::class, 'peserta_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
