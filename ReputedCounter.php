<?php /* Template Name: Reputed Counter Template */ get_header();?>
            <div style="background-color:white;" align="center">
                <br/>
                <br/>
                <h1>Reputed Counters</h1>
                <br/>
                <br/>
                <form action="JobUpdate.php" method="POST">
                    <fieldset>
                        <legend>&nbsp;</legend>
                        <!-- Please provide your details -->
                        <table class="formtable">
                                <tr>
                                    <td><b>License No.</b>
                                    </td>
                                    <td><b>Address</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1064</td>
                                    <td>UPPER NONGTHYMMAI, SHILLONG</td>
                                </tr>
                        </table>
                    </fieldset>
                </form>
            </div>

    <div id="work1" class="container" style="background-color:white;">
        <?php get_template_part('teer'); ?>


        <?php get_footer();?>