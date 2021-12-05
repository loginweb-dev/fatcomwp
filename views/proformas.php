<?php

function proformas() {

    ?>
        <!-- <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> -->
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/jquery-2.0.0.min.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/ui.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
        <!-- <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/node_modules/intro.js/introjs.css" rel="stylesheet" type="text/css" /> -->
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/script.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/library/notify.js" type="text/javascript"></script>


        <div id="body"></div>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $.notify.defaults({globalPosition: 'bottom right'});
                list();
            });

            function list(){
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/proforma_list.php",
                    dataType: 'html',
                    contentType: 'text/html',
                    success: function (response) {
                        $('#body').html(response);	
                        $.notify("Proformas Cargadas", "success");
                    }
                });
               
            }
  
            function create(){
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/proforma_create.php",
                    dataType: 'html',
                    contentType: 'text/html',
                    success: function (response) {
                        $('#body').html(response);	
                        $.notify("Formulario Cargado", "success");
                    }
                });
            }
        </script>

    <?php
}

?>