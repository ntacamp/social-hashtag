<?php
namespace NtaCamp\SocialHashtag;

use NtaCamp\SocialHashtag\Feed\Feed;

class SocialHashtag
{
    /** @var  String */
    private $hashtag;

    /** @var  Feed[] */
    private $feeds = [];

    /**
     * @param String $hashtag
     */
    public function __construct($hashtag)
    {
        $this->hashtag = $hashtag;
    }

    /**
     * @param Feed $feed
     */
    public function addFeed(Feed $feed)
    {
        array_push($this->feeds, $feed);
    }

    /**
     * @return Feed[]
     */
    public function getFeeds()
    {
        return $this->feeds;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        $results = [];
        foreach ($this->feeds as $feed) {
            $results[$feed->getName()] = $feed->getByHash($this->hashtag);
        }

        return $results;
    }
}
