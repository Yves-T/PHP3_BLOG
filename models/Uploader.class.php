<?php

class Uploader
{
    private $fileName;
    private $fileData;
    private $destination;

    /**
     * Uploader constructor.
     */
    public function __construct($key)
    {
        $this->fileName = $_FILES[$key]['name'];
        $this->fileData = $_FILES[$key]['tmp_name'];
    }

    public function saveIn($folder)
    {
        $this->destination = $folder;
    }

    public function save()
    {
        $folerIsWritable = is_writable($this->destination);
        if ($folerIsWritable) {
            $name = "$this->destination/$this->fileName";
            $success = move_uploaded_file($this->fileData, $name);
        } else {
            trigger_error("Cannot write to $this->destination");
            $success = false;
        }
        return $success;
    }
}
