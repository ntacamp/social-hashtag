<?php

namespace NtaCamp\SocialHashtag\Tests\Integration;

use Instagram\Instagram;
use NtaCamp\SocialHashtag\DataFormatter\InstagramDataFormatter;
use NtaCamp\SocialHashtag\Feed\InstagramFeed;
use NtaCamp\SocialHashtag\SocialHashtag;

class InstagramHashtagsTest extends \PHPUnit_Framework_TestCase
{
    public function testResults()
    {
        $socialHashtag = $this->getSocialHashtag('nintendo');
        $results = $socialHashtag->getResults();

        $this->assertArrayHasKey(0, $results['instagram']);
        $this->assertArrayHasKey(1, $results['instagram']);
    }

    public function testOneResult()
    {
        $socialHashtag = $this->getSocialHashtag('nušalaurankas');

        $results = $socialHashtag->getResults();

        $this->assertArrayHasKey(0, $results['instagram']);
        $this->assertArrayNotHasKey(1, $results['instagram']);
    }

    public function testEmptyResults()
    {
        $socialHashtag = $this->getSocialHashtag('igfdjg493t394234skvjxlvj32e234>');
        $results = $socialHashtag->getResults();

        $this->assertNull($results['instagram']);
    }

    private function getSocialHashtag($tag)
    {
        $socialHashtag = new SocialHashtag($tag);
        $instagram = new Instagram();
        $instagram->setClientID(INSTAGRAM_CLIENT_ID);
        $socialHashtag->addFeed(new InstagramFeed($instagram, new InstagramDataFormatter()));

        return $socialHashtag;
    }
}
