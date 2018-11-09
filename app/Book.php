<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'description'];

    /**
     * A book belongs to a user.
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A book can have many ratings.
     *
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function ratings() 
    {
        return $this->hasMany(Rating::class);
    }
}
