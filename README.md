# WP-Uni
A wordpress theme designed for Colleges and Universities. View the <a href="http://wpuni-edu.stackstaging.com/" target="_blank">Demo Site Here</a>

Feel free to create new pages or edit ours as you feel. 

 Custom types such as Professors, Events, and Programs were added. You can set a different Page Banner Background when adding and/or editing each instance of professor, event or program. Additionally, When adding a new Professor, you can add a picture by selecting a featured image.

I will update this theme as time goes, adding more features and flexibility.

In the mean time, enjoy!

---

## Getting Started
This theme is intended for use with Wordpress.

### Method 1

Download wp-uni-theme.zip file

From your wordpress admin dashboard, go to:

Appearance > Themes > Add New

Upload wp-uni-theme.zip and Activate Theme. 

The theme is now installed

### Method 2

Download wp-uni-theme.zip file

Use your favorite FTP tool to add the file to your wp-content/themes folder

Go back to the Wordpress admin Dashboard,

Appearance > Themes 

You will now see the WP Uni Theme in your list of installed themes. Click Activate.

## IMPORTANT CUSTOMIZATION

This theme comes with the plugin Advanced Custom Fields by Elliot Condon. It is the plugin we used to Expand some of our features, such as the Upcoming Events section and more.
In order to not lose any functionality and take full advantage of this theme, We recommend doing the following.

1- Install ACF plugin (A notice will appear at the top of the screen requesting you do so once theme is installed).

2- Once you have installed ACF, A Custom Fields option will appear in the left sidebar of the admin dashboard - Click it > Add New

3- The first field group you will add should be named <strong>Event Date</strong>

4- Click Add Field, and also name that field <strong>Event Date</strong>

5- For <strong>Field Type</strong>, select <i>Date Picker</i>

6- Under <b>Location Rules</b>, <b>Show this field group if Post Type is equal to Event</b>.

7- Scroll back up and publish. You're done with this field group!

You will add two more field groups by repeating steps 2 to 7, but this time with the following parameters:

### Field Group 2

Field Group Name <strong>Page Banner</strong>

Add two fields to this Field Group:

---

Field Label <b>Page Banner Subtitle</b> | Field Name <b>page_banner_subtitle</b> | Field Type <b>Text</b>

---

Field Label <b>Page Banner Background Image</b>  | Field Name <b>page_banner_background_image</b> | Field Type <b>Image</b>

---

<b>Location Rules</b>  | Show this Field Group if <b>Post Type is equal to Post</b> or <b>Post type is not equal to post</b> 


### Field Group 3

Field Group Name <strong>Related Program(s)</strong>


This Field group only has one Field.

Field Label <b>Related Program(s)</b> | Field Name <b>related_programs</b> | Field Type <b>Relationship</b>

<b>Location Rules</b>  | Show this Field Group if <b>Post Type is equal to Event</b> or <b>Post type is equal to Professor</b> 


You're all done.

Stay tuned for future theme updates!

Author
Cedric Tchinda
Web Developer at ProCart Web Design

