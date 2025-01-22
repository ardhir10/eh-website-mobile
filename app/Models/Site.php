<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use Illuminate\Database\Eloquent\SoftDeletes;
class Site extends Model
{
    // soft delete
    use SoftDeletes;

    // Guarded
    protected $guarded = [];

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
