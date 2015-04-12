<?php
namespace NtaCamp\SocialHashtag\DataFormatter;

use NtaCamp\SocialHashtag\Post;

class TwitterDataFormatter implements DataFormatter
{
    /**
     * @param $data
     * @return Post[]
     */
    public function format($data)
    {
        $result = [];

        foreach ($data->statuses as $status) {
            $post = new Post();
            $post->setUsername($status->user->name);
            $post->setContent($status->text);
            $post->setHashtags($status->entities->hashtags);
            $post->setDate($status->created_at);
            $post->setProfileImageUrl($status->user->profile_image_url);
            array_push($result, $post);
        }

        return $result;
    }
}
