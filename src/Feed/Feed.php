<?php

namespace NtaCamp\SocialHashtag\Feed;

interface Feed
{
    public function getByHash($hashtag);
    public function getName();
}
