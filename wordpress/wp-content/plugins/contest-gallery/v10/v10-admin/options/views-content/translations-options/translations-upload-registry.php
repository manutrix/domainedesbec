<?php

echo <<<HEREDOC
<div class='cg_view_options_rows_container'>
         <p class='cg_view_options_rows_container_title'>Upload/Registry form</p>
HEREDOC;
echo <<<HEREDOC
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width' >
                    <div class='cg_view_option_title'>
                        <p>$language_PleaseFillOut</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_PleaseFillOut]" maxlength="100" value="$translations[$l_PleaseFillOut]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_pleaseSelect</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_pleaseSelect]" maxlength="100" value="$translations[$l_pleaseSelect]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_pleaseConfirm</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_pleaseConfirm]" maxlength="100" value="$translations[$l_pleaseConfirm]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_IamNotArobot</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_IamNotArobot]" maxlength="100" value="$translations[$l_IamNotArobot]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_youHaveNotSelected</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_youHaveNotSelected]" maxlength="100" value="$translations[$l_youHaveNotSelected]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_URLnotValid</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_URLnotValid]" maxlength="100" value="$translations[$l_URLnotValid]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_PlzCheckTheCheckboxToProveThatYouAreNotArobot</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_PlzCheckTheCheckboxToProveThatYouAreNotArobot]" maxlength="100" value="$translations[$l_PlzCheckTheCheckboxToProveThatYouAreNotArobot]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_ThisFileTypeIsNotAllowed</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_ThisFileTypeIsNotAllowed]" maxlength="100" value="$translations[$l_ThisFileTypeIsNotAllowed]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_TheFileYouChoosedIsToBigMaxAllowedSize<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$language_TheFileYouChoosedIsToBigMaxAllowedSize: 2MB</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_TheFileYouChoosedIsToBigMaxAllowedSize]" maxlength="100" value="$translations[$l_TheFileYouChoosedIsToBigMaxAllowedSize]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_BulkUploadQuantityIs<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$l_BulkUploadQuantityIs: 5</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_BulkUploadQuantityIs]" maxlength="100" value="$translations[$l_BulkUploadQuantityIs]">
                    </div>
                </div>
        </div>
        <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_BulkUploadLowQuantityIs<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$l_BulkUploadLowQuantityIs: 2</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_BulkUploadLowQuantityIs]" maxlength="100" value="$translations[$l_BulkUploadLowQuantityIs]">
                    </div>
                </div>
           </div>
HEREDOC;

echo <<<HEREDOC
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_MaximumAllowedWidthForJPGsIs<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$language_MaximumAllowedWidthForJPGsIs: 800px</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_MaximumAllowedWidthForJPGsIs]" maxlength="100" value="$translations[$l_MaximumAllowedWidthForJPGsIs]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_MaximumAllowedHeightForJPGsIs<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$language_MaximumAllowedHeightForJPGsIs: 600px</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_MaximumAllowedHeightForJPGsIs]" maxlength="100" value="$translations[$l_MaximumAllowedHeightForJPGsIs]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_MaximumAllowedWidthForPNGsIs<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$language_MaximumAllowedWidthForPNGsIs: 800px</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_MaximumAllowedWidthForPNGsIs]" maxlength="100" value="$translations[$l_MaximumAllowedWidthForPNGsIs]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_MaximumAllowedHeightForPNGsIs<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$language_MaximumAllowedHeightForPNGsIs: 600px</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_MaximumAllowedHeightForPNGsIs]" maxlength="100" value="$translations[$l_MaximumAllowedHeightForPNGsIs]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_MaximumAllowedWidthForGIFsIs<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$language_MaximumAllowedWidthForGIFsIs: 800px</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_MaximumAllowedWidthForGIFsIs]" maxlength="100" value="$translations[$l_MaximumAllowedWidthForGIFsIs]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_MaximumAllowedHeightForGIFsIs<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$language_MaximumAllowedHeightForGIFsIs: 600px</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_MaximumAllowedHeightForGIFsIs]" maxlength="100" value="$translations[$l_MaximumAllowedHeightForGIFsIs]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_MinAmountOfCharacters<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$language_MinAmountOfCharacters: 3</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_MinAmountOfCharacters]" maxlength="100" value="$translations[$l_MinAmountOfCharacters]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_MaxAmountOfCharacters<span class="cg-info-icon">info</span><span class="cg-info-container">Frontend result example:<br>$language_MaxAmountOfCharacters: 100</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_MaxAmountOfCharacters]" maxlength="100" value="$translations[$l_MaxAmountOfCharacters]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_MaximumAmountOfUploadsIs<span class="cg-info-icon">info</span><span class="cg-info-container"><strong>"Uploads per user" option</strong><br>Frontend result example:<br>$language_MaximumAmountOfUploadsIs: 5</span></p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_MaximumAmountOfUploadsIs]" maxlength="100" value="$translations[$l_MaximumAmountOfUploadsIs]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_YouHaveToCheckThisAgreement</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_YouHaveToCheckThisAgreement]" maxlength="100" value="$translations[$l_YouHaveToCheckThisAgreement]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_EmailAdressHasToBeValid</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_EmailAdressHasToBeValid]" maxlength="100" value="$translations[$l_EmailAdressHasToBeValid]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_ChooseYourImage</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_ChooseYourImage]" maxlength="100" value="$translations[$l_ChooseYourImage]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_sendUpload</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_sendUpload]" maxlength="100" value="$translations[$l_sendUpload]">
                    </div>
                </div>
        </div>
         <div class='cg_view_options_row'>
                <div class='cg_view_option cg_view_option_full_width cg_border_top_none' >
                    <div class='cg_view_option_title'>
                        <p>$language_sendRegistry</p>
                    </div>
                    <div class='cg_view_option_input'>
                        <input type="text" name="translations[$l_sendRegistry]" maxlength="100" value="$translations[$l_sendRegistry]">
                    </div>
                </div>
        </div>
HEREDOC;

echo <<<HEREDOC
</div>
HEREDOC;
// take care next row has to be after HEREDOC in file end
