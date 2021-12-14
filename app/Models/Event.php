<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'events';

    protected $appends = [
        'event_img',
    ];

    protected $dates = [
        'date_event',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'event_name',
        'date_event',
        'desc_event',
        'transportation_id',
        'organizer_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function eventResults()
    {
        return $this->hasMany(Result::class, 'event_id', 'id');
    }

    public function getDateEventAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDateEventAttribute($value)
    {
        $this->attributes['date_event'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function transportation()
    {
        return $this->belongsTo(Transportation::class, 'transportation_id');
    }

    public function organizer()
    {
        return $this->belongsTo(EventOrganizer::class, 'organizer_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class);
    }

    public function getEventImgAttribute()
    {
        $file = $this->getMedia('event_img')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
