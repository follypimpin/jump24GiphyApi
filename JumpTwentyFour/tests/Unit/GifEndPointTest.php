<?php
    
    namespace Tests\Unit;
    
    use App\Http\Requests\ApiGiphyClient;
    use App\Repository\GiphyTypeMapperRepository;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use App\GiphyApi\Types\Gif;
    
    class GifEndPointTest extends TestCase
    {
    
        /**
         * Test /giphy_api/trending/ endpoint for cache control
         *
         * @return void
         */
        public function testGifRequestHeaderCacheControlCheck(): void
        {
            $id = 1;
            $response = $this->json('GET', '/giphy_api/trending/' . $id);
            $response->assertHeader('cache-control');
        
        }
        
        
        /**
         * Test /giphy_api/trending/ endpoint with string param
         *
         * @return void
         */
        public function testGifRequestWithString(): void
        {
            $postId = 'I am string';
            $response = $this->json('GET', '/giphy_api/trending/' . $postId);
            $response->assertStatus(422);
            $validationError = [
                'message' => 'The given data was invalid.',
                'errors'  => [
                    'id' => [
                        'This entry can only contain integer'
                    ]
                ]
            ];
            
            
            $response->assertJson($validationError);
            
        }
        
        
        /** Test /giphy_api/trending/ endpoint with null param
         *
         */
        public function testGifRequestTrendingWithNullVal(): void
        {
            $id = null;
            $response = $this->json('GET', '/giphy_api/trending/' . $id);
            $response->assertStatus(404);
        }
        
        
        /** Test /giphy_api/trending/ endpoint with decimal value
         *
         */
        public function testGifRequestTrendingWithDecimal(): void
        {
            $id = 8.9400;
            $response = $this->json('GET', '/giphy_api/trending/' . $id);
            $validationError = [
                'message' => 'The given data was invalid.',
                'errors'  => [
                    'id' => [
                        'This entry can only contain integer'
                    ]
                ]
            ];
            $response->assertStatus(422);
            $response->assertJson($validationError);
        }
        
        /** Test /giphy_api/trending/ endpoint with float val
         *
         */
        public function testGifRequestTrendingWithFloat(): void
        {
            $id = 0.56743;
            $response = $this->json('GET', '/giphy_api/trending/' . $id);
            $validationError = [
                'message' => 'The given data was invalid.',
                'errors'  => [
                    'id' => [
                        'This entry can only contain integer'
                    ]
                ]
            ];
            $response->assertStatus(422);
            $response->assertJson($validationError);
        }
        
        
        /** Test /giphy_api/trending/ endpoint with empty string
         *
         */
        public function testGifRequestTrendingWithEmptyString(): void
        {
            $id = '';
            $response = $this->json('GET', '/giphy_api/trending/' . $id);
            $response->assertStatus(404);
            
        }
        
        
        /** Test /giphy_api/trending/ endpoint with no param
         *
         */
        public function testGifRequestTrendingWithMissingRequestId(): void
        {
            
            $response = $this->json('GET', '/giphy_api/trending/');
            $response->assertStatus(404);
            
        }
        
        
        /** Test /giphy_api/trending/ endpoint with existing id
         *
         */
        public function testGifRequestTrendingWithExistingGifTypeId(): void
        {
            $id = 1;
            $response = $this->json('GET', '/giphy_api/trending/' . $id);
            $response->assertStatus(200);
            
        }
        
        
        /** Test /giphy_api/search/ endpoint with empty post data
         *
         */
        public function testGifRequestSearchWithNullPostData(): void
        {
            $data = [
                'id'    => '',
                'query' => ''
            ];
            $response = $this->json('POST', '/giphy_api/search', $data);
            $response->assertStatus(422);
            $validationError = [
                'message' => 'The given data was invalid.',
                'errors'  => [
                    'id'    => [
                        'Giphy Type Id is required to perform this action',
                    ],
                    'query' => [
                        'Search Query is required',
                    ]
                
                ]
            ];
            $response->assertJson($validationError);
            
        }
        
        /** Test /giphy_api/search/ endpoint with empty id
         *
         */
        public function testGifRequestSearchWithEmptyId(): void
        {
            $data = [
                'id'    => '',
                'query' => 'cat'
            ];
            $response = $this->json('POST', '/giphy_api/search', $data);
            $response->assertStatus(422);
            $validationError = [
                'message' => 'The given data was invalid.',
                'errors'  => [
                    'id' => [
                        'Giphy Type Id is required to perform this action',
                    ],
                
                
                ]
            ];
            $response->assertJson($validationError);
            
        }
        
        /** Test /giphy_api/search/ endpoint with string id
         *
         */
        public function testGifRequestSearchWithStringId(): void
        {
            $data = [
                'id'    => 'I am not supposed to be string',
                'query' => 'cat'
            ];
            $response = $this->json('POST', '/giphy_api/search', $data);
            $response->assertStatus(422);
            $validationError = [
                'message' => 'The given data was invalid.',
                'errors'  => [
                    'id' => [
                        'This entry can only contain integer',
                    ],
                
                
                ]
            ];
            $response->assertJson($validationError);
            
        }
    
    
        /** Test /giphy_api/search/ endpoint with int query
         *
         */
        public function testGifRequestSearchWithIntValQuery(): void
        {
            $data = [
                'id'    => 1,
                'query' => 2
            ];
            $response = $this->json('POST', '/giphy_api/search',$data);
            $response->assertStatus(422);
            $validationError = [
                'message' => 'The given data was invalid.',
                'errors'  => [
                    'query' =>  [
                        'This entry can only contain string',
                    ] ,
            
            
                ]
            ];
            $response->assertJson($validationError);
        
        }
    
        /** Test /giphy_api/search/ endpoint with null query
         *
         */
        public function testGifRequestSearchWithEmptyQuery(): void
        {
            $data = [
                'id'    => 1,
                'query' => ''
            ];
            $response = $this->json('POST', '/giphy_api/search',$data);
            $response->assertStatus(422);
            $validationError = [
                'message' => 'The given data was invalid.',
                'errors'  => [
                    'query' =>  [
                        'Search Query is required',
                    ] ,
            
            
                ]
            ];
            $response->assertJson($validationError);
        
        }
    
    
        /** Test /giphy_api/search/ endpoint with null query
         *
         */
        public function testGifRequestSearchWithNonExistingGiphyObject(): void
        {
            $data = [
                'id'    => 50,
                'query' => 'cat'
            ];
            $response = $this->json('POST', '/giphy_api/search',$data);
            $response->assertStatus(404);
          
        
        }
    
        /** Test /giphy_api/search/ endpoint with null query
         *
         */
        public function testGifRequestSearchWithValidPostData(): void
        {
            $data = [
                'id'    => 1,
                'query' => 'cat'
            ];
            $response = $this->json('POST', '/giphy_api/search',$data);
            $response->assertStatus(200);
            
        
        }
        
    }
