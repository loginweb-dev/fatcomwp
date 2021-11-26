<?php 
    function delivery_whatsapp() {

        // echo $_GET['cod_order'];
        $order = wc_get_order($_GET['cod_order']);

        // print_f($order);
        // echo $order->get_date_created()->date('Y-m-d H:i:s');
        // echo get_post_meta( $order->get_id(), 'billing_lat', true );
        // echo get_post_meta( $order->get_id(), 'billing_long', true );

        $blogusers = get_users( array( 'role__in' => array( 'driver' ) ) );
        // Array of WP_User objects.
        foreach ( $blogusers as $user ) {
            // echo '<span>' . esc_html( $user->display_name ) . '</span>';
        }

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
            <script type="text/javascript">
                $(document).ready(function() {
               
                }); 
            </script>


            <div class="container-fluid">
                <article class="box">
                    <figure class="itemside">
                        <div class="aside align-self-center">
                            <span class="icon-wrap icon-sm round bg-success">
                                <i class="fa fa-phone"></i>
                            </span>
                        </div>
                        <figcaption class="text-wrap">
                            <h5 class="title">Enviar pedido por Whatsapp al Delivery</h5>
                            <!-- <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labor </p> -->
                        </figcaption>
                    </figure> <!-- iconbox // -->
                </article> <!-- panel-lg.// -->
                <div class="row">
                    
                    <div class="col-sm-12">
                        <!-- <h2>Enviar pedido por Whatsapp al Delivery</h2> -->
                 

                            <div class="box">
                                <dl>
                                    <dt>Pedido # </dt>
                                    <dd> 
                                        <?php echo $order->get_id(); ?>
                                        <br />
                                        <?php echo $order->get_date_created()->date('Y-m-d H:i:s'); ?>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>Cliente: </dt>
                                    <dd>
                                        <?php echo get_post_meta( $order->ID, '_billing_email', true ); ?>
                                        <br />
                                        <?php echo get_post_meta( $order->ID, '_billing_first_name', true ).' '.get_post_meta( $order->ID, '_billing_last_name', true ); ?>
                                        <br />
                                        <?php echo get_post_meta( $order->ID, '_billing_phone', true ); ?>
                                        
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>Direccion:</dt>
                                    <dd>
                                        <?php echo get_post_meta( $order->get_id(), '_billing_address_1', true ); ?>
                                        <br />
                                        <strong>Coordenadas</strong>
                                        <br />
                                        <?php echo get_post_meta( $order->get_id(), 'billing_lat', true);  ?>
                                        <br />
                                        <?php echo get_post_meta( $order->get_id(), 'billing_long', true ); ?>
                                    </dd>
                                </dl>
                            </div> <!-- box.// -->
    
                    </div>
                </div>

                <h2> Delivery's Disponibles</h2>


                <div class="row">
                    <div class="col-sm-12">
                        <?php  foreach ( $blogusers as $user ) { ?>
                            <figure class="itemside">
                                <div class="aside">
                                    <div class="img-wrap img-sm"><img src="<?php echo get_avatar_url( $user->ID ); ?>" class="img-thumbnail"></div>
                                </div>
                                <figcaption class="text-wrap">
                                    <h6 class="title"><a href="#"><?php echo esc_html( $user->display_name ); ?></a></h6>
                                    <!-- <br /> -->
                                    <!-- <h6 class="title"><a href="#"><?php echo esc_html( $user->billing_phone ); ?></a></h6> -->
                                    <span class="text-muted"><?php echo esc_html( $user->billing_phone ); ?></span>
                                    <!-- <a href="#" class="btn btn-primary btn-sm"> Enviar </a> -->
                                    <br />
                                    <a class="btn btn-dark btn-sm" href="whatsapp://send?text=https://www.google.com/maps/@<?php echo get_post_meta( $order->get_id(), 'billing_lat', true);  ?>,<?php echo get_post_meta( $order->get_id(), 'billing_long', true);  ?>" data-action="share/whatsapp/share">Enviar Whatsapp</a>

                                </figcaption>
                            </figure> 
                        <?php } ?>
                    </div>
                </div>


            </div>


        <?php
    }
?>