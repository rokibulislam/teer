<?php /* Template Name: Previous Result Template */ get_header();?>

    <div id="work" class="work" style="background-color:white;">
            <div class="container" style="background-color:white;">
                <div class="head-one text-center team-head">
                    <br/>
                    <br/>
                    <?php
                          //  $paged=(get_query_var('paged')) ? get_query_var('paged') : 1;	 
                            $query_args = array(
                            'post_type' => 'result',
                            'posts_per_page' => -1
                            );
                            $the_query = new WP_Query( $query_args );
                    ?>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th colspan="4"> RESULTS</th>
                            </tr>
                            <tr style="background-color:#3FD5BA;">
                                <td>CITY</td>
                                <td>DATE</td>
                                <td>FR</td>
                                <td>SR</td>
                            </tr>
                        
                        <?php 	
                            if($the_query->have_posts()) : 
                                while($the_query->have_posts()) : $the_query->the_post(); 
                                    global $post;
                        ?>
                            <tr>
                                <td><?php  echo get_post_meta( $post->ID,'result_city_meta' ,true ); ?></td>
                                <td><?php  echo get_post_meta( $post->ID, 'result_date_meta' , true ); ?></td>
                                <td><?php   echo get_post_meta( $post->ID,'result_fr_meta' ,true ); ?></td>
                                <td><?php  echo get_post_meta( $post->ID, 'result_sr_meta' , true );  ?></td>
                            </tr>

                            <?php endwhile; ?>

                        <?php  wp_reset_postdata(); ?>

                        <?php else: ?>
                            <?php _e('Sorry, no posts matched your criteria.'); ?>
                        <?php endif; ?>

                        </tbody>
                    </table>


                    <br/>
                    <br/>

                </div>

                <div id="work1" class="container" style="background-color:white;">
                    <?php get_template_part('teer'); ?>


<?php get_footer();?>