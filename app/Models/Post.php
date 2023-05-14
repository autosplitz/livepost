<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body'
    ];

    // *This will hide the parameter from the collection
    // protected $hidden = [
    //     'title'
    // ];

    // *This will append the parameter to the collection
    // protected $appends = [
    //     'title_upper_case'
    // ];

    protected $casts = [
        'body' => 'array',
    ];

    /***************************************************************************************
     **   ACCESSORS AND MUTATORS TRANSFORM VALUES WHEN WE RETRIEVE/SET MODEL ATTRIBUTES    *
     ** ACCESSOR MUST INCLUDE THE 'GET' & 'ATTRIBUTE' FROM THE BEGINNING & END RESPECTIVELY *
     ** MUTATOR MUST INCLUDE THE 'SET' & 'ATTRIBUTE' FROM THE BEGINNING & END RESPECTIVELY  *
     ***************************************************************************************/
    // * Accessor
    public function getTitleUpperCaseAttribute()
    {
        return strtoupper($this->title);
    }

    // * Mutator
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtolower($value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}
