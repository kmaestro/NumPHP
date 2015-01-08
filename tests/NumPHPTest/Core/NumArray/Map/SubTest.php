<?php
/**
 * NumPHP (http://numphp.org/)
 *
 * PHP version 5
 *
 * @category  Core
 * @package   NumPHPTest\Core\NumArray\Map
 * @author    Gordon Lesti <info@gordonlesti.com>
 * @copyright 2014-2015 Gordon Lesti (https://gordonlesti.com/)
 * @license   http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link      http://numphp.org/
 */

namespace NumPHPTest\Core\NumArray\Map;

use NumPHP\Core\NumPHP;
use NumPHPTest\Core\Framework\TestCase;
use NumPHP\Core\NumArray;

/**
 * Class SubTest
 *
 * @category Core
 * @package  NumPHPTest\Core\NumArray\Map
 * @author   Gordon Lesti <info@gordonlesti.com>
 * @license  http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link     http://numphp.org/
 */
class SubTest extends TestCase
{
    /**
     * Tests NumArray::sub with scalar values
     *
     * @return void
     */
    public function testSubSingle()
    {
        $numArray1 = new NumArray(-6);
        $numArray2 = new NumArray(45);

        $expectedNumArray = new NumArray(-51);
        $this->assertNumArrayEquals($expectedNumArray, $numArray1->sub($numArray2));
    }

    /**
     * Tests NumArray::sub with scalar and vector
     *
     * @return void
     */
    public function testSubVectorSingle()
    {
        $numArray1 = new NumArray(45);
        $numArray2 = NumPHP::arange(3, 8);

        $expectedNumArray = NumPHP::arange(42, 37);
        $this->assertNumArrayEquals($expectedNumArray, $numArray1->sub($numArray2));
    }

    /**
     * Tests if cache will be flushed after use of NumArray::sub
     *
     * @return void
     */
    public function testSubCache()
    {
        $numArray = new NumArray(5);
        $numArray->setCache('key', 7);

        $numArray->sub(3);
        $this->assertFalse($numArray->inCache('key'));
    }
}
