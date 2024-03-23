<?php

namespace GrassFeria\StarterkidService\Models;

use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Service extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'name',
        'title',
        'preview',
        'content',
        'published',
        'status',
        'slug'
    ];


    protected $casts = [

        'published' => 'datetime',
        'status' => 'boolean',

    ];

    public function scopeOfUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //public function getDate()
    //{
    //    return $this->date->format(config('starterkid.time_format.date_format'));
    //}

    public function getPublished()
    {
        return $this->published->format(config('starterkid.time_format.date_time_format'));
    }

    //public function getTime()
    //{
    //    return $this->time->format(config('starterkid.time_format.time_format'));
    //}

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),

        );
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($model) {
           \Spatie\ResponseCache\Facades\ResponseCache::forget(url('/').'/'.config('starterkid-service.service_slug').'/'.$model->slug);
        });
        static::deleted(function ($model) {
            \Spatie\ResponseCache\Facades\ResponseCache::forget(url('/').'/'.config('starterkid-service.service_slug').'/'.$model->slug);
         });
    }

    
    public function scopeFrontGetServicesWhereStatusIsOnline(\Illuminate\Database\Eloquent\Builder $query, $search = '', $orderBy = 'id', $sort = 'desc'): \Illuminate\Database\Eloquent\Builder
    {
        $query = $query->select('id', 'name', 'title', 'published', 'status', 'slug', 'preview')
            ->where('status', true);

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        $query->orderBy($orderBy, $sort);

        return $query;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(200);
        $this->addMediaConversion('medium')
              ->width(800);
        $this->addMediaConversion('large')
              ->width(1200);
              
    }
}
