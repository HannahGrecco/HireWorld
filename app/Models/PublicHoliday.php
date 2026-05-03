<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Models\Country;

#[Fillable(['country_id', 'name', 'date', 'year', 'is_fixed'])]
class PublicHoliday extends Model
{
    use HasFactory;
     public function country(){
        return $this->belongsTo(Country::class);
    }
}
