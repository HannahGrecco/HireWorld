<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Country;



#[Fillable(['country_id', 'weekly_hours_limit', 'min_vacation_days', 'min_wage_local', 'min_wage_period', 'contract_types', 'notice_period_days','source_url'])]
class LaborLaw extends Model
{
    use hasFactory;

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
