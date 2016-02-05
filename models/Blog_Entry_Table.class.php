<?php

class Blog_Entry_Table
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function saveEntry($title, $entry)
    {
        $sql = "INSERT INTO simple_blog.blog_entry(entry_title,entry_text) VALUES ('$title','$entry')";
        $data = array($title, $entry);
        $this->makeStatement($sql, $data);
        return $this->db->lastInsertId();
    }

    // read
    public function getAllEntries()
    {
        $sql = "SELECT entry_id,entry_title, SUBSTRING(entry_text,1,150) AS intro FROM simple_blog.blog_entry";
        $statement = $this->db->prepare($sql);

        $statement = $this->makeStatement($sql);

        return $statement;
    }

    public function getEntry($id)
    {
        $sql = "SELECT entry_id, entry_title, entry_text, date_created  FROM simple_blog.blog_entry WHERE entry_id=?";
        $statement = $this->db->prepare($sql);
        $data = array($id);
        $statement = $this->makeStatement($sql, $data);
        $model = $statement->fetchObject();
        return $model;
    }

    public function updateEntry($id, $title, $entry)
    {
        $sql = "UPDATE simple_blog.blog_entry SET entry_title = ?, entry_text = ? WHERE entry_id = ?";
        $data = array($title, $entry, $id);
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }

    public function deleteEntry($id)
    {
        $sql = "DELETE FROM simple_blog.blog_entry WHERE entry_id = ?";
        $data = array($id);
        $statement = $this->makeStatement($sql, $data);
    }

    public function makeStatement($sql, $data = NULL)
    {
        $statement = $this->db->prepare($sql);
        try {
            //usethedynamicdataandrunthequery
            $statement->execute($data);

        } catch
        (Exception $e) {
            $exceptionMessage = "<p>You tried to run this sql: $sql <p>  <p> Exception:$e </p> ";
            trigger_error($exceptionMessage);
        }

        return $statement;
    }
}
