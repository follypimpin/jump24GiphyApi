<?php
    /**
     * Created by PhpStorm.
     * User: rolanrewaju
     * Date: 10/02/2019
     * Time: 12:47
     */
    
    namespace App\GiphyApi\Types;
    
    
    use App\Http\Interfaces\IGiphyManager\GiphySystemInterface;
    use App\Http\Requests\ApiGiphyClient;
    
    class Gif implements GiphySystemInterface
    {
        /**
         * @var string $base_url
         */
        private static $base_url;
        /**
         * @var string $api_key
         */
        private static $api_key;
        /**
         * @var string $type
         */
        private static $type = '/gifs';
    
        /** Returns Instance of Self
         * @return Gif
         */
        public static function Instance(): self
        {
            static $inst = null;
            if ($inst === null) {
                $inst = new self();
            }
            
            return $inst;
        }
        
        /** Gets Giphy Base Url
         *
         * @return string
         */
        public static function getApiKey(): string
        {
            if (null === self::$api_key) {
                $env = config('app.giphy_api_key');
                self::$api_key = $env;
            }
            
            return self::$api_key;
        }
        
        /** Gets Api Key
         *
         * @return string
         */
        public static function getBaseUrl(): string
        {
            if (null === self::$base_url) {
                self::$base_url = config('app.giphy_base_url');
            }
            
            return self::$base_url;
        }
        
        
        /** Gets Gif end point type
         *
         * @return string
         */
        public static function getType(): string
        {
            return self::$type;
        }
        
        
        /** Gets Gifs Trending Endpoint
         *
         * @param int $limit
         *
         * @return \Exception|ApiGiphyClient|string
         */
        public function trending($limit = 25)
        {
            $endpoint = self::$type . '/trending';
            
            $params = [
                'limit' => (int)$limit
            ];
            if(!isset($params['api_key']) )
            {
                $params['api_key'] = self::getApiKey();
            }
            
            return ApiGiphyClient::Instance()->sendRequest(self::getBaseUrl(), $endpoint, $params);
            
        }
    
    
        /** Performs Gif Api Search Endpoint
         * @param string $query
         * @param int    $limit
         * @param int    $offset
         *
         * @return \Exception|mixed|string
         */
        public function search($query, $limit = 20, $offset = 0)
        {
            $endpoint = self::$type . '/search';
            $params = array(
                'q'      => urlencode($query),
                'limit'  => (int)$limit,
                'offset' => (int)$offset
            );
            if(!isset($params['api_key']) )
            {
                $params['api_key'] = self::getApiKey();
            }
            
            return ApiGiphyClient::Instance()->sendRequest(self::getBaseUrl(), $endpoint, $params);
        }
        
        /** Giphy Random Endpoint
         * @param string $tag
         * @return \Exception|ApiGiphyClient|string
         */
        public function random($tag): ApiGiphyClient
        {
            $endpoint = self::$type . '/random';
            $params = array(
                'tag' => urlencode($tag),
            );
            if(!isset($params['api_key']) )
            {
                $params['api_key'] = self::getApiKey();
            }
    
            return ApiGiphyClient::Instance()->sendRequest(self::$base_url, $endpoint, $params);
        }
    }