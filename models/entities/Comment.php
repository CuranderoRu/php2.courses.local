<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 29.04.2018
 * Time: 21:22
 */

namespace app\models\entities;


use app\models\DataEntity;

class Comment extends DataEntity
{
    private $item;
    private $comment_date;
    private $comment_name;
    private $comment;

    public function __construct($item = null, $comment_date = null, $comment_name = null, $comment = null)
    {
        $this->item = $item;
        $this->comment_date = $comment_date;
        $this->comment_name = $comment_name;
        $this->comment = $comment;
    }



    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->item;
    }


    /**
     * @return mixed
     */
    public function getCommentDate()
    {
        return $this->comment_date;
    }


    /**
     * @return mixed
     */
    public function getCommentName()
    {
        return $this->comment_name;
    }


    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

}