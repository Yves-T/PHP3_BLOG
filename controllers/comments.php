<?php
//include class definition
include_once "models/Comment_Table.class.php";
//create a new object, pass it a PDO database connection object
$commentTable = new Comment_Table($db);
$comments = include_once "views/comment_form_html.php";

$allComments = $commentTable->getAllById($entryId);
$comments .= include_once "views/comments_html.php";

// hooking up view and model
return $comments;
