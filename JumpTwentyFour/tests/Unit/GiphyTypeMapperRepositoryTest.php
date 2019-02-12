<?php

namespace Tests\Unit;

use App\GiphyApi\Types\Sticker;
use App\Repository\GiphyTypeMapperRepository;
use App\GiphyApi\Types\Gif;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GiphyTypeMapperRepositoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testReturnObjectTypeGif()
    {
        $gifObj = GiphyTypeMapperRepository::makeFor(1);
        $this->assertInstanceOf(Gif::class, $gifObj);
    }
    
    
    public function testReturnObjectTypeSticker()
    {
        $gifObj = GiphyTypeMapperRepository::makeFor(2);
        $this->assertInstanceOf(Sticker::class, $gifObj);
    }
    
    
    
    public function testReturnObjectUnknownException()
    {
        $gifObj = GiphyTypeMapperRepository::makeFor(2000);
        $this->assertInstanceOf(\Exception::class, $gifObj);
    }
    
    
    
    
}
