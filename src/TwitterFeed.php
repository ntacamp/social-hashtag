<?php

namespace NtaCamp\SocialHashtag;

class TwitterFeed implements Feed
{
    const URL = 'https://api.twitter.com/1.1/search/tweets.json';
    const METHOD = 'GET';
    /**
     * @var \TwitterAPIExchange
     */
    private $client;

    public static function create($settings)
    {
        return new self(new \TwitterAPIExchange($settings));
    }

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function getByHash($hashtag, $options)
    {
        $this->client->setGetfield($hashtag);
        $this->client->buildOauth(self::URL, self::METHOD);

        return $this->client->performRequest();
    }
}