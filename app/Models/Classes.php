<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    protected $hidden = ['pivot'];

    public function organization()
    {
        return $this->belongsToMany(Organization::class, 'organizations_classes');
    }
}
