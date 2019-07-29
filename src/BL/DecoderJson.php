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
    //get json notes
    public function getNoteWithFile($file)
    {
        $string = file_get_contents($file);
        $json_note = json_decode($string, true);
        return $json_note;
    }

    //put json note
    public function AddNoteWithFile($file, $note){
        $noteList = $this->getNoteWithFile($file);
        $noteList[] = $note;

        file_put_contents($file,json_encode($noteList));
        unset($noteList);
    }



}