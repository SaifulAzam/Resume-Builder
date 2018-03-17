<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @package Resume Builder
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class Responsibility extends Model
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
    public function occupations() {
        return $this->belongsToMany(Occupation::class, 'occupation_responsibility');
    }
}
