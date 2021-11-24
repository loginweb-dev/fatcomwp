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
        update_post_meta( $post->ID, 'lw_tour', $_POST["exampleCheck1"] ? 'true' : 'false');
        update_post_meta( $post->ID, 'lw_or', $_POST["exampleCheck2"] ? 'true' : 'false');
        
         header('Location: ' . admin_url('admin.php?page=terminal-punto-venta'), true);
         die();
    } 
    $setting = get_posts( array('post_status' => 'publish', 'post_type' => 'pos_lw_setting', 'orderby' => 'date') );
    ?>
        <!-- <meta http-equiv="pragma" content="no-cache" /> -->
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/jquery-2.0.0.min.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/ui.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/script.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/library/wp_media_uploader.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.wpMediaUploader({
                    target : '.smartcat-uploader', // The class wrapping the textbox
                    uploaderTitle : 'Seleccione o suba image', // The title of the media upload popup
                    uploaderButton : 'Set image', // the text of the button in the media upload popup
                    multiple : false, // Allow the user to select multiple images
                    buttonText : 'Subir image', // The text of the upload button
                    buttonClass : '.smartcat-upload', // the class of the upload button
                    previewSize : '100px', // The preview image size
                    modal : false, // is the upload button within a bootstrap modal ?
                    buttonStyle : { // style the button
                        color : '#fff',
                        background : '#3bafda',
                        fontSize : '15px',                
                        padding : '5px 5px',                
                    },
                });
            }); 
        </script>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center">
                    <h4 class="">Configuracion de FATCOMWP</h4>
                </div>
            </div>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
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
                            <label>Nombre del Negocio</label>
                            <input class="form-control" type="text" name="lw_name_business" value="<?php echo get_post_meta($setting[0]->ID, 'lw_name_business', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>NIT</label>
                            <input class="form-control" type="text" name="lw_nit" value="<?php echo get_post_meta($setting[0]->ID, 'lw_nit', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>Actividad</label>
                            <textarea class="form-control" name="lw_activity"><?php echo get_post_meta($setting[0]->ID, 'lw_activity', true); ?></textarea>
                        </div>
                        <div class="form-group"> 
                            <label>Leyenda</label>
                            <textarea class="form-control" name="lw_legend"><?php echo get_post_meta($setting[0]->ID, 'lw_legend', true); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group"> 
                            <label>Categoria Default</label>
                            <input class="form-control" type="text" name="lw_cat_default" value="<?php echo get_post_meta($setting[0]->ID, 'lw_cat_default', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>Caja Predeterminada</label>
                            <input class="form-control" type="text" name="lw_caja_default" value="<?php echo get_post_meta($setting[0]->ID, 'lw_caja_default', true); ?>"/>
                        </div>
                        <div class="form-group"> 
                            <label>Extras</label>
                            <input class="form-control" type="text" name="lw_extra_id" value="<?php echo get_post_meta($setting[0]->ID, 'lw_extra_id', true); ?>"/>
                        </div>
                        <div class="form-group smartcat-uploader">
                            <label>Image o Logo</label>
                            <input class="form-control" type="text" name="lw_image" value="<?php echo get_post_meta($setting[0]->ID, 'lw_image', true); ?>">
                        </div>
                        <div class="form-group">
                            <label>Extencion</label>
                            <input class="form-control" type="text" name="lw_img_extencion" value="<?php echo get_post_meta($setting[0]->ID, 'lw_img_extencion', true); ?>" />
                        </div>
                        <div class="form-group">
                            <input type="checkbox" class="form-check-input" name="exampleCheck1"  id="exampleCheck1" <?php if(get_post_meta($setting[0]->ID, 'lw_tour', true) == 'true') { echo 'checked'; }; ?> >
                            <label class="form-check-label" for="exampleCheck1"> ---- Mostrar Tour</label>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" class="form-check-input" name="exampleCheck2"  id="exampleCheck2" <?php if(get_post_meta($setting[0]->ID, 'lw_or', true) == 'true') { echo 'checked'; }; ?> >
                            <label class="form-check-label" for="exampleCheck2"> ---- Opciones de Restaurant</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center">
                        <hr>
                        <div class="form-group">
                            <input class="btn btn-dark" type="submit" name="update" value="Actualizar" />
                        </div>                        
                    </div>
                </div>
            </form>
        </div>
    <?php
}