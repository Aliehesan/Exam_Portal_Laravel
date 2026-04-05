<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['name', 'description', 'status'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
