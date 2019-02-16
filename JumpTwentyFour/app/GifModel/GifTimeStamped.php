<?php

namespace App\GifModel;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GifModel\GifTimeStamped
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $gif_id
 * @property string $embed_url
 * @property string $title
 * @property string|null $trending_datetime
 * @property string $migration_date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped whereEmbedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped whereGifId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped whereMigrationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped whereTrendingDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifTimeStamped whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GifTimeStamped extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gif_time_stamped';
    
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['gif_id','embed_url','title','trending_datetime','migration_date'];
    
    
    /** Returns matching result to given date range
     * @param $start_date
     * @param $end_date
     *
     * @return GifTimeStamped[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getMigratedRange($start_date, $end_date)
    {
       return self::whereBetween('migration_date',array($start_date,$end_date))
                                ->orderBy('migration_date','asc')
                                ->get(['gif_id','embed_url','title','trending_datetime']);
    }
    
    /** Returns paginated matching result to given date range
     * @param $start_date
     * @param $end_date
     *
     * @return GifTimeStamped[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getMigratedPaginateRange($start_date, $end_date)
    {
        return self::whereBetween('migration_date',array($start_date,$end_date))
            ->orderBy('migration_date','asc')
            ->get(['gif_id','embed_url','title','trending_datetime'])
            ->forPage(1,25);
    }
    
    
}
