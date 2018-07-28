<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AuditTrait;

class Deck extends Model
{
    use AuditTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $table = 'decks';

    public $timestamps = false;
}
