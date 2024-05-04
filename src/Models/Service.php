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

        // stop if cache is false
        if(config('starterkid-frontend.frontend_cache') == false){
            return;
        }
        
        static::created(function () {
            
           
            
             
                //delete all blogpost cache keys
            $blogposts = \GrassFeria\StarterkidBlog\Models\BlogPost::frontGetBlogPostWhereStatusIsOnline()->get();
            foreach ($blogposts as $blogpost) {
                $url = route('front.blog-post.show', ['slug' => $blogpost->slug]);
                $cacheKey = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl($url);
                \Illuminate\Support\Facades\Cache::forget($cacheKey);
                \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch($url);
            }

            // delete blopost index cache key
            $cacheKeyBlogIndex = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl(route('front.blog-post.index'));
            \Illuminate\Support\Facades\Cache::forget($cacheKeyBlogIndex);
            \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch(route('front.blog-post.index'));

            
            // delete service index cache key
            $cacheKeyServiceIndex = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl(route('front.service.index'));
            \Illuminate\Support\Facades\Cache::forget($cacheKeyServiceIndex);
            \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch(route('front.service.index'));
        

            //delete all services cache keys
            $services = \GrassFeria\StarterkidService\Models\Service::frontGetServicesWhereStatusIsOnline()->get();
            foreach ($services as $service) {
                $url = route('front.service.show', ['slug' => $service->slug]);
                $cacheKey = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl($url);
                \Illuminate\Support\Facades\Cache::forget($cacheKey);
                \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch($url);
            }


            // delete homepage cache key
            $cacheKeyHomepage = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl(route('front.homepage'));
            \Illuminate\Support\Facades\Cache::forget($cacheKeyHomepage);
            \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch(route('front.homepage'));
       

            // delete more cache keys service
            (new \App\Services\DeleteCacheKeysAfterServiceUpdate())->deleteCacheKeys();
        
            
        });

    
        // stop if cache is false
        if(config('starterkid-frontend.frontend_cache') == false){
            return;
        }

        static::updated(function ($model) {
            //delete all blogpost cache keys
            $blogposts = \GrassFeria\StarterkidBlog\Models\BlogPost::frontGetBlogPostWhereStatusIsOnline()->get();
            foreach ($blogposts as $blogpost) {
                $url = route('front.blog-post.show', ['slug' => $blogpost->slug]);
                $cacheKey = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl($url);
                \Illuminate\Support\Facades\Cache::forget($cacheKey);
                \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch($url);
            }

            // delete blopost index cache key
            $cacheKeyBlogIndex = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl(route('front.blog-post.index'));
            \Illuminate\Support\Facades\Cache::forget($cacheKeyBlogIndex);
            \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch(route('front.blog-post.index'));
          

            //delete all services cache keys
            $services = \GrassFeria\StarterkidService\Models\Service::frontGetServicesWhereStatusIsOnline()->get();
            foreach ($services as $service) {
                $url = route('front.service.show', ['slug' => $service->slug]);
                $cacheKey = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl($url);
                \Illuminate\Support\Facades\Cache::forget($cacheKey);
                \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch($url);
            }

            // delete service index cache key
            $cacheKeyServiceIndex = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl(route('front.service.index'));
            \Illuminate\Support\Facades\Cache::forget($cacheKeyServiceIndex);
            \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch(route('front.service.index'));
          


            // delete homepage cache key
            $cacheKeyHomepage = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl(route('front.homepage'));
            \Illuminate\Support\Facades\Cache::forget($cacheKeyHomepage);
            \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch(route('front.homepage'));
         

            // delete more cache keys service
            (new \App\Services\DeleteCacheKeysAfterServiceUpdate())->deleteCacheKeys();
        });
        
        // stop if cache is false
        if(config('starterkid-frontend.frontend_cache') == false){
            return;
        }
        
        static::deleted(function ($model) {
           
            
            //delete all blogpost cache keys
            $blogposts = \GrassFeria\StarterkidBlog\Models\BlogPost::frontGetBlogPostWhereStatusIsOnline()->get();
            foreach ($blogposts as $blogpost) {
                $url = route('front.blog-post.show', ['slug' => $blogpost->slug]);
                $cacheKey = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl($url);
                \Illuminate\Support\Facades\Cache::forget($cacheKey);
                \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch($url);
            }

            // delete blopost index cache key
            $cacheKeyBlogIndex = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl(route('front.blog-post.index'));
            \Illuminate\Support\Facades\Cache::forget($cacheKeyBlogIndex);
            \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch(route('front.blog-post.index'));
     

            //delete all services cache keys
            $services = \GrassFeria\StarterkidService\Models\Service::frontGetServicesWhereStatusIsOnline()->get();
            foreach ($services as $service) {
                $url = route('front.service.show', ['slug' => $service->slug]);
                $cacheKey = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl($url);
                \Illuminate\Support\Facades\Cache::forget($cacheKey);
                \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch($url);
            }

            // delete service index cache key
            $cacheKeyServiceIndex = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl(route('front.service.index'));
            \Illuminate\Support\Facades\Cache::forget($cacheKeyServiceIndex);
            \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch(route('front.service.index'));
          


            // delete homepage cache key
            $cacheKeyHomepage = \GrassFeria\StarterkidFrontend\Services\GetCacheKey::ForUrl(route('front.homepage'));
            \Illuminate\Support\Facades\Cache::forget($cacheKeyHomepage);
            \GrassFeria\StarterkidFrontend\Jobs\PreloadCacheJob::dispatch(route('front.homepage'));
     

            // delete more cache keys service
            (new \App\Services\DeleteCacheKeysAfterServiceUpdate())->deleteCacheKeys();

        
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
    }
}
