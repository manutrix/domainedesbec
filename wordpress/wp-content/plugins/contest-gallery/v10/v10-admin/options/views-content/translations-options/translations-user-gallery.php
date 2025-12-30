<?php

echo <<<HEREDOC
<div class='cg_view_options_rows_container'>
         <p class='cg_view_options_rows_container_title'>User Gallery</p>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width' >
                    <div class='cg_view_option_title'>
                        <p>$language_DeleteImageQuestion</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_DeleteImageQuestion]" maxlength="100" value="$translations[$l_DeleteImageQuestion]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_DeleteImageConfirm</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_DeleteImageConfirm]" maxlength="100" value="$translations[$l_DeleteImageConfirm]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_YouCanNotVoteInOwnGallery<span class="cg-info-icon">info</span><span class="cg-info-container">This message will appear if <b>cg_gallery_user</b> shortcode is used and user try to vote own images</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_YouCanNotVoteInOwnGallery]" maxlength="100" value="$translations[$l_YouCanNotVoteInOwnGallery]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_YouCanNotCommentInOwnGallery<span class="cg-info-icon">info</span><span class="cg-info-container">This message will appear if <b>cg_gallery_user</b> shortcode is used and user try to comment own images</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_YouCanNotCommentInOwnGallery]" maxlength="100" value="$translations[$l_YouCanNotCommentInOwnGallery]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_Edit</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_Edit]" maxlength="100" value="$translations[$l_Edit]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_Save</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_Save]" maxlength="100" value="$translations[$l_Save]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_DataSaved</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_DataSaved]" maxlength="100" value="$translations[$l_DataSaved]">
                    </div>
                </div>
        </div>
</div>
HEREDOC;
// take care next row has to be after HEREDOC in file end
