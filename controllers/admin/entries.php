<?php

// model
include_once 'models/Blog_Entry_Table.class.php';
$entryTable = new Blog_Entry_Table($db);
$allEntries = $entryTable->getAllEntries();
//$oneEntry   = $allEntries->fetchObject();
//$testOutput = print_r($oneEntry, true);
//return "<pre>$testOutput</pre>";
// view

$entriesAsHTML = include_once "views/admin/entries-html.php";

// hooking up model and view
return $entriesAsHTML;
