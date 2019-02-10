<?php
    /**
     * Created by PhpStorm.
     * User: rolanrewaju
     * Date: 10/02/2019
     * Time: 12:47
     */
    
    namespace App\GiphyApi\Types;
    use App\Http\Interfaces\IGiphyManager\GiphySystemInterface;
    
    
    class Sticker implements GiphySystemInterface
    {
    
        /** Gets most popular GIFs via the API
         *
         * @return array
         */
        function trending(): array
        {
            // TODO: Implement trending() method.
        }
    
        /** Performs Giphy Api Search Endpoint
         *
         * @param     $query
         * @param int $limit
         * @param int $offset
         *
         * @return array
         */
        function search($query, $limit = 25, $offset = 0): array
        {
            // TODO: Implement search() method.
        }
    
        /** Giphy Random Endpoint
         *
         * @return array
         */
        function random(): array
        {
            // TODO: Implement random() method.
}}