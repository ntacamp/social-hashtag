<?php

namespace NtaCamp\SocialHashtag\Tests;

use NtaCamp\SocialHashtag\SocialHashtag;

class SocialHashtagTest extends \PHPUnit_Framework_TestCase
{
    /** @var  SocialHashtag */
    private $socialHashtag;

    public function setUp()
    {
        $this->socialHashtag = new SocialHashtag('love');
    }

    public function testFeedAddition()
    {
        $feed = $this->getMock('NtaCamp\SocialHashtag\Feed\Feed');
        $this->socialHashtag->addFeed($feed);

        $this->assertInstanceOf('NtaCamp\SocialHashtag\Feed\Feed', current($this->socialHashtag->getFeeds()));
    }

    public function testGetResults()
    {
        $feed = $this->getMock('NtaCamp\SocialHashtag\Feed\Feed');
        $post = $this->getMock('NtaCamp\SocialHashtag\Post');
        $feed->expects($this->once())->method('getName')->will($this->returnValue('feed'));
        $feed->expects($this->once())->method('getByHash')->will($this->returnValue([$post]));
        $this->socialHashtag->addFeed($feed);

        $results = $this->socialHashtag->getResults();
        $this->assertArrayHasKey('feed', $results);
        $this->assertInstanceOf('NtaCamp\SocialHashtag\Post', current($results['feed']));
    }
}
