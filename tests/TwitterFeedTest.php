<?php

namespace NtaCamp\SocialHashtag\Tests;

use NtaCamp\SocialHashtag\Post;
use NtaCamp\SocialHashtag\TwitterFeed;

class TwitterFeedTest extends \PHPUnit_Framework_TestCase
{
    /** @var  TwitterFeed */
    private $feed;

    private $formatter;

    public function setUp()
    {
        $api = $this->getMockBuilder('TwitterApiExchange')
            ->disableOriginalConstructor()
            ->getMock();
        $formatter = $this->getMock('\NtaCamp\SocialHashtag\DataFormatter\TwitterDataFormatter');
        $this->formatter = $formatter;

        $this->feed = new TwitterFeed($api, $formatter);
    }

    public function testGetName()
    {
        $this->assertSame('twitter', $this->feed->getName());
    }

    public function testGetByHash()
    {
        $this->formatter->expects($this->once())->method('format')->will($this->returnValue([new Post()]));
        $this->assertInstanceOf('\NtaCamp\SocialHashtag\Post', current($this->feed->getByHash('love')));
    }
}
