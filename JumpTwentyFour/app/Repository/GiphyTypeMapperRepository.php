<?php
    /**
     * Created by PhpStorm.
     * User: rolanrewaju
     * Date: 10/02/2019
     * Time: 16:55
     */
    
    namespace App\Repository;
    
    use App\GiphyApi\Types\Gif;
    use App\GiphyApi\Types\Sticker;
    use App\Http\Interfaces\IGiphyManager\GiphySystemInterface;
    
    class GiphyTypeMapperRepository
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
            
            switch ($type) {
                case 1:
                    return new Gif();
                
                case 2:
                    return new Sticker();
                
                
            }
            
            
        }
        
    }