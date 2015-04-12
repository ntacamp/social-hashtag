<?php


namespace NtaCamp\SocialHashtag\Tests;

use NtaCamp\SocialHashtag\Post;

class PostTest extends \PHPUnit_Framework_TestCase
{
    /** @var Post */
    private $post;

    public function setUp()
    {
        $this->post = new Post();
    }

    public function testAllPropertiesHasSetters()
    {
        foreach ($this->getProperties() as $property) {
            $this->assertTrue(method_exists($this->post, 'set'.ucfirst($property->name)));
        }
    }

    public function testAllPropertiesHasGetters()
    {
        foreach ($this->getProperties() as $property) {
            $this->assertTrue(method_exists($this->post, 'get'.ucfirst($property->name)));
        }
    }

    private function getProperties()
    {
        $reflection = new \ReflectionClass($this->post);
        return $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);
    }
}
