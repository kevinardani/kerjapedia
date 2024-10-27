<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobResponsibility extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'company_job_id',
    ];
}
