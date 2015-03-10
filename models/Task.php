<?php namespace Keios\Telekinesis\Models;

use October\Rain\Database\Traits\Validation;
use October\Rain\Support\Str;
use Model;

/**
 * Task Model
 */
class Task extends Model
{
    use Validation;

    public $rules = [
        'label' => 'required|alpha_dash|unique:keios_telekinesis_tasks,label',
        'commands' => 'required'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'keios_telekinesis_tasks';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $jsonable = [
        'commands'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'outputs' => [
            'Keios\Telekinesis\Models\Output'
        ]
    ];
    public $belongsTo = [];
    public $belongsToMany = [
        'servers' => [
            'Keios\Telekinesis\Models\Server',
            'table' => 'keios_telekinesis_servers_tasks'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getTaskLabel()
    {
        return Str::snake($this->label);
    }

    public function getTaskCommands()
    {
        return is_array($this->commands) ? $this->commands : [];
    }

}