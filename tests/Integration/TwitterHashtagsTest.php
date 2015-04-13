<?php
namespace NtaCamp\SocialHashtag\Tests\Integration;

use NtaCamp\SocialHashtag\DataFormatter\TwitterDataFormatter;
use NtaCamp\SocialHashtag\SocialHashtag;
use NtaCamp\SocialHashtag\Feed\TwitterFeed;

class TwitterHashtagsTest extends \PHPUnit_Framework_TestCase
{
    public function testResults()
    {
        $socialHashtag = new SocialHashtag('love');
        $socialHashtag->addFeed(new TwitterFeed(new \TwitterAPIExchange([
            'oauth_access_token' => TWITTER_OAUTH_ACCESS_TOKEN,
            'oauth_access_token_secret' => TWITTER_OAUTH_ACCESS_TOKEN_SECRET,
            'consumer_key' => TWITTER_CONSUMER_KEY,
            'consumer_secret' => TWITTER_CONSUMER_SECRET,
        ]), new TwitterDataFormatter()));

        $results = $socialHashtag->getResults();

        $this->assertArrayHasKey(0, $results['twitter']);
        $this->assertArrayHasKey(1, $results['twitter']);
    }
}
