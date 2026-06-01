<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechSalary extends Model
{
   protected $fillable = [
       'country_id',
        'country',
        'dev_type',
        'salary_usd_yearly',
        'years_code',
        'work_exp',
        'employment_type',
        'remote_work',
        'ed_level',
        'survey_year',
    ];

    protected $casts = [
        'salary_usd_yearly' => 'decimal:2',
        'years_code'        => 'float',
        'work_exp'          => 'float',
        'survey_year'       => 'integer',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    protected $table = 'tech_salary';
}
