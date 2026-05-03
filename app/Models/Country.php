<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\LaborLaw;
use App\Models\PublicHoliday;
use App\Models\CulturalInsight;


#[Fillable(['name', 'iso_code', 'region', 'currency_code', 'official_language', 'timezone', 'flag_emoji'])]
class Country extends Model
{
    use HasFactory;

    public function laborLaw(){
        return $this->hasOne(LaborLaw::class);
    }
    public function publicHolidays(){
        return $this->hasMany(PublicHoliday::class);
    }
    public function culturalInsight(){
        return $this->hasOne(CulturalInsight::class);
    }

}
