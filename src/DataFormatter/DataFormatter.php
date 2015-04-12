<?php
namespace NtaCamp\SocialHashtag\DataFormatter;

use NtaCamp\SocialHashtag\Post;

interface DataFormatter
{
    /**
     * @param $data
     * @return Post[]
     */
    public function format($data);
}
