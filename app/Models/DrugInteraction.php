<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugInteraction extends Model
{
    use HasFactory;
    protected $fillable = [
        'drug1',
        'drug2',
        'side_effects',
        'dosage_guidance',
        'overdose_response',
    ];
}
