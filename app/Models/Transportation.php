<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transportation extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const TRANSPORTATION_TYPE_SELECT = [
        'plane' => 'Avión',
        'bus'   => 'Autobús',
        'train' => 'Tren',
        'ferry' => 'Ferri',
        'cab'   => 'Taxi',
    ];

    public $table = 'transportations';

    protected $dates = [
        'dep_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'company_name',
        'transportation_type',
        'dep_place',
        'dep_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDepDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDepDateAttribute($value)
    {
        $this->attributes['dep_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
