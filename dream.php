<?php /* Template Name: Dream Template */ get_header();?>

        <div id="work" class="work" style="background-color:white;">
            <div class="container" style="background-color:white;">
                <div class="head-one text-center team-head">
                    <h2>Below is a compilation of dream meanings.</h2>
                    <br>
                    <form name='filter' method='post'>
                        </br>
                        </br>
                        <label>Select Dream Type
                            <select name='dreamtype'>
                                <option value='0'>SELECT</option>
                                <option value='Human'>Human</option>
                                <option value='Animal'>Animal</option>
                                <option value='Fruits And Plants'>Fruits And Plants</option>
                                <option value='Others'>Others</option>
                                <option value='All'>All</option>
                            </select>
                            <input type='submit' name='submit' value='SUBMIT' style='padding:0.5em;background-color:#7ACAFF;'>
                            <p></p>
                    </form>
                    <br>

                    <?php
                          //  $paged=(get_query_var('paged')) ? get_query_var('paged') : 1;	 
                            $query_args = array(
                            'post_type' => 'dream',
                            'posts_per_page' => -1
                            );
                            $the_query = new WP_Query( $query_args );
                    ?>
                        <table class="table4">
                            <tr>
                                <th colspan="4">DREAM MEANING</th>
                            </tr>
                            <tr style="background-color:#3FD5BA;">
                                <td>DREAM</td>
                                <td>DIRECT</td>
                                <td>HOUSE</td>
                                <td>ENDING</td>
                            </tr>

                            <tr style=" background-color:cream; border: 1px solid black;"></tr>

                            <?php 	
                                if($the_query->have_posts()) : 
                                    while($the_query->have_posts()) : $the_query->the_post(); 
                                        global $post;
                            ?>

                            <tr style=" border : 1px solid black; text-align: center;">
                                <td style="border : 1px solid black;"> <?php echo get_post_meta( $post->ID,'dream_meta' ,true );?> </td>
                                <td style="border : 1px solid black;"> <?php echo get_post_meta( $post->ID, 'direct_meta' , true ); ?> </td>
                                <td style="border : 1px solid black;"> <?php echo get_post_meta( $post->ID,'house_meta' ,true ); ?> </td>
                                <td style="border : 1px solid black;"> <?php echo get_post_meta( $post->ID, 'ending_meta' , true ); ?> </td>
                            </tr>


                                <?php endwhile; ?>

                            <?php  wp_reset_postdata(); ?>

                            <?php else: ?>
                                <?php _e('Sorry, no posts matched your criteria.'); ?>
                            <?php endif; ?>
            
                        </table>
                        <span></span>
                </div>
                <div class="clear"></div>
            </div>
        </div>
            </div>

            </div>

            <div id="work1" class="container" style="background-color:white;">
                <?php get_template_part('teer'); ?>



<?php get_footer();