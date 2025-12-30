<?php

echo <<<HEREDOC
<div class='cg_view_container'>
HEREDOC;

echo <<<HEREDOC
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_100_percent $cgProFalse" id="ForwardAfterLoginUrlCheckContainer">
                <div class="cg_view_option_title">
                    <p>Forward to another page after login</p>
                </div>
                <div class="cg_view_option_radio">
                    <input id='ForwardAfterLoginUrlCheck' type='radio' name='ForwardAfterLoginUrlCheck' $ForwardAfterLoginUrlCheck >
                </div>
            </div>
        </div>
HEREDOC;

echo <<<HEREDOC
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse" id="ForwardAfterLoginUrlContainer">
                <div class="cg_view_option_title">
                    <p>Forward to URL</p>
                </div>
                <div class="cg_view_option_input">
                    <input id="ForwardAfterLoginUrl" placeholder="$get_site_url" type="text" name="ForwardAfterLoginUrl" maxlength="999" value="$ForwardAfterLoginUrl"/>
                </div>
            </div>
        </div>
HEREDOC;


echo <<<HEREDOC
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_100_percent cg_border_top_none $cgProFalse" id="ForwardAfterLoginTextCheckContainer">
                <div class="cg_view_option_title">
                    <p>Confirmation text on same site after login</p>
                </div>
                <div class="cg_view_option_radio">
                    <input id='ForwardAfterLoginTextCheck' type='radio' class='$cgProFalse' name='ForwardAfterLoginTextCheck' $ForwardAfterLoginTextCheck >
                </div>
            </div>
        </div>
HEREDOC;


echo <<<HEREDOC
        <div class='cg_view_options_row'>
            <div class="cg_view_option cg_view_option_full_width cg_border_top_none $cgProFalse" id="wp-ForwardAfterLoginText-wrap-Container">
                <div class="cg_view_option_title">
                    <p>Confirmation Text after login</p>
                </div>
                <div class="cg_view_option_html">
                    <textarea class='cg-wp-editor-template' id='ForwardAfterLoginText'  name='ForwardAfterLoginText'>$ForwardAfterLoginText</textarea>
                </div>
            </div>
        </div>
HEREDOC;


echo <<<HEREDOC
</div>
HEREDOC;


