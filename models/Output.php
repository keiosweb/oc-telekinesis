<?php namespace Keios\Telekinesis\Models;

use Model;

/**
 * Output Model
 */
class Output extends Model
{

    protected $touches = ['task'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'keios_telekinesis_outputs';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = [
        'output'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];

    public $belongsTo = [
        'server' => ['Keios\Telekinesis\Models\Server'],
        'task' => ['Keios\Telekinesis\Models\Task']
    ];

    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

}