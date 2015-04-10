<?php

namespace NtaCamp\SocialHashtag;

interface Feed
{
    public function getByHash($hashtag, $options);
}
