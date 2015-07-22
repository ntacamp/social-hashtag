<?php
namespace NtaCamp\SocialHashtag\DataFormatter;

use NtaCamp\SocialHashtag\Post;

class TwitterDataFormatter implements DataFormatter
{
    const TWITTER_URL = 'https://twitter.com/';

    private $options = [
        'includeRetweets' => true
    ];

    public function __construct($options = [])
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @param $data
     * @return Post[]
     */
    public function format($data)
    {
        $result = [];

        if (is_object($data) && property_exists($data, 'statuses')) {
            foreach ($data->statuses as $status) {
                if (! $this->options['includeRetweets'] && property_exists($status, 'retweeted_status')) {
                    continue;
                }
                $post = new Post();
                $post->setUsername($status->user->name);
                $post->setUserUrl(self::TWITTER_URL.$status->user->screen_name);
                $post->setUrl(self::TWITTER_URL.$status->user->screen_name.'/status/'.$status->id);
                $post->setContent($status->text);
                $post->setHashtags($status->entities->hashtags);
                $post->setDate(new \DateTime($status->created_at));
                $post->setProfileImageUrl($status->user->profile_image_url);

                $result[] = $post;
            }
        }

        return $result;
    }
}
