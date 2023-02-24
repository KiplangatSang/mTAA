<?php

namespace App\Models;

use App\Models\Landlords\Caretakers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaretakerRoles extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function roleable()
    {
        # code...
        return $this->morphTo();
    }

    public function caretakers()
    {
        # code...
        $this->hasMany(Caretakers::class,'role');
    }

}
