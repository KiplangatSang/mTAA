<?php

namespace App\Models;

use App\Models\Landlords\Caretakers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function profileable()
    {
        # code...
        return $this->morphTo();
    }

    public function caretaker()
    {
        # code...
        return $this->belongsTo(Caretakers::class,'caretaker_id');
    }

}
