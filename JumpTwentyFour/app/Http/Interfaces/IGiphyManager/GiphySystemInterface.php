<?php
    /**
     * Created by PhpStorm.
     * User: rolanrewaju
     * Date: 10/02/2019
     * Time: 12:29
     */
    
    namespace App\Http\Interfaces\IGiphyManager;
    
    
    interface GiphySystemInterface
    {
        
        
        /** Gets most popular GIFs via the API
         *
         * @param  int limit
         *
         * @return mixed
         */
        public function trending($limit);
        
        
        /** Performs Giphy Api Search Endpoint
         *
         * @param string $query
         * @param int    $limit
         * @param int    $offset
         *
         * @return mixed
         */
        public function search($query, $limit, $offset = 0);
        
        /** Giphy Random Endpoint
         *
         * @param string tag
         * @return mixed
         */
        public function random($tag);
    }