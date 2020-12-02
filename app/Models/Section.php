<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function classes()
    {
        return $this->belongsTo(classes::class);
    }

}
