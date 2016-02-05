<?php
$entryDataFound = isset ($entryData);
if ($entryDataFound === false) {
    trigger_error('views/entry‐html.phpneedsan$entryDataobject');
}

return "<article>
 <h1> $entryData->entry_title </h1>  <div class='date' > $entryData->date_created </div> $entryData->entry_text
</article> ";
