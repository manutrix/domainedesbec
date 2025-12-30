<?php

echo <<<HEREDOC
<div class='cg_view_container'>
HEREDOC;

echo <<<HEREDOC
<div class='cg_view_options_rows_container'>
         <p class='cg_view_options_rows_container_title'>Translations here will replace language files translations.</p>
</div>
HEREDOC;

include(__DIR__.'/translations-options/translations-gallery-upload.php');
include(__DIR__.'/translations-options/translations-gallery.php');
include(__DIR__.'/translations-options/translations-user-gallery.php');
include(__DIR__.'/translations-options/translations-comment.php');
include(__DIR__.'/translations-options/translations-upload-registry.php');
include(__DIR__.'/translations-options/translations-login.php');

echo <<<HEREDOC
</div>
HEREDOC;


