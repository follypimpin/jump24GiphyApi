<?php
    /**
     * Created by PhpStorm.
     * User: rolanrewaju
     * Date: 10/02/2019
     * Time: 13:17
     */
    
    namespace App\Http\Requests;
    
    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\GuzzleException;
    
    
    class ApiGiphyClient
    {
      
        
        public static function Instance(): self
        {
            static $inst = null;
            if ($inst === null) {
                $inst = new self();
            }
            
            return $inst;
        }
    
    
        /** Calls Giphy Api Requests
         * @param string $base_url
         * @param string $endpoint
         * @param array $params
         *
         * @return string
         * @throws \Exception
         */
        public static function sendRequest($base_url, $endpoint, array $params)
        {
            try{
                if (!isset($params['api_key']) || \strlen($params['api_key']) <= 0) {
                    throw new \Exception('Api Key is null');
                }
                $query = http_build_query($params);
                $url = $base_url . $endpoint. ($query ? "?$query" : '');
                $giphyClient = new Client();
                try{
                    $response = $giphyClient->request('GET',$url);
                    if($response->getStatusCode() !== 200){
                        throw new \Exception('Request failed');
                    }
                    return json_decode($response->getBody()->getContents());
                }
                catch (GuzzleException $guzzleException){
                    return $guzzleException ;
                }
                
            }
            catch (\Exception $e)
            {
                // TODO: Implement exception handling
                return $e;
            }
            
        }
        
        
      
    }