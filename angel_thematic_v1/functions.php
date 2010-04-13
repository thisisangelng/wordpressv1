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

function childtheme_datestamp() {
    if (is_home() & !is_paged()) { ?>
        <div class="datestamp">
<?php
// This function inputs the date today. Set the default timezone to use.
    date_default_timezone_set('America/New_York');
// To edit the style of datestamp refer to http://php.net/manual/en/function.date.php
    echo date('l F j, Y, g:i a');
?>
    </div>
<?php }
    }
add_action('thematic_aboveheader','childtheme_datestamp');

// Creating column headers for my categories. First define the function:
    function category_titles() {
?>
<!-- Use html to create category titles -->
    <div id="categoryheader">
        
        <div id="creativecategory" class="floatleft span-14 append-1 categorytitle">
           <p><a href="http://localhost:8888/blog/category/creative-inspiration/">CREATIVE <br>INSPIRATIONS</p>
        </div>
        
        <div id="cravingscategory" class="floatright span-14 append-1 categorytitle">
            <p><a href="http://localhost:8888/blog/category/cravings/">FOOD <br>CRAVINGS</p>
        </div>
        
        <div id="randomcategory" class="floatright span-14 last categorytitle">
            <p><a href="http://localhost:8888/blog/category/random/">RANDOM <br>THINGS I LIKE</p>
        </div>
        
    </div>
<?php }

// Now add the new function to the Thematic Action Hook.
    add_action('thematic_belowheader','category_titles');

//Here I am creating a div to hold all food category posts. Again, define the function:
    function creative_category () {
?>
<!-- Use html to create the divs and assign classes, then php to create the loop. -->
    <div id="blogcontent">
    <div id="creativecategory" class="category floatleft span-14 append-1">       
        <!-- This shows posts only from category id=4 -->
        <?php query_posts($query_string . '&cat=4');
        // This is the start of the loop.
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
                <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
                <p class="entry-meta">Posted in <?php the_category(', '); ?></p>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
        <?php endwhile; else: ?>
            <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
    </div>
<?php }

//Add the function to the Action Hook.
    add_action('thematic_abovecontainer','creative_category');
    
//Creating a div to hold all food category posts.
    function food_category () {
?>
    <div id="foodcategory" class="category span-14 append-1 floatright"> 
        <?php query_posts($query_string . '&cat=5');
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
                <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
                <p class="entry-meta">Posted in <?php the_category(', '); ?></p>
            </div> <!-- closes the first div box -->
        <?php endwhile; else: ?>
            <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
    </div>
    </div>
<?php }
    add_action('thematic_abovecontainer','food_category');

// To create a new loop we have to get rid of thematic index loop first.
    function remove_index_loop() {
        remove_action('thematic_indexloop', 'thematic_index_loop');
}
    add_action('init', 'remove_index_loop'); ?>
<?php
// Now we will create the new loop.
    function random_category_loop(){
        query_posts($query_string . '&cat=6'); ?>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                <!-- Display the date (November 16th, 2009 format) and a link to other posts by this posts author. -->
                <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div> 
                <p class="entry-meta">Posted in <?php the_category(', '); ?></p>
            </div> <!-- closes the first div box -->
        <?php endwhile; else: ?>
            <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
    </div>
<?php }
// And in the end activate the new loop.
add_action('thematic_indexloop', 'random_category_loop');
?>