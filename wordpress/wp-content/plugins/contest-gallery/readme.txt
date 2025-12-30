=== Contest Gallery - Photo Contest Plugin for WordPress  ===
Contributors: Contest-Gallery
Donate link: http://www.contest-gallery.com/
Tags: photo contest, contest, upload photos, vote photos, gallery
Requires at least: 3.9
Stable tag: 12.1.2.2
Tested up to: 5.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Highly configurable photo contest gallery plugin for WordPress.
Create image upload frontend forms.
Create user registration frontend forms.
Create responsive galleries and allow to vote images.

== Plugin limitations ==
* **Since 2019: No uploads limitation anymore**
* **(No 100 uploads limitation anymore)**
* Some options available in PRO version only
* To have all options available please purchase [PRO version](https://www.contest-gallery.com/pro-version/)

https://www.youtube.com/watch?v=vWaZbh8jh84

https://www.youtube.com/watch?v=TFl11Qz3q2k

= Multiple photo contests example =
* [Different galleries with different options](https://www.contest-gallery.com/multiple-photo-contests/)

== Amazing photo contest for your WordPress page ==

= Normal and registered users gallery =
* Display gallery images of all users
* User see only his images which were uploaded by the user after registration and login

= Four voting types =
* IP recognition
* Cookie recognition
* Login session based (create account registration and login)
* Facebook like button

= Drag & Drop image upload form creator =
* Add field types and arrange them
* Add e-mail field and allow to send confirmation e-mail
* Available field types: (Input, Textarea, Select, Select Categories, Email, URL, Check agreement, HTML, Simple Captcha, Google reCAPTCHA)
* Configure subscription e-mail

= Drag & Drop user account registration form creator =
* Add field types and arrange them
* Available field types: (WP-Nickname, WP-Email, WP-Password, WP-Password-Confirm, Input, Textarea, Select, Check agreement, HTML, Simple Captcha, Google reCAPTCHA)
* Allows membership as "Contest Gallery User" WordPress role

= Create login area =
* Add login area to your website
* Allow voting only for registered users

= Four e-mail types =
* Admin information e-mail when new image is uploaded
* Activation e-mail to user when his image is activated
* Confirmation e-mail to a user who uploaded an image to confirm that his e-mail exists
* Registration confirmation e-mail when user create a new account

== Available options ==

= Upload options =
* Automatically activate users images after front-end upload
* Allow only registered users to upload
* Restrict front end upload size
* Maximum upload size in MB
* Activate bulk upload in front end
* Maximum number of images for bulk upload
* Minimum number of images for bulk upload
* Restrict resolution uploaded images
* Activate in gallery upload form
* Forward to another page after upload
* Confirmation text after upload
* Inform admin e-mail after upload in frontend

= Registration options =
* Confirmation text after registration
* Confirmation text after e-mail confirmation
* Confirmation mail options (Addressor, Reply mail, Subject, Mail content)

= Login options =
* Forward to another page after login
* Forward to URL
* Confirmation text on same site after login
* Confirmation Text after login

= Vote options =
* Allow vote via 1 star rating
* Allow vote via 5 star rating
* Reset all votes
* Reset users votes
* Reset votes done by administrator
* Allow vote out of gallery
* Hide voting until user voted
* Configure votes amount per user
* Show only users votes (user see only his votes not the whole rating)
* Votes in time interval per user
* Delete votes (Frontend users can delete their votes and give them to another picture.)
* Vote via Facebook like button

= Photo contest end options =
* End photo contest immediately
* Activate photo contest end time
* Select last day and time of photo contest

= Commenting options =
* Allow comments
* Allow comment out of gallery
* Remove written comments

= Gallery view options =
* Show EXIF data
* Add categories widget when categories field in upload form is added
* Allow full window gallery
* Number of images per screen (pagination)
* Allow search for images (Search by fields content, categories or picture name)
* Allow sort
* Random sort
* Random sort button
* Switch between total different gallery views without site reloading
* Five different views
* Real justified Flickr look, customize height
* Thumb look, define size and margin between thumbs
* Same amount of pictures in a row look
* Slider look
* Blog look

= Single image view options =
* View images in a slider
* View preview in slider
* Link to original image source
* Show image on a single page
* Only gallery view

= Supported languages in frontend =
* English
* German
* Dutch
* Spain
* French
* Norwegian
* Swedish
* Russian
* Chinese
* Slovakian

== Screenshots ==
1. Gallery example
2. Single image view example
3. Mobile view example with information fields
4. Sorting example
5. Five stars voting example

== Installation ==

1. Install as usual way via your wordpress installer, uploading/installing/activating.
2. Contest Gallery menu point appears on the left site.
3. Create a new gallery.
4. After creating you immediately see the two important shortcodes e.g.: `[cg_gallery id="1"]` and `[cg_users_upload id="1"]`
5. You are immediately able to upload images and to create own photo contest user forms
6. Insert the shortcode `[cg_gallery id="1"]` in a page. This shortcode shows the gallery in frontend.
7. Insert the shortcode `[cg_users_upload id="1"]` in a page. This shortcode shows the the photo contest form in frontend.

Documentation to configure different options: [Click here..](https://www.contest-gallery.com/documentation/)

== Frequently Asked Questions ==

= Can i approve images before their appear in gallery? =
Yes. Right after creating a gallery it's a standard behavior.
But you can also let appear images right after upload in frontend,
without approving.

= I would like to be informed when an image is uploaded. =
That's possible! You can activate to be informed after every frontend upload
and add an email where you like to be informed.

= Is it possible to inform a user automatically when his image is activated for contest? =
Yes. If the user added his e-mail during uploading his image he will be informed when the image
is activated. He can also receive a link in his mail which leads directly to his image.
Use option "Edit options" >>> "User mail text" >>> "Inform users when activate pictures".

= Can i configure e-mal Body text which user receives? =
Yes. You can configure Addressor, Reply mail, Cc mail, Bcc mail, Subject and Body text.
You can also insert a link in the mail Body text which will lead directly to his image.

= Am i able to use Wordpress repository for adding images to gallery? =
Yes. You can use wordpress repository in for uploading images and adding them to gallery.
In frontend uploaded images appears also in Wordpress repository and in gallery.

= Can i upload more then one image? =
Yes. As default you can upload as many images as you want in backend.
Default in frontend is one image per upload. But you can can reconfigure
an amout you like. So you are also able to upload multiple images during one upload in frontend.

= Can i sort to gallery added images? =
Yes. You can sort images by moving with mouse over image block,
holding left mouse button and moving the block to direction you like.

= How can enable forwarding to extern URL by clicking on image? =
First of all you have to define an URL field in "Edit upload form" options.
Then a link to extern URL appears at a single image view.
Additionally you are able to forward directly to extern url by clicking on image.
This configuration is available in "Edit options" >>> "Gallery Options" >>> "Image forwarding options".

= Can i add information to images? =
Yes. You decide via upload form which information can be added for every image.
It's possible to configure which fields should appear single pic view or in slider view.
You can also decide one field which will appear in gallery (multiple pics) view.

= What kind of input fields can i add to upload form? =
You can add and name a text field, a textarea field for comments, an input field for validating an email
and an "Check agreement" with an url or text you like. Of course an image upload is always on, it's a
photo contest plugin :)

= Can I add Facebook Like button? =
Yes. You can activate Fb button  and vote every image via Fb button.
Normal (1 or 5 stars) voting and Fb like voting can run simultaneously at one contest.

= How many photo contests can i run? =
As many you like :)

= How many photos can i add to gallery? =
As many you like :)

= Can I use this plugin as common gallery plugin? =
Yes. You can deactivate voting and comments and have same experience as with a common gallery plugin...
EVEN MORE! An enormous amount of options to configure the look of you gallery and awesome fast slider
lift Contest Gallery off all another gallery plugins that are available today!

== Changelog ==

= V12.1.2.2 =
* NEW:  "Winner all" and "Not winner all" buttons added to images area in backend.
* FIXED: Sorting by rating average for five star did not work when opening full window for slider view.

= V12.1.2.1 =
* FIXED: Five star voting on mobiles for themes with sticky menu menu was not working.
* FIXED: Position of image using "Full window blog view" option might be not always correct joining full window.

= V12.1.2 =
* NEW: "Round borders for all control elements and containers" option in "Gallery view options".
* FIXED: Closing full window in an image in full window opened the image again if "Start gallery full window view as slide out by clicking an image" was activated.
* FIXED: "You can not comment in own gallery" message does not appear in "Blog view" if cg_gallery_user shortcode is used and user tries to comment own image.
* FIXED: Calculation of sizes of image information box for "Height View" was not always correct.
* FIXED: Image information behaviour if images were rotated in frontend.

= V12.1.1 =
* NEW: Modern backdrop in frontend when a message in gallery appear.
* FIXED: Controls slide in background in full window has now same background color as theme.
* FIXED: Slider view disappears if full window was joined in another view before and then going back to slider view.
* FIXED: Slider might be not opened if configured as first view.

= V12.1.0 =
* NEW: Modern image title, comments and rating stats appearance on hover of images in gallery view. For new created or copied galleries since version 12.1.0.
* NEW: Titles of images in gallery view not only one row anymore. For new created or copied galleries since version 12.1.0.

= V12.0.0 =
* NEW: Backend "Edit options" area redesign.

= V11.1.5.2 =
* FIXED: Scrolling from bottom to top in full window of "Blog view" might not work in some cases.
* FIXED: Last image might not always in appear in "Blog view".

= V11.1.5.1 =
* FIXED: Broken linebreak of a note in "Edit options".

= V11.1.5 =
* NEW: "Votes per category" option in "Voting options".

= V11.1.4.3 =
* NEW: Improved wording for e-mail options in "Edit options" for better understanding of mail exceptions if there were some.

= V11.1.4.2 =
* NEW: Mail exceptions hint will be shown in "Edit options" if there were an exception for appropriate mail type.
* FIXED: Changing categories order in "Edit upload form" does not affect frontend order.

= V11.1.4.1 =
* FIXED: Voting in "Blog view" was note possible if "Allow vote out of gallery" was deactivated.

= V11.1.4 =
* NEW: "Show HTML content instead of translation message when user used all votes" available in "Voting options".
* NEW: Open gallery controls button (for search, random button, categories and sort) in full window is on left side now. Area which comes from left has close button now.
* FIXED: Rating images in "Blog view" does not transfer rating visually in gallery view.
* FIXED: Open gallery controls button (for search, random button, categories and sort) in full window appears only if one of controls is activated.

= V11.1.3.1 =
* NEW: "View images as full window blog view" frontend opening animation and duration improved.
* NEW: Image URLs will be generated if "View images as full window blog view" after click on a gallery picture or scroll in full window.
* NEW: Image URLs will be generated if "Slider view" is active and by clicking through slider view.
* FIXED: Opened full window without message after uploading in frontend when "View images as full window blog view" or "View images as full window slider".
* FIXED: Last images in a row of "Thumb view" are sometimes full width size scaled.
* FIXED: Opening blog view in full window did not show up as expected if 11th image of gallery was clicked.
* FIXED: Checking database status on a multisite from a subsite did not work correctly.

= V11.1.3 =
* NEW: "One vote per category" option in "Voting options".

= V11.1.2 =
* NEW: Delete original source from storage option when deleting images in backend.
* NEW: "Delete by frontend user deleted images from storage when cg_gallery_user shortcode is used" option is available in "Update options".

= V11.1.1.4 =
* NEW: Sort by comments quantity is available in backend images area.

= V11.1.1.3 =
* FIXED: Update script did not work on a subsite of a multisite if directly executed first time on a subsite of a multisite.
* FIXED: Switching from slider view to other gallery views does not show all images if slider view is first view.

= V11.1.1.2 =
* FIXED: Wrong IP in frontend getter might show wrong votes calculation in frontend if "Show only user votes" or "Hide until user voted" is activated.
* FIXED: Uninstalling plugin did not remove complete contest-gallery folder in "uploads-folder".

= V11.1.1.1 =
* NEW: "Show Facebook share button only" option.
* FIXED: Frontend messages did not appear in case certain viewport CSS settings were set.

= V11.1.1.0 =
* FIXED: get_magic_quotes_gpc() did not work for some servers. Options could not be saved because of this.
* FIXED: Some undefined variables removed.

= V11.1.0.9 =
* FIXED: "Show EXIF data" not possible to uncheck for cg_gallery_no_voting shortcode.

= V11.1.0.8 =
* FIXED: "...Page needs to be reloaded..." message might not disappear in backend in some cases.

= V11.1.0.7 =
* FIXED: Some not compatible code which might cause errors with new PHP versions removed.

= V11.1.0.6 =
* FIXED: Unevenly scrolling on mobiles in frontend galleries in some cases.
* FIXED: Five stars voting not possible if "Original source link only" or "Only gallery view" were activated.

= V11.1.0.5 =
* FIXED: Changing "Votes in time interval per user amount" did not work.
* FIXED: Last image was not shown for "Blog view" if exactly 10 images in the gallery.
* FIXED: First five images in "Blog view" view were not shown in if "View images as full window blog view" was activated and one of first five images were clicked in the gallery.

= V11.1.0.4 =
* FIXED: Saving certain options did not work in some cases.

= V11.1.0.3 =
* NEW: Improved uninstall plugin processing.
* FIXED: Sorting new added categories in "Edit upload form" did not work properly.

= V11.1.0.2 =
* FIXED: From Facebook caused cutting of share button visibility corrected.

= V11.1.0.1 =
* FIXED: Two views switch in frontend is not visible if only two views are activated and one if this is blog view.

= V11.1.0 =
* NEW: Editing available image information fields in frontend when using cg_gallery_user shortcode.

= V11.0.4.2 =
* FIXED: Commenting opportunity append in "Blog view" even if commenting is deactivated.
* FIXED: Not all images might be displayed in backend when using search input for some sorting options.

= V11.0.4.1 =
* FIXED: Behaviour of five star voting on mobiles might be not precise enough.

= V11.0.4.0 =
* NEW: Add own icons.
* NEW: Count of how many images in each category will be shown in frontend.
* NEW: Five star voting is optimized for mobile devices. Opens a five star overview when clicking on a vote.

= V11.0.3.0 =
* NEW: Enable/Disable thumbnail navigation option for Slider view.
* FIXED: isNaN might be shown in voting counter in frontend if switching from five star to one star voting in some cases.

= V11.0.2.0 =
* NEW: Open "Enable full window button" and "Enable full screen button" for "Image view options".

= V11.0.1.0 =
* NEW: Open "Blog view" in full window option when using "Height", "Thumb" or "Row" view.
* FIXED: Comments count will be duplicated in gallery view after adding a comment.
* FIXED: Wrong voting count might be shown after voting uploading an image and reloading a page then.
* FIXED: Buggy behaviour adding or deleting images in user gallery and then reloading the page.
* FIXED: Not required close button for each blog might appear when opening blog view in full window.

= V11.0.0 =
* NEW: Blog view.
* NEW: Go up button for all views.
* NEW: Improved single image scaling.
* NEW: Improved resizing behaviour all views.
* NEW: Improved voting processing, voting caching and gallery actualizing behaviour.
* FIXED: Thumb view sometimes broken when resizing.
* FIXED: Categories are not shown if all header controls, like search or random sort button are deactivated.

= V10.9.9.1.5.2  =
* FIXED: Sorting by "Custom fields" in not working.
* FIXED: Upload button is visible in single view when cg_winner_shortcode was used, what shouldn't be for cg_winner_shortcode.

= V10.9.9.1.5.1 =
* FIXED: If "Manipulation" is activated and rating is changed, numbers which are entered in the panel are added with each page refresh for "One star voting".

= V10.9.9.1.5.0 =
* NEW: "Image view background bright style" can be found in "Image view options".

= V10.9.9.1.4 =
* NEW: If user is deleted his gallery images and entries will be also deleted or reassigned.
* NEW: Appearance of gallery improved when changing steps.
* NEW: Pagination buttons also at the bottom of a gallery now.

= V10.9.9.1.3 =
* NEW: Sort by custom fields in backend.
* FIXED: ui-slider-handle not exactly positioned in slider view.

= V10.9.9.1.1 =
* NEW: Sanitisation and validation of $_POST and $_FILES data when image uploading extended.
* FIXED: Image activation email not properly HTML formatted if activated via backend manually.

= V10.9.9.1.0 =
* NEW: "Modify image name frontend upload" in "Edit options" >>> "Upload options".

= V10.9.9.0.9 =
* FIXED: Searching for a value in backend did not show all available images in some cases.

= V10.9.9.0.8 =
* FIXED: Backend load could fail in some cases.
* FIXED: Wrong calculation if one star rating is active in some cases.

= V10.9.9.0.7 =
* FIXED: Sorting by five star average in backend is not available till at least one vote is done. Otherwise query and images load would fail.

= V10.9.9.0.6 =
* NEW: Sorting by average in backend images area.
* NEW: Show active or show inactive only in backend images area.
* FIXED: Search by picture id in backend did not work.
* FIXED: Search for a value in frontend did not work for all content types for pagination with steps.
* FIXED: Administrator rating manipulation in backend buggy or not saved for frontend.

= V10.9.9.0.5 =
* FIXED: If changing only image category then it was not saved for frontend.

= V10.9.9.0.4 =
* FIXED: Possible to save save frontend upload form even if resolution of image is lower then restricted in settings.

= V10.9.9.0.3 =
* FIXED: Closing full window did not calculate right width for the gallery in some cases.
* FIXED: Closing full window button did not exist if completely all header options were deactivated.
* FIXED: Some options could not be saved if other were not activated.
* FIXED: Activating slider look and only one another look, did not show both looks.

= V10.9.9.0.2 =
* FIXED: Not required script tags were generated in frontend for some option cases.

= V10.9.9.0.1 =
* FIXED: Uncheck winners in backend has no affect in frontend. Already unchecked winners can be repaired in "Edit options" >>> "Status and repair" >>> "Repair frontend".

= V10.9.9.0.0 =
* NEW: Mark images as winner and display winners with cg_gallery_winner shortcode.
* FIXED: Not all gallery information were displayed in frontend when gallery was copied.
* FIXED: Wrong calculation if five star voting and "Hide until user voted" is activated.

= V10.9.8.9.2 =
* FIXED: "Enable full window button" option could not be disabled.

= V10.9.8.9.1 =
* NEW: Improved queries backend.
* FIXED: Wrong voting was displayed when voting again and "Hide until vote" was activated.

= V10.9.8.9.0 =
* NEW: Configure gallery view and image view options for each gallery shortcode.
* NEW: Prepared for upcomming WordPress version 5.5.
* FIXED: "Forward directly to original source" single view option was not working if slider view is first in order.
* FIXED: Messages could not be clicked away if upload form and gallery shortcodes on same site.

= V10.9.8.8.6 =
* NEW: Further condition added in case correction file of broken rating file is broken.

= V10.9.8.8.5 =
* NEW: Correction process if rating data of an image could not be process to the end due to high server load.

= V10.9.8.8.4 =
* NEW: Extending IP recognition. Further recognition variants added. Message in backend if IP can not be recognized.
* NEW: If "Show as title in gallery" is activated for URL field, then field headline will be displayed and forwards to URL if clicked.
* FIXED: Wrong order in frontend when copying a gallery.

= V10.9.8.8.3 =
* FIXED: Remove and correct votes in backend did not work in right way.
* FIXED: Image descriptions in frontend might disappear in some cases when changing upload form.
* FIXED: Repair frontend in "Status and repair" did not repaired image descriptions.

= V10.9.8.8.2 =
* FIXED: Year and month can be selected for photo contest start and end time.
* FIXED: Remove and correct votes did not work.
* FIXED: Facebook share shown for new added images when "Hide Facebook share button" is activated. To correct images already this happend uncheck "Hide Facebook share button" option and save options. Then check "Hide Facebook share button" again and save options. Reload frontend.

= V10.9.8.8.1 =
* FIXED: Data was not saved for frontend in some cases. If some data is not visible in frontend it can be repaired in "Edit options" >>> "Status and repair".

= V10.9.8.8.0 =
* NEW: Create user account and login user immediately after registration.
* FIXED: Changing thumb sizes in WordPress >>> Settings >>> Media gallery does not affect frontend conditions for already added images.

= V10.9.8.7.0 =
* NEW: Backend completely AJAX now. Faster areas loading.
* NEW: Improved frontend load for galleries with many images.
* FIXED: Date picker did not appear in fullscreen in frontend.
* FIXED: Uploading in frontend did not show new image if a category was checked.
* FIXED: Copying categories did not work in right way.

= V10.9.8.6.2 =
* FIXED: Comments were not displayed in no voting gallery if five star rating and show only user votes were activated.
* FIXED: If multiple galleries with same id (normal, user, no voting) on same page, show messages did not appear in full window.

= V10.9.8.6.1 =
* FIXED: Date field was not working in "In gallery form".
* FIXED: Datepicker was visible at the bottom of the page when cg_users_upload shortcode was used.

= V10.9.8.6.0 =
* NEW: Date time field for upload forms.
* FIXED: Unnecessary jumping to top when navigating in slider view.

= V10.9.8.5.4 =
* NEW: Active images count when categories exist in backend.
* NEW: Precreated categories when new gallery is created.
* FIXED: Category widget might be hidden in some cases when saving options.
* FIXED: Show as HTML title attribute in gallery did not work for category field.

= V10.9.8.5.3 =
* FIXED: Categories could not be changed after update 10.9.8.5.0.

= V10.9.8.5.2 =
* NEW: 50 images can be displayed now in backend if max input vars is 2000 or higher.
* FIXED: Uploaded images over user gallery or gallery with now voting and in gallery form did not appear right after upload. Only after page reload.

= V10.9.8.5.1 =
* NEW: Failed mailing will be logged now in "Corrections and Improvements" area.

= V10.9.8.5.0 =
* NEW: "Show categories unchecked on page load" option.
* FIXED: Create data CSV showed exported data displaced if URL or Facebook fields were active.
* FIXED: "Show as HTML title attribute in gallery" fields option did not work in some cases.

= V10.9.8.4.3 =
* NEW: Improved slider performance. Works smoothly with many images now. Will be opened fast with many images now.
* FIXED: Draggable elements in backend were not draggable on mobile devices.

= V10.9.8.4.2 =
* FIXED: Registry and login might not worked for some WordPress installations.

= V10.9.8.4.1 =
* NEW: Option to repair gallery if not activated images are visible in frontend in "Corrections and Improvements" area.
* FIXED: "In gallery upload form" can handle higher upload size now. Not necessary data was send before.

= V10.9.8.4.0 =
* NEW: Allow sort options. Select which sort options should be available in frontend.

= V10.9.8.3.0 =
* NEW: Limit uploads by IP or cookie.
* FIXED: Search was not working in frontend in some cases.

= V10.9.8.2.7 =
* FIXED: Unnecessary do no manipulate upload form message if field was not required an min amount of characters was set.
* FIXED: To much height for single image view container if switch was done from slider view to any other view back.

= V10.9.8.2.6 =
* NEW: Export votes function available in "Show votes" for every image.
* FIXED: Min and max amount of characters were no validated if field was not set as required.

= V10.9.8.2.5 =
* NEW: Facebook share button title and description upload form fields.

= V10.9.8.2.3 =
* NEW: Edit Facebook pages title and description.
* FIXED: Registry form did not checked if nickname or email already exists before submitting.
* FIXED: Appearence of five stars details in slider view in full window at top cutted. Now appears at top of rating.
* FIXED: In gallery upload form not as wide anymore on wide window sizes.

= V10.9.8.2.0 =
* NEW: Preselect sort order.
* FIXED: No background color opacity 0 for upload frame, full window or full screen in some cases.

= V10.9.8.0.2 =
* NEW: Higher scaling in slider view for big monitors.
* NEW: User IP of uploaded image will be also exported now in "Create data CSV" now.
* FIXED: Not required margin right in mobile devices removed.
* FIXED: One star rating does not disappear anymore in row view with more then two images per row and low view width.

= V10.9.8.0.1 =
* FIXED: High width images in high size views were still cropped a bit in single view.
* FIXED: Vote self-added pictures now difference between IP and registered users block.
* FIXED: Activating check cookie processing when page reload was not done before.

Full updates history can be found in changelog.txt in plugins directory.