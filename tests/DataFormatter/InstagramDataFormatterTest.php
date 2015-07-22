<?php

namespace NtaCamp\SocialHashtag\Tests\DataFormatter;

use Instagram\Collection\MediaCollection;
use Instagram\Collection\TagCollection;
use Instagram\Comment;
use Instagram\Media;
use NtaCamp\SocialHashtag\DataFormatter\InstagramDataFormatter;
use phpDocumentor\Reflection\DocBlock\Tag\SeeTag;

class InstagramDataFormatterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  InstagramDataFormatter */
    private $formatter;

    public function setUp()
    {
        $this->formatter = new InstagramDataFormatter();
    }

    public function testFormat()
    {
        $data = new \StdClass();

        $userData = (object) [
            'username' => 'Mario',
            'profile_picture' => 'http://goo.gl/UQqqEU'
        ];
        $captionData = (object) ['text' => 'hey Nintendo fans ! #nintendo'];
        $tagsData = ['nintendo'];

        $data->caption = new Comment($captionData);
        $data->user = $userData;
        $data->tags = new TagCollection($tagsData);
        $data->created_time = '1429032159'; // unix timestamp
        $data->images =  (object)['standard_resolution' => new \StdClass()];
        $data->images->standard_resolution = new \StdClass();
        $data->images->standard_resolution->url = 'url';

        $media = new Media($data);

        $results = $this->formatter->format([$media]);

        $this->assertSame('Mario', current($results)->getUsername());
        $this->assertSame('http://goo.gl/UQqqEU', current($results)->getProfileImageUrl());
        $this->assertSame('hey Nintendo fans ! #nintendo', current($results)->getContent());
        $this->assertSame('nintendo', current($results)->getHashtags()[0]);
        $this->assertSame('url', current($results)->getMedia()->url);
        $this->assertInstanceOf('\DateTime', current($results)->getDate());
    }

    public function testEmptyFormat()
    {
        $this->assertEmpty($this->formatter->format(null));
    }
}
