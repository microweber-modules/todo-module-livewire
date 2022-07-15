<?php

namespace MicroweberPackages\Modules\TodoModuleLivewire\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'description', 'status'];
}
