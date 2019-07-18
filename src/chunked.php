<?php
/**
 * Iterator chunk helper
 */
namespace Itertools;


/**
 * Chunk iterator into generator of array
 *
 * @param  iterable $iterable an iterator to chunk
 * @param  int      $size     size of each chunk
 * @return  \Generator a generator of chunk arrays
 */
function chunked(iterable $iterable, int $size): \Generator
{
    $chunk = [];
    foreach ($iterable as $item) {
        $chunk[] = $item;
        if (count($chunk) >= $size) {
            yield $chunk;
            $chunk = [];
        }
    }
    // emit rest if necessary
    if (!empty($chunk)) {
        yield $chunk;
    }
}
