<?php namespace MagnesiumOxide\Config\Tests;

use MagnesiumOxide\Config\Repository;
use PHPUnit_Framework_TestCase;

class ConfigRepositoryTest extends PHPUnit_Framework_TestCase {
    /** @var Repository */
    private $config;
    private $items;

    public function setUp() {
        $this->items = [
            "Key" => "Value",
            "Array" => [
                "InnerKey" => "InnerValue",
            ],
        ];
        $this->config = new Repository($this->items);
    }

    public function testHas() {
        $this->assertTrue($this->config->has("Key"));
        $this->assertFalse($this->config->has("NonexistentKey"));
    }

    public function testGet() {
        $this->assertEquals("Value", $this->config->get("Key"));
        $this->assertEquals(["InnerKey" => "InnerValue"], $this->config->get("Array"));
        $this->assertEquals(null, $this->config->get("NonexistentKey"));
        $this->assertEquals("DefaultValue", $this->config->get("NonexistentKey", "DefaultValue"));
    }

    public function testSet() {
        $this->assertEquals("Value", $this->config->get("Key"));
        $this->config->set("Key", "NewValue");
        $this->assertEquals("NewValue", $this->config->get("Key"));
        $this->config->set("Key");
        $this->assertEquals(null, $this->config->get("Key"));
    }

    public function testOffsetExists() {
        $this->assertTrue(isset($this->config["Key"]));
        $this->assertFalse(isset($this->config["NonexistentKey"]));
    }

    public function testOffsetGet() {
        $this->assertEquals("Value", $this->config["Key"]);
        $this->assertEquals(["InnerKey" => "InnerValue"], $this->config["Array"]);
    }

    public function testOffsetSet() {
        $this->assertEquals("Value", $this->config["Key"]);
        $this->config["Key"] = "NewValue";
        $this->assertEquals("NewValue", $this->config["Key"]);
    }

    public function testOffsetUnset() {
        $this->assertTrue(isset($this->config["Key"]));
        unset($this->config["Key"]);
        $this->assertFalse(isset($this->config["Key"]));
    }
}
