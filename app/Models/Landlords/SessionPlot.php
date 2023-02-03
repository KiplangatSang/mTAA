<?php
namespace App\Models\LandLords;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionPlot extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sessionable()
    {
        # code...\
      return $this->morphTo();
    }
}
