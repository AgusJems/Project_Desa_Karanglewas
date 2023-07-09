<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vaksinDetails extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(Vaksin::class);
    }
}
