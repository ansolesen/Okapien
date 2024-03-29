<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherGroup extends Model
{
    protected $table = 'teacher_groups';
    protected $fillable = [
        'school_id',
    ];

    public function teacherGroupRelation(){
        return $this->hasMany('App\teacherGroupRelation');
    }    
    public function courses(){
        return $this->hasMany('App\Course');
    }
    public function school(){
        return $this->belongsTo('App\School');
    }        
}
