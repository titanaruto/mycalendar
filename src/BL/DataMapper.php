<?php

require 'DomainObj/Note.php';
require 'DecoderJson.php';

class DataMapper
{
    private $file;
    private $notes;
    private $DecoderJsonInsertDB;

    public function __construct()
    {
        $this->DecoderJsonInsertDB = new DecoderJson();
        $this->file = "notes/notes.json";
        $this->notes = $this->DecoderJsonInsertDB->getNoteWithFile($this->file);
    }

    //Fills the class object Note
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


    // get all note
    public function getAllNote()
    {
        $result = $this->notes;
        if (empty ($result))
            return $result;

        $array = array();
        foreach ($result as $row) {
            $c = $this->fillFromRowNote($row);
            $array [] = $c;
        }

        return $array;

    }
    // add note
    public function AddNote($date, $description)
    {
        $notes = $this->notes;
        $count = count($notes);
        $ID = $count + 1;
        $note = array("ID" => $ID, "DATE" => $date, "DESCRIPTION" => $description);
        $this->DecoderJsonInsertDB->AddNoteWithFile($this->file, $note);
        return true;
    }


}