<?php

namespace NtaCamp\SocialHashtag\Feed;

use Instagram\Instagram;
use NtaCamp\SocialHashtag\DataFormatter\DataFormatter;

class InstagramFeed implements Feed
{
    /** @var Instagram  */
    private $client;

    /** @var DataFormatter */
    private $formatter;

    public function __construct(Instagram $client, DataFormatter $formatter)
    {
        $this->client = $client;
        $this->formatter = $formatter;
    }

    public function getByHash($hashtag)
    {
        if ($data = current($this->client->searchTags($hashtag)->getData())) {
            $data = $data->getMedia()->getData();
        }

        return $this->formatter->format($data);
    }

    public function getName()
    {
        return 'instagram';
    }
}
