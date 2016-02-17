<?php

include_once "models/Table.class.php";

class Blog_Entry_Table extends Table
{
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
        $sql = "SELECT entry_id,entry_title, SUBSTRING(entry_text,1,150) AS intro FROM simple_blog.blog_entry  ";
        $sql .= "ORDER BY date_created DESC";
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
        $this->deleteCommentsByID($id);
        $sql = "DELETE FROM simple_blog.blog_entry WHERE entry_id = ?";
        $data = array($id);
        $statement = $this->makeStatement($sql, $data);
    }

    private function deleteCommentsByID($id)
    {
        include_once "models/Comment_Table.class.php";
        $comments = new Comment_Table($this->db);
        $comments->deleteByEntryId($id);
    }

    public function searchEntry($searchTerm)
    {
        $sql = "SELECT entry_id, entry_title FROM simple_blog.blog_entry WHERE entry_title LIKE ? OR entry_text LIKE ?";
        $data = array("%$searchTerm%", "%$searchTerm%");
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }

}
