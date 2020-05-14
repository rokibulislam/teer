<?php /* Template Name: Analytics Template */ get_header();?>
    
    <div id="work" class="work" style="background-color:white;">
            <div class="container" style="background-color:white;">
                <div class="head-one text-center team-head">
                    <p></p>
                    <!--<table class="table2">-->
                    <div style="margin-bottom:1.5em;margin-top:1.5em;">
                        <a href='Ashif.html'>
                            <button style='background-color :#EBEDED;color:black;padding:0.5em;font-size:1.0em;width:60%;'>Target by Md Ashif Prince : Teer Champion</button>
                        </a>
                    </div>
                    <div style="margin-bottom:1.5em;margin-top:1.5em;">
                        <a href='champ-permit.php'>
                            <button style='background-color :#EBEDED;color:black;padding:0.5em;font-size:1.0em;width:60%;'>View Predictions By Teer Champions</button>
                        </a>
                    </div>
                    <div style="margin-bottom:1.5em;">
                        <a href='mypredictions-analytics.php'>
                            <button style='background-color :#EBEDED;color:black;padding:0.5em;font-size:1.0em;width:60%;'>My Prediction Analysis</button>
                        </a>
                    </div>
                        
                    <div style="margin-bottom:1.5em;">
                        <a href='player-permit.php'>
                            <button style='background-color :#EBEDED;color:black;padding:0.5em;font-size:1.0em;width:60%;'>View Predictions of a Player</button>
                        </a>
                    </div>
                    <div style="margin-bottom:1.5em;">
                        <a href='player-permit.php'>
                            <button style='background-color :#EBEDED;color:black;padding:0.5em;font-size:1.0em;width:60%;'>View Predictions of a Player</button>
                        </a>
                    </div>
                </div>
            </div>



            <div id="work1" class="container" style="background-color:white;">
                <?php get_template_part('teer' ); ?>

<?php get_footer();?>