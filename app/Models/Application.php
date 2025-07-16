<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';

    public function educations()
    {
        return $this->hasMany(Educations::class, 'pid');
    }

    public function skillLangs()
    {
        return $this->hasMany(SkillLangs::class, 'pid');
    }

    public function skillPrograms()
    {
        return $this->hasMany(SkillPrograms::class, 'pid');
    }

    public function trainings()
    {
        return $this->hasMany(Trainings::class, 'pid');
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class, 'pid');
    }
}
