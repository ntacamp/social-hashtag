<?php
namespace NtaCamp\SocialHashtag;

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

    public function addFeed(Feed $feed)
    {
        array_push($this->feeds, $feed);
    }

    public function getFeeds()
    {
        return $this->feeds;
    }

    public function getResults()
    {
        $results = [];
        foreach ($this->feeds as $feed) {
            $results[$feed->getName()] = $feed->getByHash($this->hashtag);
        }

        return $results;
    }
}
