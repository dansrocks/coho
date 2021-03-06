<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ClockType
 *
 * @package App\Models
 */
class ClockType extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'clock_types';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];
}
