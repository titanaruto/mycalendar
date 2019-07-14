<?php

require 'lib/Db.php';
require 'DomainObj/Article.php';
require 'DomainObj/Channels.php';
require 'DomainObj/Comments.php';
require 'DomainObj/Tags.php';
require 'DomainObj/Lang.php';
require 'DecoderJsonInsertDB.php';

class DataMapper
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
        //decodes json and inserts data into the database
        $DecoderJsonInsertDB = new DecoderJsonInsertDB();
        $DecoderJsonInsertDB->insertArticle("test.json");
    }

    //Fills the class object Article
    private function fillFromRowArticle($row)
    {
        $article = new Article();
        if (empty ($row))
            return $article;

        $article->ID = $row['ID'];
        $article->title = $row['title'];
        $article->channelsID = $row['channelsID'];
        $article->tagsID = $row['tagsID'];
        $article->langID = $row['langID'];
        $article->description = $row['description'];
        $article->link = $row['link'];
        $article->commentsID = $row['commentsID'];
        $article->image = $row['image'];
        $article->publishDate = $row['publishDate'];

        return $article;
    }

    //Fills the class object Channels
    private function fillFromRowChannels($row)
    {
        $channels = new Channels();
        if (empty ($row))
            return $channels;

        $channels->ID = $row['ID'];
        $channels->name = $row['name'];

        return $channels;
    }

    //Fills the class object Tags
    private function fillFromRowTags($row)
    {
        $tags = new Tags();
        if (empty ($row))
            return $tags;

        $tags->ID = $row['ID'];
        $tags->name = $row['name'];

        return $tags;
    }

    //Fills the class object Comments
    private function fillFromRowComments($row)
    {
        $comments = new Comments();
        if (empty ($row))
            return $comments;

        $comments->ID = $row['ID'];
        $comments->name = $row['name'];
        $comments->email = $row['email'];
        $comments->description = $row['description'];

        return $comments;
    }

    // get all article
    public function getAllArticle()
    {
        $result = $this->db->row('SELECT *  FROM article');
        if (empty ($result))
            return $result;

        $array = array();
        foreach ($result as $row) {
            $c = $this->fillFromRowArticle($row);
            $array [] = $c;
        }

        return $array;

    }

    //get one article
    public function getArticle($name, $ID)
    {

        $result = $this->db->row("SELECT * FROM `article`  WHERE $name LIKE '%$ID%'");

        if (empty ($result))
            return $result;

        $array = array();
        foreach ($result as $row) {
            $c = $this->fillFromRowArticle($row);
            $array [] = $c;
        }

        return $array;
    }

    //get all Channels
    public function getAllChannels($ID)
    {
        $result = $this->db->row('SELECT * FROM `channels` WHERE ID IN(' . $ID . ')');
        if (empty ($result))
            return $result;

        $array = array();
        foreach ($result as $row) {
            $c = $this->fillFromRowChannels($row);
            $array [] = $c;
        }

        return $array;
    }

    //get all Tags
    public function getAllTags($ID)
    {
        $result = $this->db->row('SELECT * FROM `tags` WHERE ID IN(' . $ID . ')');
        if (empty ($result))
            return $result;

        $array = array();
        foreach ($result as $row) {
            $c = $this->fillFromRowTags($row);
            $array [] = $c;
        }

        return $array;
    }

    //update article commentID
    public function updateArticleCommentId($commentsID, $articleID)
    {
        $this->db->query("UPDATE `article` SET `commentsID`= '" . $commentsID . "' WHERE `ID`=" . $articleID);
    }

    //get all Comments
    public function getAllComments($ID)
    {
        $result = $this->db->row('SELECT * FROM `comments` WHERE ID IN(' . $ID . ')');
        if (empty ($result))
            return $result;

        $array = array();
        foreach ($result as $row) {
            $c = $this->fillFromRowComments($row);
            $array [] = $c;
        }

        return $array;
    }

    //insert Comment
    public function insertComment($array)
    {
        if (!empty($array)) {
            $this->db->query("INSERT INTO `comments`(  `name`,  `email`, `description`) VALUES ( :name, :email, :description)",
                ['name' => $array['name'], 'email' => $array['email'], 'description' => $array['description']]);
            $id = $this->db->insertLastId();
        }
        return $id;
    }
}