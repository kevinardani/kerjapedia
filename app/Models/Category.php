<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'slug',
    ];

    public function jobs(){
        return $this->hasMany(CompanyJob::class);
    }
}
