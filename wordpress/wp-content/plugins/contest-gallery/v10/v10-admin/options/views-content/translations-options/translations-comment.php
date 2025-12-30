<?php

echo <<<HEREDOC
<div class='cg_view_options_rows_container'>
         <p class='cg_view_options_rows_container_title'>Comment area</p>
HEREDOC;
echo <<<HEREDOC
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width' >
                    <div class='cg_view_option_title'>
                        <p>$language_ThankYouForYourComment</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_ThankYouForYourComment]" maxlength="100" value="$translations[$l_ThankYouForYourComment]">
                    </div>
                </div>
         </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_TheNameFieldMustContainTwoCharactersOrMore</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_TheNameFieldMustContainTwoCharactersOrMore]" maxlength="100" value="$translations[$l_TheNameFieldMustContainTwoCharactersOrMore]">
                    </div>
                </div>
         </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_TheCommentFieldMustContainThreeCharactersOrMore</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_TheCommentFieldMustContainThreeCharactersOrMore]" maxlength="100" value="$translations[$l_TheCommentFieldMustContainThreeCharactersOrMore]">
                    </div>
                </div>
        </div>
HEREDOC;

echo <<<HEREDOC
</div>
HEREDOC;
// take care next row has to be after HEREDOC in file end
