<?php
/**
 * NumPHP - Mathematical PHP library for scientific computing
 *
 * Copyright (c) Gordon Lesti <info@gordonlesti.com>
 */

namespace NumPHPTest\Core\NumArray;

use NumPHP\Core\Exception\CacheException;
use NumPHP\Core\Exception\CacheKeyException;
use NumPHP\Core\NumArray;
use PHPUnit\Framework\TestCase;

/**
 * Class CacheTest
 *
 * @package   NumPHPTest\Core\NumArray
 * @author    Gordon Lesti <info@gordonlesti.com>
 * @copyright 2014-2015 Gordon Lesti (https://gordonlesti.com/)
 * @license   http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link      http://numphp.org/
 * @since     1.0.0
 */
class CacheTest extends TestCase
{
    /**
     * Tests Cache::setCache
     */
    public function testSetCache()
    {
        $numArray = new NumArray(5);
        $numArray->setCache('key', 7);

        $this->assertSame(7, $numArray->getCache('key'));
    }

    /**
     * Tests if CacheKeyException will be thrown, when using Cache::setCache and key
     * is not a string
     *
     */
    public function testSetCacheForbiddenKey()
    {
        $numArray = new NumArray(5);

        $this->expectException(CacheKeyException::class);
        $this->expectExceptionMessage('Key has to be a string');
        $numArray->setCache(5, 6);
    }

    /**
     * Tests if CacheException will be thrown, when using Cache::setCache and key is
     * already used
     *
     */
    public function testSetCacheDouble()
    {
        $numArray = new NumArray(5);

        $this->expectException(CacheException::class);
        $this->expectExceptionMessage('Key "key" already exists');
        $numArray->setCache('key', 5);
        $numArray->setCache('key', 7);
    }

    /**
     * Tests if CacheKeyException will be thrown, when using Cache::getCache and key
     * is not a string
     *
     */
    public function testGetCacheForbiddenKey()
    {
        $numArray = new NumArray(5);

        $this->expectException(CacheKeyException::class);
        $this->expectExceptionMessage('Key has to be a string');
        $numArray->getCache(5);
    }

    /**
     * Tests if CacheException will be thrown, when using Cache::getCache and the
     * key does not exist
     *
     */
    public function testGetMissCache()
    {
        $numArray = new NumArray(5);

        $this->expectException(CacheException::class);
        $this->expectExceptionMessage('Key "key" does not exist');
        $numArray->getCache('key');
    }

    /**
     * Tests if CacheKeyException will be thrown, when using Cache::inCache and key
     * is not a string
     *
     */
    public function testInCacheForbiddenKey()
    {
        $numArray = new NumArray(5);

        $this->expectException(CacheKeyException::class);
        $this->expectExceptionMessage('Key has to be a string');
        $numArray->inCache(5);
    }

    /**
     * Tests Cache::inCache
     */
    public function testFlushCache()
    {
        $numArray = new NumArray(5);
        $numArray->setCache('key', 7);
        $numArray->flushCache();

        $this->assertFalse($numArray->inCache('key'));
    }

    /**
     * Tests Cache::flushCache
     */
    public function testFlushCacheKey()
    {
        $numArray = new NumArray(5);
        $numArray->setCache('key1', 7);
        $numArray->setCache('key2', 8);
        $numArray->flushCache('key2');

        $this->assertSame(7, $numArray->getCache('key1'));
        $this->assertFalse($numArray->inCache('key2'));
    }

    /**
     * Tests if CacheKeyException will be thrown, when using Cache::flushCache and
     * key is not a string
     *
     */
    public function testFlushCacheForbiddenKey()
    {
        $numArray = new NumArray(6);

        $this->expectException(CacheKeyException::class);
        $this->expectExceptionMessage('Key has to be a string');
        $numArray->flushCache(6);
    }
}
