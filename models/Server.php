<?php namespace Keios\Telekinesis\Models;

use Model;
use October\Rain\Database\Traits\Encryptable;
use October\Rain\Database\Traits\Validation;
use October\Rain\Support\Str;

/**
 * Server Model
 */
class Server extends Model
{
    use Validation;
    use Encryptable;

    public $rules = [
        'ip' => 'required|ip',
        'port' => 'required|integer',
        'username' => '',
        'password' => '',
        'key_path' => '',
        'key_phrase' => '',
        'label' => 'required|alpha_dash|unique:keios_telekinesis_servers,label',
        'root' => 'required'
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'keios_telekinesis_servers';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    protected $encryptable = ['username', 'password'];

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
        'tasks' => [
            'Keios\Telekinesis\Models\Task',
            'table' => 'keios_telekinesis_servers_tasks'
        ]
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getServerLabel()
    {
        return Str::snake($this->label);
    }

}