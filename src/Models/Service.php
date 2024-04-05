<?php

namespace GrassFeria\StarterkidService\Models;

use App\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
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
        'created_at',
        'status',
        'slug'
    ];


    protected $casts = [

      
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
        return $this->created_at->format(config('starterkid.time_format.date_time_format'));
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

        static::created(function () {
          Artisan::call('cache:clear');
            
        });

        static::updated(function ($model) {
            Artisan::call('cache:clear');
        });
        static::deleted(function ($model) {
         Artisan::call('cache:clear');
         });
    }

    
    public function scopeFrontGetServicesWhereStatusIsOnline(\Illuminate\Database\Eloquent\Builder $query, $search = '', $orderBy = 'created_at', $sort = 'desc'): \Illuminate\Database\Eloquent\Builder
    {
        $query = $query->select('id', 'name', 'title', 'created_at', 'status', 'slug', 'preview')
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
              ->width(config('starterkid.image_conversions.thumb.width'))
              ->sharpen(config('starterkid.image_conversions.thumb.sharpen'))
              ->quality(config('starterkid.image_conversions.thumb.quality'))
              ->format('webp');
        $this->addMediaConversion('medium')
              ->width(config('starterkid.image_conversions.medium.width'))
              ->sharpen(config('starterkid.image_conversions.medium.sharpen'))
              ->quality(config('starterkid.image_conversions.medium.quality'))
              ->format('webp');
       $this->addMediaConversion('large')
              ->width(config('starterkid.image_conversions.large.width'))
              ->sharpen(config('starterkid.image_conversions.large.sharpen'))
              ->quality(config('starterkid.image_conversions.large.quality'))
              ->format('webp');
              
        $this->addMediaConversion('thumb_fallback')
              ->width(config('starterkid.image_conversions.thumb.width'))
              ->sharpen(config('starterkid.image_conversions.thumb.sharpen'))
              ->quality(config('starterkid.image_conversions.thumb.quality'));
              
        $this->addMediaConversion('medium_fallback')
              ->width(config('starterkid.image_conversions.medium.width'))
              ->sharpen(config('starterkid.image_conversions.medium.sharpen'))
              ->quality(config('starterkid.image_conversions.medium.quality'));
          
       $this->addMediaConversion('large_fallback')
              ->width(config('starterkid.image_conversions.large.width'))
              ->sharpen(config('starterkid.image_conversions.large.sharpen'))
              ->quality(config('starterkid.image_conversions.large.quality'));
              
    }
}
