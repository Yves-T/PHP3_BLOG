<?php
// model
include_once "models/Blog_Entry_Table.class.php";
$entryTable = new Blog_Entry_Table($db);

$editorSubmitted = isset($_POST ['action']);
if ($editorSubmitted) {
    $buttonClicked = $_POST['action'];
    $save = ($buttonClicked === 'Save');
    $id = $_POST['id'];
    $title = $_POST ['title'];
    $entry = $_POST ['entry'];

    $insertNewEntry = ($save && $id === '0');
    $deleteEntry = ($buttonClicked === 'Delete');
    $updateEntry = ($save && $insertNewEntry === false);

    if ($insertNewEntry) {
        $saveEntryId = $entryTable->saveEntry($title, $entry);
    } elseif ($updateEntry) {
        $entryTable->updateEntry($id, $title, $entry);
        $saveEntryId = $id;
    } elseif ($deleteEntry) {
        $entryTable->deleteEntry($id);
    }
}

// view
$entryRequested = isset($_GET ['id']);
if ($entryRequested) {
    $id = $_GET['id'];
    $entryData = $entryTable->getEntry($id);
    $entryData->entry_id = $id;
    $entryData->message = "";
}

$entrySaved = isset($saveEntryId);
if ($entrySaved) {
    $entryData = $entryTable->getEntry($saveEntryId);
    $entryData->message = "Entry was saved";
}
$editorOutput = include_once "views/admin/editor_html.php";

// view aan model
return $editorOutput;
