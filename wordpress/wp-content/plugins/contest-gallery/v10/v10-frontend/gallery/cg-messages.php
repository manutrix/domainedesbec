<?php

$heredoc = <<<HEREDOC

<div id="cgMessagesContainer" class="cg_hide cg_messages_container $cgFeControlsStyle">
   <div id="cgMessagesDiv">
       <span id="cgMessagesClose">
   
        </span>
       <span id="cgMessagesContent">
            Photo contest ist over
        </span>
    </div>
</div>

HEREDOC;

echo $heredoc;

$heredoc = <<<HEREDOC

<div id="cgMessagesContainerPro" class="cg_hide cg_messages_container_pro $cgFeControlsStyle">
   <div id="cgMessagesDiv">
       <div id="cgMessagesCloseProContainer">
           <span id="cgMessagesClose">
            </span>
       </div>
       <span id="cgMessagesContent">
            Photo contest ist over
        </span>
    </div>
</div>

HEREDOC;

echo $heredoc;


?>