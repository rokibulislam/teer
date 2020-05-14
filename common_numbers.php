<?php /* Template Name: Common Number Template */ get_header();?>

    <div id="work" class="work" style="background-color:white;">

        <div class="container" style="background-color:white;">
            
                    <div class="head-one text-center team-head">
                        
                        <h2>30/11/2017 </h2>
                        
                        <span> </span>

                        <?php
                          //  $paged=(get_query_var('paged')) ? get_query_var('paged') : 1;	 
                            $query_args = array(
                            'post_type' => 'common',
                            'posts_per_page' => -1
                            );
                            $the_query = new WP_Query( $query_args );
                        ?>

                        <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="3"> Shillong Night</th>
                                </tr>
                            </tbody>
                        </table>

                        <?php 	
                            if($the_query->have_posts()) : 
                                while($the_query->have_posts()) : $the_query->the_post(); 
                                    global $post;
                        ?>
                        
                        <table class="table">
                            <tbody>
                                <tr style="background-color:#3FD5BA;">
                                    <td>Direct</td>
                                    <td>House</td>
                                    <td>Ending</td>
                                </tr>
                                <tr style=" background-color:cream; border: 1px solid black;">
                                    <td> <?php  echo get_post_meta( $post->ID,'common_direct_meta' ,true ); ?> </td>
                                    <td> <?php  echo get_post_meta( $post->ID,'common_house_meta' ,true ); ?> </td>
                                    <td> <?php  echo get_post_meta( $post->ID,'common_ending_meta' ,true ); ?> </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <span> </span>

                        <?php endwhile; ?>

                        <?php  wp_reset_postdata(); ?>

                        <?php else: ?>
                            <?php _e('Sorry, no posts matched your criteria.'); ?>
                        <?php endif; ?>

                        <h3>Disclaimer : These common numbers are purely based on  certain calculations done using past results. There is no guarantee of the accuracy of these numbers.</h3>
                    </div>

                    <div id="work1" class="container" style="background-color:white;">
                        <?php get_template_part('teer'); ?>
               
<?php get_footer();?>