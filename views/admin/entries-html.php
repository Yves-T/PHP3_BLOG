<?php
if (isset($allEntries) === false) {
    trigger_error('views/admin/entries-html.php needs $allEntries');
    exit();
}

$entriesAsHTML = '<ul>';
while  ($entry  = $allEntries->fetchObject() ) {
    $href  =  "admin.php?page=editor&amp;id=$entry->entry_id";
    $entriesAsHTML .=  "<li><a href='$href'>$entry->entry_title</a></li>";
}

// todo fix errors

$entriesAsHTML .= "</ul>";
return $entriesAsHTML;