<?php

namespace App\GifModel;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GifModel\GifChunkFiveOO
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $gif_id
 * @property string $embed_url
 * @property string|null $trending_datetime
 * @property string $migration_date
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO whereEmbedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO whereGifId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO whereMigrationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO whereTrendingDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkFiveOO whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GifChunkFiveOO extends Model
{
    
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gif_five_hundy';
    
    
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
}
