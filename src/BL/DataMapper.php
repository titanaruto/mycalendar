<?php

require 'DomainObj/Note.php';
require 'DecoderJson.php';

class DataMapper
{
    private $file;
    public function __construct()
    {
        //decodes json and inserts data into the database
        $DecoderJsonInsertDB = new DecoderJson();
        $this->file = $DecoderJsonInsertDB->getNoteWithFile("notes/notes.json");
    }

    //Fills the class object Article
    private function fillFromRowNote($row)
    {
        $note = new Note();
        if (empty ($row))
            return $note;

        $note->ID = $row['ID'];
        $note->date = $row['DATE'];
        $note->description = $row['DESCRIPTION'];

        return $note;
    }


    // get all article
    public function getAllNote()
    {
        $result = $this->file;
        if (empty ($result))
            return $result;

        $array = array();
        foreach ($result as $row) {
            $c = $this->fillFromRowNote($row);
            $array [] = $c;
        }

        return $array;

    }

    //get one article
    public function getNoteByID($ID)
    {

        $result = $this->file;

        if (empty ($result))
            return $result;

        $array = array();
        foreach ($result as $row) {
            $c = $this->fillFromRowNote($row);
            $array [] = $c;
        }

        return $array;
    }




}