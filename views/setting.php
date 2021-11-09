<?php
function lw_setting() {
    if (isset($_POST['update'])) {
        $post = get_post( $_POST["id"] );
        update_post_meta( $post->ID, 'lw_image', $_POST["lw_image"]);
        update_post_meta( $post->ID, 'lw_img_extencion', $_POST["lw_img_extencion"]);
        update_post_meta( $post->ID, 'lw_ceo', $_POST["lw_ceo"]);
        update_post_meta( $post->ID, 'lw_direction', $_POST["lw_direction"]);
        update_post_meta( $post->ID, 'lw_movil', $_POST["lw_movil"]);
        update_post_meta( $post->ID, 'lw_city', $_POST["lw_city"]);
        update_post_meta( $post->ID, 'lw_activity', $_POST["lw_activity"]);
        update_post_meta( $post->ID, 'lw_name_business', $_POST["lw_name_business"]);
        update_post_meta( $post->ID, 'lw_nit', $_POST["lw_nit"]);
        update_post_meta( $post->ID, 'lw_legend', $_POST["lw_legend"]);
        update_post_meta( $post->ID, 'lw_cat_default', $_POST["lw_cat_default"]);
        update_post_meta( $post->ID, 'lw_caja_default', $_POST["lw_caja_default"]);
        update_post_meta( $post->ID, 'lw_extra_id', $_POST["lw_extra_id"]);
        
         header('Location: ' . admin_url('admin.php?page=terminal-punto-venta'), true);
         die();
    } 
    $setting = get_posts( array('post_status' => 'publish', 'post_type' => 'pos_lw_setting') );
    ?>
        <!-- <meta http-equiv="pragma" content="no-cache" /> -->
        <script src="<?php echo WP_PLUGIN_URL; ?>/iby2/resources/js/jquery-2.0.0.min.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL; ?>/iby2/resources/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <link href="<?php echo WP_PLUGIN_URL; ?>/iby2/resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/iby2/resources/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
        <link href="<?php echo WP_PLUGIN_URL; ?>/iby2/resources/css/ui.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/iby2/resources/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
        <script src="<?php echo WP_PLUGIN_URL; ?>/iby2/resources/js/script.js" type="text/javascript"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // jQuery code

            }); 
            function open_modal_galery() {
                window.open('upload.php', '_blank', 'location=yes,height=600,width=400,scrollbars=yes,status=yes');
            }

        </script>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <!-- <a href="" class="float-right btn btn-outline-primary">Sign up</a> -->
                    <h4 class="card-title">Configuracion</h4>
                    <hr>
                    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                        <div class="form-group">
                            <label>ID</label>
                            <input readonly class="form-control" type="text" name="id" value="<?php echo $setting[0]->ID; ?>"/> 
                        </div>
                        <div class="form-group"> 
                            <label>CEO</label>
                            <input class="form-control" type="text" name="lw_ceo" value="<?php echo get_post_meta($setting[0]->ID, 'lw_ceo', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>Direccion</label>
                            <textarea class="form-control" name="lw_direction"><?php echo get_post_meta($setting[0]->ID, 'lw_direction', true); ?></textarea>
                        </div>
                        <div class="form-group"> 
                            <label>Telefono</label>
                            <input class="form-control" type="text" name="lw_movil" value="<?php echo get_post_meta($setting[0]->ID, 'lw_movil', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>Ciudad</label>
                            <input class="form-control" type="text" name="lw_city" value="<?php echo get_post_meta($setting[0]->ID, 'lw_city', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>Actividad</label>
                            <textarea class="form-control" name="lw_activity"><?php echo get_post_meta($setting[0]->ID, 'lw_activity', true); ?></textarea>
                        </div>
                        <div class="form-group"> 
                            <label>Nombre del Negocio</label>
                            <input class="form-control" type="text" name="lw_name_business" value="<?php echo get_post_meta($setting[0]->ID, 'lw_name_business', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>NIT</label>
                            <input class="form-control" type="text" name="lw_nit" value="<?php echo get_post_meta($setting[0]->ID, 'lw_nit', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>Leyenda</label>
                            <textarea class="form-control" name="lw_activity"><?php echo get_post_meta($setting[0]->ID, 'lw_legend', true); ?></textarea>
                        </div>
                        <div class="form-group"> 
                            <label>Categoria Default</label>
                            <input class="form-control" type="text" name="lw_cat_default" value="<?php echo get_post_meta($setting[0]->ID, 'lw_cat_default', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>Caja Predeterminada</label>
                            <input class="form-control" type="text" name="lw_caja_default" value="<?php echo get_post_meta($setting[0]->ID, 'lw_caja_default', true); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Image o Logo</label>
                            <a href="#" onclick="open_modal_galery()" class='button'> Galeria</a>
                            <input class="form-control" type="text" name="lw_image" value="<?php echo get_post_meta($setting[0]->ID, 'lw_image', true); ?>" />
                            <label>Extencion</label>
                            <input class="form-control" type="text" name="lw_img_extencion" value="<?php echo get_post_meta($setting[0]->ID, 'lw_img_extencion', true); ?>" />
                        </div>
                        <hr>
                        <div class="form-group">
                            <input class="form-control btn btn-primary" type="submit" name="update" value="Actualizar" />
                        </div>                                                    
                    </form>
                </div>
            </div>
        </div>

            
    <?php
}