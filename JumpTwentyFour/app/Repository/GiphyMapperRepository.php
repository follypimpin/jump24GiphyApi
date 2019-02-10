<?php
    /**
     * Created by PhpStorm.
     * User: rolanrewaju
     * Date: 10/02/2019
     * Time: 12:22
     */
    
    namespace App\Providers;
    
    use App\GiphyApi\Types\Gif;
    use App\GiphyApi\Types\Sticker;
    use App\Http\Interfaces\IGiphyManager\GiphySystemInterface;
    
    
    class GiphyMapperRepository
    {
        /**
         * @var Gif|Sticker $giphyMapType
         */
        protected static $giphyMapType;
    
    
        /**
         * @param  int $type
         *
         * @return GiphySystemInterface
         * @throws \Exception
         */
        public static function makeFor(int $type): GiphySystemInterface
        {
        
            switch($type){
                case 1:
                    return new Gif();
            
                case 2:
                    return new Sticker();
            
            }
        
        }
    }