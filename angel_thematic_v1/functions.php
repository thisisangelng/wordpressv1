<?php


//
//  Custom Child Theme Functions
//

// I've included a "commented out" sample function below that'll add a home link to your menu
// More ideas can be found on "A Guide To Customizing The Thematic Theme Framework" 
// http://themeshaper.com/thematic-for-wordpress/guide-customizing-thematic-theme-framework/

// Adds a home link to your menu
// http://codex.wordpress.org/Template_Tags/wp_page_menu
//function childtheme_menu_args($args) {
//    $args = array(
//        'show_home' => 'Home',
//        'sort_column' => 'menu_order',
//        'menu_class' => 'menu',
//        'echo' => true
//    );
//	return $args;
//}
//add_filter('wp_page_menu_args','childtheme_menu_args');

?>
<div class="datestamp">
<?php
// This function inputs the date today. Set the default timezone to use.
date_default_timezone_set('America/New_York');
// To edit the style of datestamp refer to http://php.net/manual/en/function.date.php
echo date('l F j, Y, g:i a');
?>
</div>

<?php
// Use this to remove default Thematic actions
function remove_thematic_actions() {
remove_action('thematic_hookname','thematic_actionname',optionalpostitionnumber);
}

add_action('init','remove_thematic_actions');

//this function adds a div to all posttitles
function childtheme_posttitle($posttitle) {
return '<div class="containing">' . $posttitle . '</div>';
}
add_filter('thematic_postheader_posttitle','childtheme_posttitle');





// First we make our function
function category_titles() {
?>
<!Ð Using html to create category titles Ð>
    <div id="categoryheader">
<div id="creativecategory" class="floatleft categorytitle">
<p><a href="http://localhost:8888/blog/category/creative-inspiration/">CREATIVE <br>INSPIRATIONS</p>
</div>
<div id="randomcategory" class="floatright categorytitle">
<p><a href="http://localhost:8888/blog/category/random/">RANDOM <br>THINGS I LIKE</p>
</div>
<div id="cravingscategory" class="floatright categorytitle">
<p><a href="http://localhost:8888/blog/category/cravings/">FOOD <br>CRAVINGS</p>
</div>
</div>
<?php }
// end of our new function
 
// Now we add our new function to our Thematic Action Hook
add_action('thematic_belowheader','category_titles');


?>