<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainings extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $table = 'trainings';

    public function application()
    {
        return $this->belongsTo(Application::class, 'pid');
    }
}
