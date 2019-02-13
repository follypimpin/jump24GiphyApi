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
    use http\Exception\InvalidArgumentException;

    class GiphyTypeMapperRepository
    {
        
        
        /**
         * @var Gif|Sticker $giphyMapType
         */
        protected static $giphyMapType;
    
    
        /** Returns Gif|Sticker object
         * @param int $type
         *
         * @return Gif|Sticker|\Exception
         */
        public static function makeFor(int $type)
        {
            
            try{
                
                switch ($type) {
                    case 1:
                        return new Gif();
                        break;
        
                    case 2:
                        return new Sticker();
                        break;
                    default:
                        throw new \Exception('Unknown Giphy Type Provided');
                        break;
                }
            } catch (\Exception $e) {
                 return $e;
            }
            
            
            
        }
        
    }