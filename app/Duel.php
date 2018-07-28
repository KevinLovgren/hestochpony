<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AuditTrait;

class Duel extends Model
{
    use AuditTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_wins', 'second_wins'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $table = 'duels';

    public $timestamps = false;
}
