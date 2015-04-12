<?php
namespace NtaCamp\SocialHashtag;

class Post
{
    /** @var  String */
    private $username;

    /** @var  String */
    private $content;

    /** @var  Array */
    private $hashtags;

    /** @var  String */
    private $profileImageUrl;

    /** @var  String */
    private $date;

    /**
     * @return String
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param String $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return String
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param String $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return Array
     */
    public function getHashtags()
    {
        return $this->hashtags;
    }

    /**
     * @param Array $hashtags
     */
    public function setHashtags($hashtags)
    {
        $this->hashtags = $hashtags;
    }

    /**
     * @return String
     */
    public function getProfileImageUrl()
    {
        return $this->profileImageUrl;
    }

    /**
     * @param String $profileImageUrl
     */
    public function setProfileImageUrl($profileImageUrl)
    {
        $this->profileImageUrl = $profileImageUrl;
    }

    /**
     * @return String
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param String $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}
