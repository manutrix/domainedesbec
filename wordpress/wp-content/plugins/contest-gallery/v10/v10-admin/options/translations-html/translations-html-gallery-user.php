<?php

echo "<div>";
echo "<div class='cg-small-textarea-container' colspan='2'>";
echo '<p>'.$language_DeleteImageQuestion.'</p>';
echo '<input type="text" class="cg-long-input" name="translations['.$l_DeleteImageQuestion.']" maxlength="100" value="'.$translations[$l_DeleteImageQuestion].'">';
echo "</div>";
echo "</div>";

echo "<div>";
echo "<div class='cg-small-textarea-container' colspan='2'>";
echo '<p>'.$language_DeleteImageConfirm.'</p>';
echo '<input type="text" class="cg-long-input" name="translations['.$l_DeleteImageConfirm.']" maxlength="100" value="'.$translations[$l_DeleteImageConfirm].'">';
echo "</div>";
echo "</div>";

echo "<div>";
echo "<div class='cg-small-textarea-container' colspan='2'>";
echo '<p>'.$language_YouCanNotVoteInOwnGallery.'</p>';
echo '<span class="cg-info-icon">info</span><span class="cg-info-container">This message will appear if <b>cg_gallery_user</b> shortcode is used and user try to vote own images</span>';
echo '<input type="text" class="cg-long-input" name="translations['.$l_YouCanNotVoteInOwnGallery.']" maxlength="100" value="'.$translations[$l_YouCanNotVoteInOwnGallery].'">';
echo "</div>";
echo "</div>";

echo "<div>";
echo "<div class='cg-small-textarea-container' colspan='2'>";
echo '<p>'.$language_YouCanNotCommentInOwnGallery.'</p>';
echo '<span class="cg-info-icon">info</span><span class="cg-info-container">This message will appear if <b>cg_gallery_user</b> shortcode is used and user try to comment own images</span>';
echo '<input type="text" class="cg-long-input" name="translations['.$l_YouCanNotCommentInOwnGallery.']" maxlength="100" value="'.$translations[$l_YouCanNotCommentInOwnGallery].'">';
echo "</div>";
echo "</div>";

echo "<div>";
echo "<div class='cg-small-textarea-container' colspan='2'>";
echo '<p>'.$language_Edit.'</p>';
echo '<input type="text" class="cg-long-input" name="translations['.$l_Edit.']" maxlength="100" value="'.$translations[$l_Edit].'">';
echo "</div>";
echo "</div>";

echo "<div>";
echo "<div class='cg-small-textarea-container' colspan='2'>";
echo '<p>'.$language_Save.'</p>';
echo '<input type="text" class="cg-long-input" name="translations['.$l_Save.']" maxlength="100" value="'.$translations[$l_Save].'">';
echo "</div>";
echo "</div>";

echo "<div>";
echo "<div class='cg-small-textarea-container' colspan='2'>";
echo '<p>'.$language_DataSaved.'</p>';
echo '<input type="text" class="cg-long-input" name="translations['.$l_DataSaved.']" maxlength="100" value="'.$translations[$l_DataSaved].'">';
echo "</div>";
echo "</div>";

?>