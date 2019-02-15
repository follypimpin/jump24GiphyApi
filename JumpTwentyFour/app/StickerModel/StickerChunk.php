<?php

namespace App\StickerModel;

use Illuminate\Database\Eloquent\Model;

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
