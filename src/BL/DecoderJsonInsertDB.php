<?php


/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 08.10.2018
 * Time: 1:44
 * class decodes json and inserts data into the database
 */
class DecoderJsonInsertDB
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }

    public function insertArticle($file)
    {
        $string = file_get_contents($file);
        $json_article = json_decode($string, true);

        for ($i = 0; $i < count($json_article); $i++) {
            $oneArticle = $json_article[$i];

            $ID = $this->db->column('SELECT ID FROM `article` WHERE `ID` = :ID', ['ID' => $oneArticle['ID']]);
            if (empty($ID)) {
                $articleID = $oneArticle['ID'];
                $articleTitle = $oneArticle['Title'];

                $this->insertChannels($oneArticle['Channels']);
                $articleChannelsID = $this->jsonParsing($oneArticle['Channels']);

                $this->insertTags($oneArticle['Tags']);
                $articleTagsID = $this->jsonParsing($oneArticle['Tags']);

                $this->insertLang($oneArticle['Lang']);
                $articleLangID = $oneArticle['Lang']['ID'];

                $articleDescription = $oneArticle['Description'];
                $articleLink = $oneArticle['Link'];
                $articleImage = $oneArticle['Image'];
                $articlePublishDate = $oneArticle['PublishDate'];

                $this->db->query("INSERT INTO `article`(`ID`, `title`, `channelsID`, `tagsID`, `langID`, `description`, `link`,  `commentsID`, `image`, `publishDate`)
                                                          VALUES (:ID , :title , :channelsID , :tagsID , :langID , :description , :link , :commentsID,  :image , :publishDate)",
                    ['ID' => $articleID, 'title' => $articleTitle, 'channelsID' => $articleChannelsID, 'tagsID' => $articleTagsID,
                        'langID' => $articleLangID, 'description' => $articleDescription, 'link' => $articleLink,
                        'commentsID' => 0, 'image' => $articleImage, 'publishDate' => $articlePublishDate]);
            }


        }
    }

    /** function jsonParsing
     * gets all ID from array
     **/
    private function jsonParsing($array)
    {
        if (!isset($array[0]["ID"])) {
            return $array["ID"];
        } else {
            $result = "";
            for ($i = 0; $i < count($array); $i++) {
                $result .= $array[$i]["ID"] . ',';
            }
            return rtrim($result, ',');
        }
    }

    private function insertChannels($array)
    {

        for ($i = 0; $i < count($array); $i++) {
            $ID = $this->db->column('SELECT ID FROM `channels` WHERE `ID` = :ID', ['ID' => $array[$i]['ID']]);
            if (empty($ID)) {
                $this->db->query("INSERT INTO `channels`( `ID`, `name`) VALUES (:ID, :name)", ['ID' => $array[$i]['ID'], 'name' => $array[$i]['Name']]);
            }
        }
    }

    private function insertTags($array)
    {

        for ($i = 0; $i < count($array); $i++) {
            $ID = $this->db->column('SELECT ID FROM `tags` WHERE `ID` = :ID', ['ID' => $array[$i]['ID']]);
            if (empty($ID)) {
                $this->db->query("INSERT INTO `tags`( `ID`, `name`) VALUES (:ID, :name)", ['ID' => $array[$i]['ID'], 'name' => $array[$i]['Name']]);
            }
        }
    }

    private function insertLang($array)
    {
        $ID = $this->db->column('SELECT ID FROM `lang` WHERE `ID` = :ID', ['ID' => $array['ID']]);
        if (empty($ID)) {
            $this->db->query("INSERT INTO `lang`( `ID`, `name`, `code`) VALUES (:ID, :name, :code)", ['ID' => $array['ID'], 'name' => $array['Name'], 'code' => $array['Code']]);
        }
    }


}