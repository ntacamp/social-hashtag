<?php

namespace NtaCamp\SocialHashtag\Tests\DataFormatter;

use NtaCamp\SocialHashtag\DataFormatter\TwitterDataFormatter;
use NtaCamp\SocialHashtag\Post;

class TwitterDataFormatterTest extends \PHPUnit_Framework_TestCase
{
    public function testFormat()
    {
        $formatter = new TwitterDataFormatter();

        $user = new \StdClass();
        $user->name = 'Homer J. Simpson';
        $user->profile_image_url = 'http://goo.gl/BLriQo';

        $entities = new \StdClass();
        $entities->hashtags = ['donuts', 'love'];

        $status = new \StdClass();
        $status->user = $user;
        $status->text = 'mmmm... #donuts #love';
        $status->created_at = 'Mon Apr 13 06:09:52 +0000 2015';
        $status->entities = $entities;

        $data = new \StdClass();
        $data->statuses = [$status];

        $formattedData = $formatter->format($data);
        /** @var Post $post */
        $post = current($formattedData);

        $this->assertInstanceOf('NtaCamp\SocialHashtag\Post', $post);
        $this->assertSame($post->getUsername(), 'Homer J. Simpson');
        $this->assertSame($post->getContent(), 'mmmm... #donuts #love');
        $this->assertSame($post->getProfileImageUrl(), 'http://goo.gl/BLriQo');
        $this->assertSame('love', $post->getHashtags()[1]);
        $this->assertSame($post->getDate()->format('Y-m-d H:i'), '2015-04-13 06:09');
    }
}
