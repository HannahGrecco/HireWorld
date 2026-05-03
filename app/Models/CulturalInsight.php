<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use App\Models\Country;

#[Fillable(['country_id', 'cultural_insights', 'business_etiquette', 'decision_making_style', 'communication_styles', 'things_to_avoid', 'generated_by_ai', 'generated_at'])]
class CulturalInsight extends Model
{
    use HasFactory;

     public function country(){
        return $this->belongsTo(Country::class);
    }
}
