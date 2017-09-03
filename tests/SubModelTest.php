<?php

use MX\Base\Model;
use PHPUnit\Framework\TestCase;

class SubModel extends Model
{
    protected $attr1 = 'a';
    protected $attr2 = 'b';
}

/**
 * @covers MX\Base\SubModel
 */
final class SubModelTest extends TestCase
{
    public function testCanGetProperty()
    {
        $model = new SubModel;

        $this->assertEquals('a', $model->attr1);
    }

    /**
     * @expectedException Exception
     */
    public function testCantSetProperty()
    {
        $model = new SubModel;

        $model->attr1 = 'foo';
        $this->assertNotEquals('foo', $model->attr1);
        $this->assertEquals('a', $model->attr1);
        $this->assertEquals('b', $model->attr2);
    }

    public function testIssetOnExistingProperty()
    {
        $model = new SubModel;

        $this->assertTrue(isset($model->attr1));
    }

    public function testIssetOnNonExistingProperty()
    {
        $model = new SubModel;

        $this->assertFalse(isset($model->nonExistantAttribute));
    }

    public function testUnsetOnExistingProperty()
    {
        $model = new SubModel;

        unset($model->attr1);
        $this->assertNotNull($model->attr1);
        $this->assertEquals('b', $model->attr2);
    }

    public function testUnsetOnNonExistingProperty()
    {
        $model = new SubModel;

        $this->assertFalse(isset($model->nonExistantAttribute));
        unset($model->nonExistantAttribute);
        $this->assertFalse(isset($model->nonExistantAttribute));

        $this->assertEquals('a', $model->attr1);
        $this->assertEquals('b', $model->attr2);
    }
}
