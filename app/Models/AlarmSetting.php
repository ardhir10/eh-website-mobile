<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlarmSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'parameter',
        'formula',
        'set_point',
        'status',
        'description',
        'created_by',
        'updated_by',
        'is_active'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
