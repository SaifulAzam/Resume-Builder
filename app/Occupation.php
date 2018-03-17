<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class Occupation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Defines the relationship between the occupations and their
     * responsibilities.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function responsibilities() {
        return $this->belongsToMany(Responsibility::class, 'occupation_responsibility');
    }
}
