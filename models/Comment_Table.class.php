<?php
include_once "models/Table.class.php";

class Comment_Table extends Table
{
    // create
    public function saveComment($entryId, $author, $txt)
    {
        $sql = "INSERT INTO simple_blog.comment (entry_id, author, txt) VALUES (?, ?, ?)";
        $data = array($entryId, $author, $txt);
        $statement = $this->makeStatement($sql, $data);
        return $statement;
    }
}
