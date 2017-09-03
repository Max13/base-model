<?php

use MX\Base\Model;
use PHPUnit\Framework\TestCase;

/**
 * @covers MX\Base\Model
 */
final class ModelTest extends TestCase
{
    public function testCanBeCreatedEmpty()
    {
        $this->assertInstanceOf(Model::class, new Model);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testCanOnlyBeCreatedFromArray()
    {
        $this->assertInstanceOf(
            Model::class,
            new Model(['a' => 1, 'b' => 2, 'c' => 3])
        );

        $this->assertNull(new Model('foo'));
        $this->assertNull(new Model(1));
        $this->assertNull(new Model(STDERR));
    }

    public function testCanBeCreatedWithAttributes()
    {
        $model = new Model(['a' => 1, 'b' => 2, 'c' => 3]);

        $this->assertInstanceOf(Model::class, $model);
        $this->assertEquals(1, $model->a);
        $this->assertEquals(2, $model->b);
        $this->assertEquals(3, $model->c);
    }

    public function testCanSetExistingInternalAttribute()
    {
        $model = new Model(['a' => 1]);

        $model->a = 9;
        $this->assertEquals(9, $model->a);
    }

    public function testCanSetNonExistingInternalAttribute()
    {
        $model = new Model(['a' => 1]);

        $model->b = 2;
        $this->assertEquals(1, $model->a);
        $this->assertEquals(2, $model->b);
    }

    public function testCanGetExistingInternalAttribute()
    {
        $model = new Model(['a' => 1]);

        $this->assertEquals(1, $model->a);
    }

    public function testGetNonExistingInternalAttributeIsNull()
    {
        $model = new Model;

        $this->assertNull($model->b);
    }

    public function testIssetOnExistingInternalAttribute()
    {
        $model = new Model(['a' => 1, 'b' => null]);

        $this->assertTrue(isset($model->a));
        $this->assertFalse(isset($model->b));
    }

    public function testIssetOnNonExistingInternalAttribute()
    {
        $model = new Model;

        $this->assertFalse(isset($model->c));
    }

    public function testUnsetOnExistingInternalAttribute()
    {
        $model = new Model(['a' => 1]);

        $this->assertEquals(1, $model->a);
        unset($model->a);
        $this->assertNull($model->a);
    }

    public function testUnsetOnNonExistingInternalAttribute()
    {
        $model = new Model(['a' => 1]);

        unset($model->b);
        $this->assertEquals(1, $model->a);
        $this->assertNull($model->b);
    }
}
