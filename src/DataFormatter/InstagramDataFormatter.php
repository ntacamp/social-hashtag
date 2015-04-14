<?php

namespace NtaCamp\SocialHashtag\DataFormatter;

use Instagram\Media;
use NtaCamp\SocialHashtag\Post;

class InstagramDataFormatter implements DataFormatter
{

    /**
     * @param $data
     * @return Post[]
     */
    public function format($data)
    {
        $result = [];

        if (!$data) {
            return $result;
        }

        /** @var Media $media */
        foreach ($data as $media) {
            $post = new Post();
            $post->setUsername($media->getUser()->getUserName());
            $post->setProfileImageUrl($media->getUser()->getProfilePicture());
            $post->setContent($media->getCaption()->getText());
            $post->setHashtags($media->getTags()->toArray());
            $post->setDate(\DateTime::createFromFormat('U', $media->getCreatedTime()));

            $result[] = $post;
        }

        return $result;
    }
}
