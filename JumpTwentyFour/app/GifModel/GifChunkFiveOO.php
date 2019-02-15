<?php

namespace App\GifModel;

use Illuminate\Database\Eloquent\Model;

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
