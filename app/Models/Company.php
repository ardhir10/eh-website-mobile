<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Company extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_name',
        'company_phone',
        'company_email',
        'company_logo',
        'company_address',
        'company_description'
    ];

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function sitesActive ()
    {
        return $this->hasMany(Site::class)->where('site_status', 'true');
    }
}
