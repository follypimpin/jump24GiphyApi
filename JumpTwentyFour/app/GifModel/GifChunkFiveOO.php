<?php

namespace App\GifModel;

use Illuminate\Database\Eloquent\Model;

class GifChunkFiveOO extends Model
{
    //
    
 
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['gif_id','embed_url','title','trending_datetime','migration_date'];
}
