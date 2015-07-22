<?php

namespace NtaCamp\SocialHashtag\DataFormatter;

use Instagram\Media;
use NtaCamp\SocialHashtag\Post;

class InstagramDataFormatter implements DataFormatter
{
    const INSTAGRAM_URL = 'https://instagram.com/';

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
            $post->setUserUrl(self::INSTAGRAM_URL.$media->getUser()->getUserName());
            $post->setUrl($media->getData()->link);
            $post->setContent($media->getCaption()->getText());
            $post->setHashtags($media->getTags()->toArray());
            $post->setDate(\DateTime::createFromFormat('U', $media->getCreatedTime()));
            if (isset($media->getData()->videos)) {
                $post->setMedia($media->getStandardResVideo());
                $post->getMedia()->type = 'video';
            } else {
                $post->setMedia($media->getStandardResImage());
                $post->getMedia()->type = 'image';
            }

            $result[] = $post;
        }

        return $result;
    }
}
