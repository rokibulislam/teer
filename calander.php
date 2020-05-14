<?php /* Template Name: Calendar Template */ get_header();?>

    <div id="work" class="work" style="background-color:white;">
            <h3 align="center"> NightTeer.com</h3>
            <p></p>
            <h2 align="center"> SHILLONG TEER CALENDAR </h2>
            <p></p>

            <?php	 
                $query_args = array(
                    'post_type' => 'calendar',
                    'posts_per_page' => -1
                );
                $the_query = new WP_Query( $query_args );
            ?>
            <table class="table3">
                <tr>
                    <th colspan="3"></th>
                </tr>
                <tr style="background-color:#3FD5BA;">
                    <th>DATE</th>
                    <th>DAY</th>
                    <th>SHILLONG NIGHT TEER</th>
                </tr>
                <?php 	
                    if($the_query->have_posts()) : 
                        while($the_query->have_posts()) : $the_query->the_post(); 
                            global $post;
                            $open_date=get_post_meta( $post->ID ,'open_calendar' ,true );
                            $dayofweek = date('l', strtotime($open_date));
                ?>
                <tr style=" border : 1px solid black; text-align: center;">
                    <td style="border : 1px solid black;"> <?php echo get_post_meta( $post->ID ,'open_calendar' ,true ); ?> </td>
                    <td style="border : 1px solid black;"><?php echo $dayofweek;?></td>
                    <td style="border : 1px solid black;">Yes</td>
                </tr>

                <?php endwhile; ?>

                <?php  wp_reset_postdata(); ?>

                <?php else: ?>
                    <?php _e('Sorry, no posts matched your criteria.'); ?>
                <?php endif; ?>
            </table>
            <br/>
            <br/>
            <br/>

    </div>
    </div>

    <div id="work1" class="container" style="background-color:white;">
        <?php get_template_part('teer'); ?>
<?php get_footer();?>