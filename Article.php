<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 14/01/2018
 * Time: 10:23
 */

class Article
{
    protected $id;
    protected $content;
    protected $title;

    public function __construct($data)
    {
        $this->id = $data["id"];
        $this->content = $data["content"];
        $this->title = $data["title"];

    }
    /* getters*/
    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return strtoupper( $this->content);
    }
    public function getTitle()
    {
        return $this->title;
    }

    /*setters*/
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }


}