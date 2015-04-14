<?php
namespace NtaCamp\SocialHashtag\Tests\Integration;

use NtaCamp\SocialHashtag\DataFormatter\TwitterDataFormatter;
use NtaCamp\SocialHashtag\SocialHashtag;
use NtaCamp\SocialHashtag\Feed\TwitterFeed;

class TwitterHashtagsTest extends \PHPUnit_Framework_TestCase
{
    public function testResults()
    {
        $results = $this->getSocialHashtag('love')->getResults();

        $this->assertArrayHasKey(0, $results['twitter']);
        $this->assertArrayHasKey(1, $results['twitter']);
    }

    public function testEmptyResults()
    {
        $results = $this->getSocialHashtag('53dadfe8aaceaa795e8757bdc77b1ecb')->getResults();
        var_dump($results);
    }

    public function getSocialHashtag($tag)
    {
        $socialHashtag = new SocialHashtag($tag);
        $socialHashtag->addFeed(new TwitterFeed(new \TwitterAPIExchange([
            'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
            'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
            'consumer_key' => TWITTER_CONSUMER_KEY,
            'consumer_secret' => TWITTER_CONSUMER_SECRET,
        ]), new TwitterDataFormatter()));

        return $socialHashtag;
    }
}
