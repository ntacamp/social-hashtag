<?php

namespace NtaCamp\SocialHashtag\Feed;

use NtaCamp\SocialHashtag\DataFormatter\DataFormatter;
use NtaCamp\SocialHashtag\Post;

class TwitterFeed implements Feed
{
    const URL = 'https://api.twitter.com/1.1/search/tweets.json';
    const METHOD = 'GET';

    /** @var  \TwitterApiExchange */
    private $client;

    /** @var  DataFormatter */
    private $formatter;

    /**
     * @param \TwitterApiExchange $client
     * @param DataFormatter $formatter
     */
    public function __construct(\TwitterAPIExchange $client, DataFormatter $formatter)
    {
        $this->client = $client;
        $this->formatter = $formatter;
    }

    /**
     * @param $hashtag
     * @return Post[]
     * @throws \Exception
     */
    public function getByHash($hashtag)
    {
        $this->client->setGetfield('?q=#'.$hashtag);
        $this->client->buildOauth(self::URL, self::METHOD);

        $response = json_decode($this->client->performRequest(true, array(CURLOPT_SSL_VERIFYPEER => false)));

        return $this->formatter->format($response);
    }

    public function getName()
    {
        return 'twitter';
    }
}
