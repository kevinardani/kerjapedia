<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCandidate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'resume',
        'message',
        'is_hired',
        'candidate_id',
        'company_job_id',
    ];

    public function profile(){
        return $this->belongsTo(User::class, 'candidate_id');
    }

    public function job(){
        return $this->belongsTo(CompanyJob::class, 'company_job_id');
    }
}
