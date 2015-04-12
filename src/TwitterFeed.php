<?php

namespace NtaCamp\SocialHashtag;

use NtaCamp\SocialHashtag\DataFormatter\DataFormatter;
use TwitterAPIExchange;

class TwitterFeed implements Feed
{
    const URL = 'https://api.twitter.com/1.1/search/tweets.json';
    const METHOD = 'GET';

    /** @var  TwitterApiExchange */
    private $client;

    /** @var  DataFormatter */
    private $formatter;

    public function __construct($client, $formatter)
    {
        $this->client = $client;
        $this->formatter = $formatter;
    }

    /**
     * @param $hashtag
     * @return array
     * @throws \Exception
     */
    public function getByHash($hashtag)
    {
        $this->client->setGetfield('?q=#'.$hashtag);
        $this->client->buildOauth(self::URL, self::METHOD);

        return $this->formatter->formatData($this->client->performRequest());
    }

    public function getName()
    {
        return 'twitter';
    }
}
