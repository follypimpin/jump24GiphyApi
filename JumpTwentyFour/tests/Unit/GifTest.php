<?php
    
    namespace Tests\Unit;
    
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use App\GiphyApi\Types\Gif;
    
    class GifTest extends TestCase
    {
        
        /**
         * Validates Gif Instance
         */
        public function testGifInstance()
        {
            $gif = Gif::Instance();
            
            $this->assertInstanceOf(Gif::class, $gif);
        }
        
        
        /**
         * Validates Not Null Api Key
         */
        public function testNullApiKey(): void
        {
            $this->assertNotNull(Gif::getApiKey());
        }
        
        
        public function testisStringApiKey(): void
        {
            $this->assertTrue(\is_string(Gif::getApiKey()));
            
        }
        
        /**
         * Validates Not Null Base Url
         */
        public function testNullBaseUrl(): void
        {
            $this->assertNotNull(Gif::getBaseUrl());
        }
        
        
        public function testisStringBaseUrl(): void
        {
            $this->assertTrue(\is_string(Gif::getBaseUrl()));
            
        }
        
        
        public function testNullGetType(): void
        {
            $this->assertNotNull(Gif::getType());
        }
        
        
        public function testisStringGetType(): void
        {
            $this->assertTrue(\is_string(Gif::getType()));
            
        }
        
        
        public function testGetTypeBeginsWithBackSlash()
        {
            $prefix = '/';
            $this->assertStringStartsWith($prefix,Gif::getType());
        }
    }