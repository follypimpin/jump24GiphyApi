<?php

namespace App\GifModel;

use Illuminate\Database\Eloquent\Model;

/**
 * App\GifModel\GifChunkThouOO
 *
 * @property int $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $gif_id
 * @property string $embed_url
 * @property string|null $trending_datetime
 * @property string $migration_date
 * @property string $title
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO whereEmbedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO whereGifId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO whereMigrationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO whereTrendingDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\GifModel\GifChunkThouOO whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GifChunkThouOO extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gif_thou';
    
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
