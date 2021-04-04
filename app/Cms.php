<?php

namespace App;

use Illuminate\Foundation\Auth\Cms as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{


  use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_name', 'title', 'description',
    ];




      protected $table = 'cms';

}
