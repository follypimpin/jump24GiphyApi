<?php

namespace App\StickerModel;

use Illuminate\Database\Eloquent\Model;

/**
 * App\StickerModel\StickerChunk
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StickerModel\StickerChunk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StickerModel\StickerChunk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StickerModel\StickerChunk query()
 * @mixin \Eloquent
 */
class StickerChunk extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sticker_chunk';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['s_id','embed_url','title','trending_datetime','migration_date','rating'];
    
    
}
