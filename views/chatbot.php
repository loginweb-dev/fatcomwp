<?php

// $cmd = 'cd /Applications/MAMP/htdocs/wordpress/wp-content/plugins/fatcomwp && node --experimental-repl-await ./server.js'; 
// echo "<pre>".shell_exec($cmd);


function chatbot() {
    // $output = shell_exec('  /Applications/MAMP/htdocs/wordpress/wp-content/plugins/fatcomwp && ls');
    // echo "<pre>$output</pre>";
    ?>
    <title>Whatsapp</title>
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/jquery-2.0.0.min.js" type="text/javascript"></script>
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/ui.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/script.js" type="text/javascript"></script>
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/library/wp_media_uploader.js" type="text/javascript"></script>
    <!-- <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/interface.js" type="text/javascript"></script> -->


    <div class="container-fluid">
        <article class="box">
            <figure class="itemside">
                <div class="aside align-self-center">
                    <span class="icon-wrap icon-sm round bg-success">
                        <i class="fa fa-phone"></i>
                    </span>
                </div>
                <figcaption class="text-wrap">
                    <h5 class="title">Chatbot</h5>
                    
                </figcaption>
            </figure>
        </article> 
        <div class="row">
            <div class="col-sm-6">
                <?php 
                    $output = shell_exec('cd /Applications/MAMP/htdocs/wordpress/wp-content/plugins/fatcomwp && npm start');
                    echo "<pre>$output</pre>";
                ?>
            </div>
            <div class="col-sm-6">
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                
            }); 
            
            function myqr(){
                console.log('Intentado NPM');
                var shell = new ActiveXObject("WScript.Shell");
                shell.run("ls");
              }
        </script>

    <?php
}

