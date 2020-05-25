<?php


namespace Tasks\Model;


use Illuminate\Database\Eloquent\Model as Eloquent;


/**
 * @property string $name
 * @property string $email
 * @property string $description
 * @property bool $edited
 * @property bool $complete
 */
class Task extends Eloquent

{
    const KEY_SORT_FIELD = 'sort_by';
    const KEY_SORT_ORDER = 'sort_order';
    const SORT_FIELDS = ['name', 'email', 'complete'];
    const SORT_ORDER = ['asc', 'desc'];

    /**
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['name', 'email', 'description', 'edited', 'complete'];
}