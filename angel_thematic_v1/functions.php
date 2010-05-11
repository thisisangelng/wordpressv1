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


// Create a new function and a div to hold the datestamp. The if statement means it will only show on the homepage.
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

//Column 1: Create a div to hold all creative category posts. Again, define the function:
function creative_category () {
?>
<!-- Use html to create the divs and assign classes, then php to create a new loop. -->
    <?php if (is_home() & !is_paged()) { ?>
    <div id="blogcontent">
        <div id="creativecategory" class="category floatleft span-14 append-1">
            <!-- Use html to create category titles -->
            <div class="categoryheader">  
                <div id="inspirationcategory" class="floatleft span-14 append-1 categorytitle">
                   <p><a href="http://localhost:8888/blog/category/creative-inspiration/">CREATIVE <br>INSPIRATIONS</p>
                </div>   
            </div>

<?php
//Create a query to use with a loop. Big thanks to Allan Cole - www.allancole.com - for sharing his code!
// First, grab any global settings you may need for your loop.
global $paged, $more;
$more = 0;

// Second, create a new temporary Variable for your query.
// $creative_query is the Variable used in this example query.
// If you run any new Queries, change the variable to something else more specific ie: $feature_wp_query.
$temp = $creative_query;

// Next, set your new Variable to NULL so it's empty.
$creative_query = null;

// Then, turn your variable int the WP_Query() function.
$creative_query = new WP_Query();

// Set you're query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$creative_query->query(array(

// This will create a loop that shows 2 posts from the creative category.
    'category_name' => 'creative-inspiration',
    'showposts' => '2',
    )); ?>

<?php
// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or just use the thematic action.
thematic_navigation_above(); ?>

<?php
// While posts exists in the Query, display them.
while ($creative_query->have_posts()) : $creative_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
                <!-- Display the date (November 16th, 2009 format) and the tags. -->
                <div class = "metadata"><small>Posted on <?php the_time('F jS, Y') ?> with <?php if ( comments_open() ) : ?><?php comments_popup_link( 'no reading material', '1 inspired person', '% inspired people', 'comments-link', 'Comments are off for this post'); ?><?php endif; ?>.<?php the_tags(' Filed under ', ', '); ?>.</small></div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;
}

// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or us the thematic action.
thematic_navigation_below(); ?>

<?php
// End the Query and set it back to temporary so that it doesn't interfere with other queries.
$creative_query = null; $creative_query = $temp; ?>

<?php // Thats it! End of the creative query. ?>
        </div>
    
<?php }

//Add the function to the Action Hook.
add_action('thematic_abovecontainer','creative_category');



//Column 2: Create a function and div to hold all food category posts.
function food_category () {
if (is_home() & !is_paged()) { ?>
        <div id="foodcategory" class="category span-14 append-1 floatright">
            <!-- Use html to create category titles -->
            <div class="categoryheader">
                <div id="cravingscategory" class="floatright span-14 append-1 categorytitle">
                    <p><a href="http://localhost:8888/blog/category/cravings/">FOOD <br>CRAVINGS</p>
                </div>
            </div>

<?php
// Create another query for the food category column.
global $paged, $more;
$more = 0;
$temp = $food_query;
$food_query = null;
$food_query = new WP_Query();

// Set you're query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$food_query->query(array(

// This will create a loop that shows 2 posts from the food category.
    'category_name' => 'food-cravings',
    'showposts' => '2',
    )); ?>

<?php
// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or just use the thematic action.
thematic_navigation_above(); ?>

<?php
while ($food_query->have_posts()) : $food_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
                <!-- Display the date (November 16th, 2009 format) and the tags. -->
                <div class = "metadata"><small>Posted on <?php the_time('F jS, Y') ?> with <?php if ( comments_open() ) : ?><?php comments_popup_link( 'no reading material', '1 inspired person', '% inspired people', 'comments-link', 'Comments are off for this post'); ?><?php endif; ?>.<?php the_tags(' Filed under ', ', '); ?>.</small></div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;

// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or us the thematic action.
thematic_navigation_below(); ?>

<?php
$food_query = null; $food_query = $temp; ?>

<?php // End of the food query ?>
        </div>
<?php }
}
add_action('thematic_abovecontainer','food_category');



//Column 3: Create a function and div to hold all random category posts
function random_category_loop(){
if (is_home() & !is_paged()) { ?>
        <div id="randomcategory" class="category span-14 last floatright">
            <!-- Use html to create category titles -->
            <div class="categoryheader">
                <div id="randomthingscategory" class="floatright span-14 last categorytitle">
                    <p><a href="http://localhost:8888/blog/category/random/">RANDOM <br>THINGS I LIKE</p>
                </div>
            </div>

    <?php
// Create another query for the random things category.
global $paged, $more;
$more = 0;
$temp = $random_query;
$random_query = null;
$random_query = new WP_Query();

// Set your query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$random_query->query(array(

// This will create a loop that shows 2 posts from the random category.
    'category_name' => 'random-things',
    'showposts' => '2',
    )); ?>

<?php
// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or just use the thematic action.
thematic_navigation_above(); ?>

<?php
while ($random_query->have_posts()) : $random_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
                <!-- Display the date (November 16th, 2009 format) and the tags. -->
                <div class = "metadata"><small>Posted on <?php the_time('F jS, Y') ?> with <?php if ( comments_open() ) : ?><?php comments_popup_link( 'no reading material', '1 inspired person', '% inspired people', 'comments-link', 'Comments are off for this post'); ?><?php endif; ?>.<?php the_tags(' Filed under ', ', '); ?>.</small></div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;

// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or us the thematic action.
thematic_navigation_below(); ?>

<?php

// End the Query and set it back to temporary so that it doesn't interfere with other queries.
$random_query = null; $random_query = $temp; ?>

<?php // End of random query ?>
        </div>
    </div>
<?php }
}

// And in the end activate the new loop.
add_action('thematic_abovecontainer', 'random_category_loop');



// Get rid of thematic index loop because we have already created the three main loops.
function remove_index_loop() {
    remove_action('thematic_indexloop', 'thematic_index_loop');
}
add_action('init', 'remove_index_loop');



// Create the structure of the Portfolio page
function childtheme_portfolio() {
if ( is_page('portfolio') || $post->post_parent == '3' ) { ?>
    <div id = "featureportfolio">
    <div id="latestwork" class="span-44 last">
        <h1>Hi, I am a graphic designer living in New York City. Please browse around.</h1>
    </div>

<?php
// Create another query for the portfolio page
global $paged, $more;
$more = 0;
$temp = $portfolio_query;
$portfolio_query = null;
$portfolio_query = new WP_Query();

// Set your query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$portfolio_query->query(array(

// This will create a loop that shows 1 posts from the portfolio category.
    'category_name' => 'portfolio',
    'showposts' => '1',
    )); ?>

<?php
// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or just use the thematic action.
thematic_navigation_above(); ?>

<?php
while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;

// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or us the thematic action.
thematic_navigation_below(); ?>
</div>

<?php

// End the Query and set it back to temporary so that it doesn't interfere with other queries.
$portfolio_query = null; $portfolio_query = $temp; ?>

<?php // End of portfolio query
}
}

// And in the end activate the new loop.
add_action('thematic_belowheader', 'childtheme_portfolio');


//Create the print category column
function childtheme_portfolioprint() {
if ( is_page('portfolio') || $post->post_parent == '3' ) { ?>
    <div id = "portfolioprint" class = "span-14 append-1">
<?php
// Create another query for the portfolio page
global $paged, $more;
$more = 0;
$temp = $print_query;
$print_query = null;
$print_query = new WP_Query();

// Set you're query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$print_query->query(array(

// This will create a loop that shows 2 posts from the print category.
    'category_name' => 'print',
    'showposts' => '2',
    )); ?>

<?php
// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or just use the thematic action.
thematic_navigation_above(); ?>

<?php
while ($print_query->have_posts()) : $print_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;

// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or us the thematic action.
thematic_navigation_below(); ?>

<?php

// End the Query and set it back to temporary so that it doesn't interfere with other queries.
$print_query = null; $print_query = $temp; ?>
</div>

<?php // End of print query
}
}

// And in the end activate the new loop.
add_action('thematic_belowheader', 'childtheme_portfolioprint');



//Create the web category column
function childtheme_portfolioweb() {
if ( is_page('portfolio') || $post->post_parent == '3' ) { ?>
    <div id = "portfolioweb" class = "span-14 append-1 floatright">
<?php
// Create another query for the portfolio page
global $paged, $more;
$more = 0;
$temp = $web_query;
$web_query = null;
$web_query = new WP_Query();

// Set your query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$web_query->query(array(

// This will create a loop that shows 2 posts from the web category.
    'category_name' => 'web',
    'showposts' => '2',
    )); ?>

<?php
// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or just use the thematic action.
thematic_navigation_above(); ?>

<?php
while ($web_query->have_posts()) : $web_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;

// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or us the thematic action.
thematic_navigation_below(); ?>

<?php

// End the Query and set it back to temporary so that it doesn't interfere with other queries.
$web_query = null; $web_query = $temp; ?>
</div>

<?php // End of web query
}
}

// And in the end activate the new loop.
add_action('thematic_belowheader', 'childtheme_portfolioweb');



//Create the other category column
function childtheme_portfolioother() {
if ( is_page('portfolio') || $post->post_parent == '3' ) { ?>
    <div id = "portfolioother" class = "span-14 last floatright">
<?php
// Create another query for the portfolio page
global $paged, $more;
$more = 0;
$temp = $other_query;
$other_query = null;
$other_query = new WP_Query();

// Set your query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$other_query->query(array(

// This will create a loop that shows w posts from the other category.
    'category_name' => 'other',
    'showposts' => '2',
    )); ?>

<?php
// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or just use the thematic action.
thematic_navigation_above(); ?>

<?php
while ($other_query->have_posts()) : $other_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;

// Add Previous and Next post links here. (http://codex.wordpress.org/Template_Tags/previous_post_link)
// Or us the thematic action.
thematic_navigation_below(); ?>

<?php

// End the Query and set it back to temporary so that it doesn't interfere with other queries.
$other_query = null; $other_query = $temp; ?>
</div>

<?php // End of other query
}
}

// And in the end activate the new loop.
add_action('thematic_belowheader', 'childtheme_portfolioother');


// I disabled the main container using CSS so I must create a new function to show a single post
function add_single_post() {  if (is_single ()) {
?>
<div class="post single">
<!-- Display the Title as a link to the Post's permalink. -->
    <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <div class="entry-content">
            <?php the_content();
            // calling the comments template
            thematic_comments_template();?>
            </div>
    </div>
<?php
} }
add_action('thematic_belowheader', 'add_single_post',1);


//I disabled the main container using CSS so I must create a new function to show pages
function add_older_post() {  if (is_paged()) {

global $paged, $more;
$more = 0;
$temp = $other_query;
$other_query = null;
$other_query = new WP_Query();

// Set your query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$other_query->query(array(

// This will create a loop that shows w posts from the other category.
    'category__not_in' => array(40,11,38,39,37),
    'showposts' => '6',
    )); ?>

<?php
while ($other_query->have_posts()) : $other_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;

// End the Query and set it back to temporary so that it doesn't interfere with other queries.
$other_query = null; $other_query = $temp; ?>
</div>

<?php // End of other query
}
}

add_action('thematic_belowheader', 'add_older_post');

/*
// For older post pages THIS CODE IS NOT WORKING AT THE MOMENT
function creative_category_old () {
?>
    <?php if (is_paged()) { ?>
    <div id="blogcontentold">
        <div id="creativecategory" class="category floatleft span-14 append-1">
            <!-- Use html to create category titles -->
            <div class="categoryheader">  
                <div id="inspirationcategory" class="floatleft span-14 append-1 categorytitle">
                   <p><a href="http://localhost:8888/blog/category/creative-inspiration/">CREATIVE <br>INSPIRATIONS</p>
                </div>   
            </div>

<?php
global $paged, $more;
$more = 0;
$temp = $creative_query;
$creative_query = null;
$creative_query = new WP_Query();
$creative_query->query(array(
    'category_name' => 'creative-inspiration',
    'showposts' => '4',
    )); ?>

<?php
// While posts exists in the Query, display them.
while ($creative_query->have_posts()) : $creative_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
                <!-- Display the date (November 16th, 2009 format) and the tags. -->
                <div class = "metadata"><small>Posted on <?php the_time('F jS, Y') ?> with <?php if ( comments_open() ) : ?><?php comments_popup_link( 'no reading material', '1 inspired person', '% inspired people', 'comments-link', 'Comments are off for this post'); ?><?php endif; ?>.<?php the_tags(' Filed under ', ', '); ?>.</small></div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;
}

$creative_query = null; $creative_query = $temp; ?>
        </div>
    
<?php }

//Add the function to the Action Hook.
add_action('thematic_belowheader','creative_category_old');


//Column 2: Create a function and div to hold all food category posts.
function food_category_old () {
if (is_paged()) { ?>
        <div id="foodcategory" class="category span-14 append-1 floatright">
            <!-- Use html to create category titles -->
            <div class="categoryheader">
                <div id="cravingscategory" class="floatright span-14 append-1 categorytitle">
                    <p><a href="http://localhost:8888/blog/category/cravings/">FOOD <br>CRAVINGS</p>
                </div>
            </div>

<?php
// Create another query for the food category column.
global $paged, $more;
$more = 0;
$temp = $food_query;
$food_query = null;
$food_query = new WP_Query();

// Set you're query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$food_query->query(array(

// This will create a loop that shows 2 posts from the food category.
    'category_name' => 'food-cravings',
    'showposts' => '4',
    ));

while ($food_query->have_posts()) : $food_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
                <!-- Display the date (November 16th, 2009 format) and the tags. -->
                <div class = "metadata"><small>Posted on <?php the_time('F jS, Y') ?> with <?php if ( comments_open() ) : ?><?php comments_popup_link( 'no reading material', '1 inspired person', '% inspired people', 'comments-link', 'Comments are off for this post'); ?><?php endif; ?>.<?php the_tags(' Filed under ', ', '); ?>.</small></div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;

$food_query = null; $food_query = $temp; ?>

<?php // End of the food query ?>
        </div>
<?php }
}
add_action('thematic_belowheader','food_category_old');



//Column 3: Create a function and div to hold all random category posts
function random_category_old(){
if (is_paged()) { ?>
        <div id="randomcategory" class="category span-14 last floatright">
            <!-- Use html to create category titles -->
            <div class="categoryheader">
                <div id="randomthingscategory" class="floatright span-14 last categorytitle">
                    <p><a href="http://localhost:8888/blog/category/random/">RANDOM <br>THINGS I LIKE</p>
                </div>
            </div>

    <?php
// Create another query for the random things category.
global $paged, $more;
$more = 0;
$temp = $random_query;
$random_query = null;
$random_query = new WP_Query();

// Set your query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$random_query->query(array(

// This will create a loop that shows 2 posts from the random category.
    'category_name' => 'random-things',
    'showposts' => '4',
    )); 

while ($random_query->have_posts()) : $random_query->the_post(); ?>

<?php // Start the looped content here. ?>
            <div class="post">
                <!-- Display the Title as a link to the Post's permalink. -->
                <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                    <?php the_content(); ?>
                    </div>
                <!-- Display the date (November 16th, 2009 format) and the tags. -->
                <div class = "metadata"><small>Posted on <?php the_time('F jS, Y') ?> with <?php if ( comments_open() ) : ?><?php comments_popup_link( 'no reading material', '1 inspired person', '% inspired people', 'comments-link', 'Comments are off for this post'); ?><?php endif; ?>.<?php the_tags(' Filed under ', ', '); ?>.</small></div>
            </div> <!-- closes the first div box -->
       <!--This is how to end a loop -->
<?php endwhile;

// End the Query and set it back to temporary so that it doesn't interfere with other queries.
$random_query = null; $random_query = $temp; ?>

<?php // End of random query ?>
        </div>
    </div>
<?php }
}

// And in the end activate the new loop.
add_action('thematic_belowheader', 'random_category_old');

*/



// add image thumbnail feature
add_theme_support('post-thumbnails');
set_post_thumbnail_size( 300, 270, true );


// Multiple column loop for Bookshelf page
function childtheme_bookshelf(){
    if ( is_page('bookshelf') || $post->post_parent == '40' ) {
?>
    <div id='bookshelf1' class="bookshelf span-14 append-1">
<?php
    global $paged, $more;
    $more = 0;

// Second, create a new temporary Variable for your query.
// $bookshelf_query is the Variable used in this example query.
// If you run any new Queries, change the variable to something else more specific ie: $feature_wp_query.
$temp = $bookshelf_query;
  
// Next, set your new Variable to NULL so it's empty.
$bookshelf_query = null;
 
// Then, turn your variable int the WP_Query() function.
$bookshelf_query = new WP_Query();

// Set you're query parameters. Need more Parameters?: http://codex.wordpress.org/Template_Tags/query_posts
$bookshelf_query->query(array(
 
    'category_name' => 'bookshelf',
    'posts_per_page' => 6, ));

    $count = 1;
// While posts exists in the Query, display them.
while ($bookshelf_query->have_posts()) : $bookshelf_query->the_post(); ?>
 
<?php // Start the looped content here. ?>
    <div class="books">
            <div class="entry-content">
                <?php the_post_thumbnail(); // we just called for the thumbnail ?>
            </div>
    </div> <!-- closes the first div box -->
<!--This is how to end a loop -->

<?php

// In the case you're rendering the very last post, do nothing:
    if ($count == 6){
// Do nothing, thematic will add a '</div>' to close the last post
// Is this the last post in the column?
// That means if the loop number divides by 2 (or whatever post per column number we choose)

// If second column
    } elseif ($count%4 == 0){

// If third column
// if this is the bottom post, close the div and start a new div:
    echo '</div>

    <div id="bookshelf3" class="bookshelf span-14 last floatright">';
    } elseif ($count%2 == 0){

// If third column
// if this is the bottom post, close the div and start a new div:
    echo '</div>
    
    <div id="bookshelf2" class="bookshelf span-14 append-1 floatright">';
    
    } else {
// Do nothing, just move on, nothing to see here...
}

// We're about to finish the loop, let's add 1 to the count:

$count = $count + 1;

endwhile; // loop done, go back up

// All the posts are done, close the last column:
echo '</div>';


// End the Query and set it back to temporary so that it doesn't interfere with other queries.
$bookshelf_query = null;
$bookshelf_query = $temp;
} }

//Add the function to the Action Hook.
add_action('thematic_belowcontainer','childtheme_bookshelf');

?>