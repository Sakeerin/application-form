<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $table = 'work_experience';

    public function application()
    {
        return $this->belongsTo(Application::class, 'pid');
    }
}
