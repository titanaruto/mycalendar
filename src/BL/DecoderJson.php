<?php


/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 08.10.2018
 * Time: 1:44
 * class decodes json and inserts data into the database
 */
class DecoderJson
{

    public function getNoteWithFile($file)
    {
        $string = file_get_contents($file);
        $json_note = json_decode($string, true);
        return $json_note;
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


}