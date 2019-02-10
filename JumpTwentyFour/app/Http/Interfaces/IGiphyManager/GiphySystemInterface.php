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
         * @return array
         */
        function trending():array;
    
    
        /** Performs Giphy Api Search Endpoint
         * @param     $query
         * @param int $limit
         * @param int $offset
         *
         * @return array
         */
        function search($query,$limit = 25, $offset = 0):array;
    
        /** Giphy Random Endpoint
         * @return array
         */
        function random():array;
    }