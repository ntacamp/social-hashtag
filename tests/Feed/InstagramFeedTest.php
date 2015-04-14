<?php

namespace NtaCamp\SocialHashtag\Tests\Feed;

use NtaCamp\SocialHashtag\Feed\InstagramFeed;
use NtaCamp\SocialHashtag\Post;

class InstagramFeedTest extends \PHPUnit_Framework_TestCase
{
    /** @var  InstagramFeed */
    private $feed;

    private $formatter;

    public function setUp()
    {
        $api = $this->getMockBuilder('Instagram\Instagram')
            ->disableOriginalConstructor()
            ->getMock();

        $collection = $this->getMock('Instagram\Collection\TagCollection');
        $collection->expects($this->any())
            ->method('getData')
            ->will($this->returnValue(new \StdClass()));

        $api->expects($this->any())
            ->method('searchTags')
            ->will($this->returnValue($collection));

        $formatter = $this->getMock('\NtaCamp\SocialHashtag\DataFormatter\InstagramDataFormatter');
        $this->formatter = $formatter;

        $this->feed = new InstagramFeed($api, $formatter);
    }

    public function testGetName()
    {
        $this->assertSame('instagram', $this->feed->getName());
    }

    public function testGetByHash()
    {
        $this->formatter->expects($this->once())->method('format')->will($this->returnValue([new Post()]));
        $this->assertInstanceOf('\NtaCamp\SocialHashtag\Post', current($this->feed->getByHash('love')));
    }
}
