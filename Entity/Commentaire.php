<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 21/01/2018
 * Time: 13:07
 */

class Commentaire
{
    protected $comment;
    protected $post_id;
    protected $author;

    /**
     * Commentaire constructor.
     * @param $comment
     * @param $post_id
     * @param $author
     */
    public function __construct($tab)
    {
        $this->comment = $tab['comment'];
        $this->post_id = $tab['post_id'];
        $this->author = $tab['author'];
    }


    public function getComment()
    {
        return $this->comment;
    }


    public function setComment($comment)
    {
        $this->comment = $comment;
    }


    public function getPostId()
    {
        return $this->post_id;
    }


    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }


    public function getAuthor()
    {
        return $this->author;
    }


    public function setAuthor($author)
    {
        $this->author = $author;
    }






}