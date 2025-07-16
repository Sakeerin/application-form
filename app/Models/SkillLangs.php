<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillLangs extends Model
{
    use HasFactory;
    public $timestamps= false;
    protected $table = 'skill_langs';

    public function application()
    {
        return $this->belongsTo(Application::class, 'pid');
    }
}
