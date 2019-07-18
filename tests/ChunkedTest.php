<?php
/**
 * Tests for Itertools\chunked
 */
namespace Itertools;

use PHPUnit\Framework\TestCase;
use function Itertools\chunked;

/**
 * Tests for Itertools\chunked
 */
class ChunkedTest extends TestCase
{
    /**
     * chunked() should yields nothing when an empty array is given 
     * 
     * @test
     */
    public function shouldYieldNothingFromEmptyArray()
    {
        $subject = [];
        $generator = chunked($subject, 10);
        $this->assertFalse($generator->valid());
    }

    /**
     * chunk() should chunk an array shorter than a chunk
     * 
     * @test
     */
    public function shouldChunkArrayShorterThanAChunk()
    {
        $subject = [1, 2, 3, 4];
        $generator = chunked($subject, 5);
        $first = $generator->current();
        $this->assertSame($subject, $first);
        $generator->next();
        $this->assertFalse($generator->valid());
    }

    /**
     * chunk() should chunk an array of the exact same length as a chunk
     * 
     * @test
     */
    public function shouldChunkArrayOfAChunk()
    {
        $subject = [1, 2, 3, 4, 5];
        $generator = chunked($subject, 5);
        $first = $generator->current();
        $this->assertSame($subject, $first);
        $generator->next();
        $this->assertFalse($generator->valid());
    }

    /**
     * chunk() should chunk an array evenly
     * @test
     */
    public function shouldChunkArrayEvenly()
    {
        $subject = [1, 2, 3, 4, 5, 6];
        $generator = chunked($subject, 2);
        $expectedChunks = [[1, 2], [3, 4], [5, 6]];
        foreach ($expectedChunks as $expected)
        {
            $actual = $generator->current();
            $this->assertSame($expected, $actual);
            $generator->next();
        }
        $this->assertFalse($generator->valid());
    }

    /**
     * chunk() should chunk an array even if the last chunk is insufficient
     * @test
     */
    public function shouldChunkArrayWithALeftOver()
    {
        $subject = [1, 2, 3, 4, 5, 6, 7];
        $generator = chunked($subject, 2);
        $expectedChunks = [[1, 2], [3, 4], [5, 6], [7]];
        foreach ($expectedChunks as $expected)
        {
            $actual = $generator->current();
            $this->assertSame($expected, $actual);
            $generator->next();
        }
        $this->assertFalse($generator->valid());
    }
}
