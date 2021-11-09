<?php
function lw_pos() {
    $current_user = wp_get_current_user();
    // require_once '../library/class.Cart.php';
	// $cart = new Cart([
	// 	'cartMaxItem'      => 0,
	// 	'itemMaxQuantity'  => 99,
	// 	'useCookie'        => false,
	// ]);
    $post = get_post( 272 );
    ?>
        <!-- <meta http-equiv="pragma" content="no-cache" /> -->
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/js/jquery-2.0.0.min.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/css/ui.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/js/script.js" type="text/javascript"></script>

        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/library/notify.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $.notify.defaults({globalPosition: 'bottom right'})
                // jQuery code--------------------------
                $('#milistcatgs').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/reload.gif'></center>");	
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/views/catalogo.php",
                    dataType: 'html',
                    contentType: 'text/html',
                    success: function (response) {
                        $('#milistcatgs').html(response);	
                    }
                });
                build_costumer();
                get_totals();
            }); 
            // --------------------------  add custumer ----------------------------------------------------------
            function customer_add (customer_id){
                $('#list_search_customers').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/reload.gif'></center>");	
                    $.ajax({
                        url: "controller/search.php",
                        dataType: "json",
                        data: {"get_customer_id": customer_id },
                        success: function (response) {
                            let  customer = "<ul class='list-group list-group-flush'>";
                                customer += "<li class='list-group-item'><span>Cliente: </span><small>"+response[0].billing_first_name+"  "+response[0].billing_last_name+"</small></li>";
                                customer += "<li class='list-group-item'><span>NIT/CI: </span><small>"+response[0].billing_postcode+"</small></li>";
                                customer += "<li class='list-group-item'><span>Correo: </span><small>"+response[0].user_email+"</small></li>";
                                customer += "<li class='list-group-item'><span>Telefono: </span><small>"+response[0].billing_phone+"</small></li>";
                                customer += "</ul>";
                            $('#list_search_customers').html(customer);	
                            $("#id_customer").val(response[0].id);
                        }
                    });
            }
            // ----------------  SET CUSTUMER ------------------------------------------------------
            function build_costumer(){
                $('#list_search_customers').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/reload.gif'></center>");	
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/search.php",
                    dataType: "json",
                    data: {"get_customers": "cliente.generico@gmail.com" },
                    success: function (response) {
                        let  customer = "<ul class='list-group list-group-flush'>";
                            customer += "<li class='list-group-item'><span>Cliente: </span><small>"+response[0].billing_first_name+"  "+response[0].billing_last_name+"</small></li>";
                            customer += "<li class='list-group-item'><span>NIT/CI: </span><small>"+response[0].billing_postcode+"</small></li>";
                            customer += "<li class='list-group-item'><span>Correo: </span><small>"+response[0].user_email+"</small></li>";
                            customer += "<li class='list-group-item'><span>Telefono: </span><small>"+response[0].billing_phone+"</small></li>";
                            customer += "</ul>";
                        $('#list_search_customers').html(customer);	
                        $("#id_customer").val(response[0].id);
                    }
                });
            }
            // -------------- GET TOTALS -------------------------------------------------------------
            function get_totals(){
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/micart.php",
                    dataType: "json",
                    data: {"get_totals": true },
                    success: function (response) {
                        if (response.cant_items == 0) {
                            $('#btn_pago_efectivo').prop("disabled", true);
							$('#btn_pago_tigo_money').prop("disabled", true);
							$('#btn_pago_qr_simple').prop("disabled", true);
							$('#btn_pago_transferencia').prop("disabled", true);
							$('#btn_pago_tarjeta_cd').prop("disabled", true);
                        } else {
                            $('#btn_pago_efectivo').prop("disabled", false);
							$('#btn_pago_tigo_money').prop("disabled", false);
							$('#btn_pago_qr_simple').prop("disabled", false);
							$('#btn_pago_transferencia').prop("disabled", false);
							$('#btn_pago_tarjeta_cd').prop("disabled", false);
                        }
                        $('#total_numeral').html("<strong>"+response.total_numeral+"</strong>");
                        $('#total_literal').html("<samll>"+response.total_literal+"</samll>");
                        $('#cant_items').html("<strong>"+response.cant_items+"</strong>");
                    }
                });	
            }
            // -------------------  Add product ---------------------------------------------
            function product_add (product_id){
                $('#milistsearch').html("");
                var stock = prompt("Cantidad a Ingresar", 1);
                if (stock) {
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/micart.php",
                        dataType: "json",
                        data: {"add": product_id, "stock": stock },
                        success: function (response) {
                            $.notify(response.message, "success");	
                            get_totals();
                            open_cart();
                        }
                    });
                }
            }
            function update_sum(product_id){
            $('#box_body').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/reload.gif'></center>");	
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/micart.php",
                    dataType: "json",
                    data: {"update_sum": product_id},
                    success: function (response) {
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/views/modal_cart.php",
                            dataType: 'html',
                            contentType: 'text/html',
                            success: function (response1) {
                                $('#box_body').html(response1);	
                                get_totals();
                                $.notify("Item Actualizado..", "success");
                            }
                        });
                    }
                });
            }
            function update_rest(product_id){
                $('#box_body').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/reload.gif'></center>");
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/micart.php",
                    dataType: "json",
                    data: {"update_rest": product_id},
                    success: function (response) {
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/views/modal_cart.php",
                            dataType: 'html',
                            contentType: 'text/html',
                            success: function (response1) {
                                $('#box_body').html(response1);	
                                get_totals();
                                $.notify("Item Actualizado..", "success");
                            }
                        });
                    }
                });
            }
            function remove(product_id){
                $('#box_body').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/reload.gif'></center>");
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/micart.php",
                    dataType: "json",
                    data: {"remove": product_id },
                    success: function (response) {
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/views/modal_cart.php",
                            dataType: 'html',
                            contentType: 'text/html',
                            success: function (response1) {
                                $('#box_body').html(response1);	
                                get_totals();
                                $.notify("Item Eliminado..", "success");
                            }
                        });
                    }
                });
            }
            function open_order(){
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/views/modal_orders.php",
                    dataType: 'html',
                    contentType: 'text/html',
                    data: {"box_id" : 272 },
                    success: function (response) {
                        $('#box_body').html(response);	
                        $('#modalBox').modal('show');
                    }
                });
            }
            // modal cart  ----------------------------------------------------------------------------
            function open_cart(){
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/views/modal_cart.php",
                    dataType: 'html',
                    contentType: 'text/html',
                    success: function (response) {
                        $('#box_body').html(response);	
                        $('#modalBox').modal('show');
                    }
                });
            }
            // -----------------  Clear Cart -----------------------------------------------------
            function cart_clear(){
                
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/micart.php",
                    dataType: "json",
                    data: {"clear": true },
                    success: function (response) {
                        $('#modalBox').modal('toggle');
                        $.notify(response.message, "success");
                        get_totals();
                    }
                });
            }
            function pasarela(type_payment) {
                let total = 0;
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/micart.php",
                    dataType: "json",
                    data: { "get_totals": true },
                    success: function (response) {
                        total = response.total_numeral;	
            
                            $.ajax({
                                url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/views/modal_pasarela.php",
                                dataType: 'html',
                                contentType: 'text/html',
                                data: {"total" : total, "type_payment" : type_payment},
                                success: function (response) {
                                    $('#box_body').html(response);	
                                    $('#modalBox').modal('show');
                                }
                            });
                
                    }
                });	
            }
            // Create new Shop Order----------------------------------------------
            function new_shop_order(type_payment){
                $('#modalBox').modal('toggle');
                $.notify("Pedido en Proceso", "info");
                let id_customer = $("#id_customer").val();
                let cod_box = $("#cod_box").val();
                let entregado = $("#entregado").val();
                let cambio = $("#cambio").val();
                let tipo_venta = $("#no_estado").is(":checked") ? "recibo" : "factura";
                let option_restaurant = $("#em").is(":checked") ? "En Mesa" : $("#rt").is(":checked") ? "Recoger en Tienda" : $("#de").is(":checked") ? "Delivery" : null;
                let opciones_print = $("#volver").is(":checked") ? false : true;
                let note_customer = $("#note_customer").val();
                if (tipo_venta == "recibo" ) {
                    if (opciones_print) {
                        $.ajax({
                            url: "miphp/orders.php",
                            dataType: "json",
                            data: {"cod_customer": id_customer, "cod_box": cod_box, "entregado": entregado, "cambio": cambio, "tipo_venta": tipo_venta, "option_restaurant": option_restaurant, "type_payment": type_payment, "note_customer": note_customer },
                            success: function (response) {
                                $.ajax({
                                    url: "miphp/barcode.php",
                                    data: {"cod_order": response.cod_order, "text_qr": response.text_qr },
                                    success: function () {
                                        build_cart();
                                        build_costumer();
                                        build_extras();
                                        setTimeout(function(){ $.notify("Abriendo PDF", "info"); $('html, body').scrollTop(0); }, 3000);
                                        if(isMobile.mobilecheck()){
                                            window.location.href = '<?php echo WP_PLUGIN_URL; ?>'+'/iby-master/miphp/print_recibo.php?cod_order='+response.cod_order;
                                        }else{
                                            window.open('<?php echo WP_PLUGIN_URL; ?>'+'/iby-master/miphp/print_recibo.php?cod_order='+response.cod_order, '_blank', 'location=yes,height=600,width=400,scrollbars=yes,status=yes');
                                        }
                                    }
                                });
                            
                            }
                        });
                    } else {
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/orders.php",
                            dataType: "json",
                            data: {"cod_customer": id_customer, "cod_box": cod_box, "entregado": entregado, "cambio": cambio, "tipo_venta": tipo_venta, "option_restaurant": option_restaurant, "type_payment": type_payment, "note_customer": note_customer },
                            success: function (response) {
                                $.ajax({
                                    url: "miphp/barcode.php",
                                    data: {"cod_order": response.cod_order, "text_qr": response.text_qr },
                                    success: function () {
                                        build_cart();
                                        build_costumer();
                                        build_extras();
                                        $.notify("Venta Tipo Recibo Sin Imprimir, Realizada Correctamente..", "info");
                                    }
                                });
                            }
                        });
                    }
                } else {
                    if (opciones_print) {
                        $.ajax({
                            url: "miphp/orders.php",
                            dataType: "json",
                            data: {"cod_customer": id_customer, "cod_box": cod_box, "entregado": entregado, "cambio": cambio, "tipo_venta": tipo_venta, "option_restaurant": option_restaurant, "type_payment": type_payment, "note_customer": note_customer },
                            success: function (response) {
                                $.ajax({
                                    url: "miphp/barcode.php",
                                    data: {"cod_order": response.cod_order, "text_qr": response.text_qr },
                                    success: function () {
                                        build_cart();
                                        build_costumer();
                                        build_extras();
                                        setTimeout(function(){ $.notify("Abriendo PDF", "info"); $('html,body').scrollTop(0); }, 3000);
                                        if(isMobile.mobilecheck()){
                                            window.location.href = '<?php echo WP_PLUGIN_URL; ?>'+'/iby-master/miphp/print_factura.php?cod_order='+response.cod_order;
                                        }else{
                                            window.open('<?php echo WP_PLUGIN_URL; ?>'+'/iby-master/miphp/print_factura.php?cod_order='+response.cod_order, '_blank', 'location=yes,height=600,width=400,scrollbars=yes,status=yes');
                                        }
                                    }
                                });
                            
                            }
                        });
                    } else {
                        $.ajax({
                            url: "miphp/orders.php",
                            dataType: "json",
                            data: {"cod_customer": id_customer, "cod_box": cod_box, "entregado": entregado, "cambio": cambio, "tipo_venta": tipo_venta, "option_restaurant": option_restaurant, "type_payment": type_payment, "note_customer": note_customer },
                            success: function (response) {
                                $.ajax({
                                    url: "miphp/barcode.php",
                                    data: {"cod_order": response.cod_order, "text_qr": response.text_qr },
                                    success: function () {
                                        $.ajax({
                                            url: "miphp/barcode.php",
                                            data: {"cod_order": response.cod_order, "text_qr": response.text_qr },
                                            success: function () {
                                                build_cart();
                                                build_costumer();
                                                build_extras();
                                                $.notify("Venta Realizada sin Imprecion..", "info");
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                }
            }
            // Venta Detalle  --------------------------------------------------------------
            function entregado(){
                let entregado = $("#entregado").val();
                $('#cambio').val("trabajando...");
                $('#new_shop_order').html("trabajando...");
                $('#new_shop_order').prop("disabled", true);
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/micart.php",
                    dataType: "json",
                    data: { "get_totals": true },
                    success: function (response) {
                        let newcambio = entregado - response.total_numeral;
                        $('#cambio').val(newcambio);	
                        $('#new_shop_order').html("Finalizar");
                        $('#new_shop_order').prop("disabled", false);
                    }
                });
            }
            function clear_search_products(){
                $('#mitabla').html("");
                $("#criterio_id").focus();

            }
        </script>

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="form-group">
                        <input type="text" class="form-control mr-sm-2" placeholder="Buscar Productos" id="criterio_id">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="icontext">
                        <a href="#" onclick="open_cart()" class="icon icon-sm rounded-circle border"><i class="fa fa-shopping-cart"></i></a>
                        <a href="#" onclick="open_order()" class="icon icon-sm rounded-circle border"><i class="fa fa-address-book"></i></a>
                        
                        <div class="text">
                            <span class="text-muted"><?php echo $post->post_title; ?></span>
                            <input class="form-control" type="text" id="cod_box" value="<?php echo $post->ID; ?>" hidden>
                            <br><button class="btn btn-dark btn-sm" id="box_show">Cerrar</button>
                            <button class="btn btn-dark btn-sm" id="box_change">Cambiar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="mitabla"></div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div id="milistcatgs"></div>
                </div>
                <div class="col-md-4">
                    <?php if(get_post_meta($post->ID, 'lw_or', true) == 'true'){ ?>
                        <div class="card mt-1">
                            <article class="filter-group">
                                <header class="card-header">
                                    <a href="#" data-toggle="collapse" data-target="#collapse34">
                                        <i class="icon-control fa fa-chevron-down"></i>
                                        <h6 class="title"> Opciones de Restaurant </h6>
                                    </a>
                                </header>
                                <div class="filter-content collapse show" id="collapse34">
                                    <div class="card-body">
                                    <div class="form-group">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio"  id="rt" name="option_restaurant" value="option1">
                                        <span class="custom-control-label"> Recoger en Tienda </span>
                                    </label>
                                    <br>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" checked type="radio" id="em"  name="option_restaurant" value="option2">
                                        <span class="custom-control-label"> En Mesa </span>
                                    </label>
                                    <br>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="de" name="option_restaurant" value="option3">
                                        <span class="custom-control-label"> Delivery </span>
                                    </label>
                                </div>
                                <hr>
                                <p for="" class="text-center"><u>Extras</u></p>
                                <?php 
                                    $results = $wpdb->get_row('SELECT meta_value FROM wp_postmeta WHERE post_id = 401 AND  meta_key = "_product_addons"');
                                    $results = unserialize($results->meta_value);
                                    $k=0;
                                    foreach ( $results  as $j => $fieldoption ) {
                                        if($fieldoption['type'] == "checkbox"){
                                            foreach ( $fieldoption['options'] as $i => $option ) {
                                                $title = $option['label'];
                                                $price = $option['price'];

                                                ?>
                                                    <div class="form-check" id="miextra" disabled>
                                                        <input id='<?php echo $i+1; ?>' onclick="extras('<?php echo $k+1; ?>', '<?php echo $title; ?>', <?php echo $price; ?>)" class="form-check-input" type="checkbox">
                                                        <label for="my-input" class="form-check-label"> <?php echo $title; echo ' - '; echo $price; ?> Bs.</label>
                                                    </div>
                                                <?php
                                            }
                                        }else if($fieldoption['type'] == "input_multiplier"){
                                            ?>
                                                <div class="input-group">
                                                    <label for=""><?php echo $fieldoption['name'].' Bs.'.$fieldoption['price']; ?></small>
                                                    <button class="btn btn-light text-primary btn-sm" type="button" onclick="extras('<?php echo $k+1; ?>', '<?php echo $fieldoption['name']; ?>', <?php echo $fieldoption['price']; ?>)">Agregar</button>
                                                </div>
                                            <?php
                                        }
                                        $k++;
                                    }
                                    
                                ?> 
                                <hr>
                                <p for="" class="text-center">
                                    <u>Linea</u>
                                    <br />
                                    <button class="btn btn-light text-primary btn-sm" type="button" onclick="linea()">Agregar</button>								
                                </p>
                                
                            </article>
                        </div>
                    <?php } ?>
                    <div class="">
                        <article class="">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse35">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title">Resumen del Carrito </h6>
                                </a>
                            </header> 
                            <div class="filter-content collapse show" id="collapse35">
                                <div class="card-body">
                                <dl class="dlist-align">
                                <dt>Total:</dt>
                                <dd class="text-right  h6"><div id="total_numeral"></div></dd>
                                </dl>
                                <div id="total_literal"></div>
                                <hr>
                                <dl class="dlist-align">
                                    <dt>Cantidad:</dt> 
                                    <dd class="text-right  h6"><div id="cant_items"></div></dd>
                                </dl>
                                <hr>
                                
                                <dl class="">
                                    <small>Notas:</small> 
                                    <dd class="h6"><textarea id="note_customer" class="form-control" name="" rows="3"></textarea></dd>
                                </dl>
                                </div>
                            </div>
                        </article>

                    </div>
                    <div class="">
                        <article class="">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse33">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title"> Cliente </h6>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse33">
                                <div class="card-body">
                                    <form>
                                        <div class="form-group">
                                                <input id="customer_search" type="text" class="form-control form-control-sm" placeholder="Buscar cliente">
                                                <input class="form-control" type="text" id="id_customer" hidden>
                                                <div id="list_search_customers"></div>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-sm" type="text" id="cupon_code" placeholder="Ingresa el Cupon" value="">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </article>
                    </div>
                   
                    <div class="">
                        <article class="">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse36">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title">Pasarela de Pago </h6>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse36">
                                <div class="card-body">
                                    <div class= "row">
                                        <p class="text-center mb-6 mr-1">
                                            <button class="btn btn-dark btn-sm" id="btn_pago_efectivo" onclick="pasarela('Efectivo')" disabled> <i class="fa fa-money-bill-alt"></i> Efectivo</button>
                                        </p>
                                        <p class="text-center mb-6 mr-1">
                                            <button class="btn btn-dark btn-sm" id="btn_pago_tigo_money" onclick="pasarela('Tigo Money')" disabled> <i class="fa fa-registered"></i>Tigo Money</button>
                                        </p>
                                        <p class="text-center mb-6 mr-1">
                                            <button class="btn btn-dark btn-sm" id="btn_pago_qr_simple" onclick="pasarela('QR Simple')" disabled> <i class="fa fa-registered"></i>QR Simple</button>
                                        </p>
                                        <p class="text-center mb-6 mr-1">
                                            <button class="btn btn-dark btn-sm" id="btn_pago_transferencia" onclick="pasarela('Transferencia Bancaria')"  disabled> <i class="fa fa-registered"></i>Transferencia</button>
                                        </p>
                                        <p class="text-center mb-6 mr-1">
                                            <button class="btn btn-dark btn-sm" id="btn_pago_tarjeta_cd" onclick="pasarela('Tarjeta Credito/Debito')" disabled> <i class="fa fa-registered"></i>Tarjerta Debito/Credito</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="">
                        <article class="">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse37" class="collapsed" aria-expanded="false">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title">Otras Opciones </h6>
                                </a>
                            </header>
                            <div class="filter-content collapse" id="collapse37">
                                <div class="card-body">
                                    <div class= "row">
                                        <p class="text-center mb-6">
                                            <button class="btn btn-light btn-sm mr-1" id="btn_proforma" onclick="new_compra()"   disabled> <i class="fa fa-registered"></i> Proforma </button>
                                        </p>
                                        <p class="text-center mb-6">
                                            <button class="btn btn-light btn-sm mr-1" id="btn_compra" onclick="new_compra()"  disabled> <i class="fa fa-registered"></i> Compra </button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div> 
            </div> 
        </div> 
    <!-- </section> -->

    <div class="modal fade" id="modalBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Vista Rapida</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="box_body"></div>
                </div>
            </div>
        </div>
    </div>

    <script>

            // searchs products --------------------------------------------------------------
            $("#criterio_id").on('keyup', function (e) {
                e.preventDefault();
                
                
                if (e.key === 'Enter' || e.keyCode === 13) {
                    // alert("Hola mundo");
                    // if ($("#qr_barra").is(":checked")) {
                    //     // console.log(" SI Barra");
                    //     $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/reload.gif'></center>");

                    //     $.ajax({
                    //         url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/search.php",
                    //         dataType: "json",
                    //         data: { "get_sku": $("#criterio_id").val() },
                    //         success: function (response) {
                    //             if (response.length == 0) {
                    //                 $('#milistsearch').html("<p>Sin Resultados  <a href='<?php echo get_site_url(); ?>/wp-admin/post-new.php?post_type=product' target='_blank' class='btn btn-sm btn-primary'>Crear Nuevo</a></p>");	
                    //             } else {
                                    
                    //                 $.ajax({
                    //                     url: "miphp/micart.php",
                    //                     data: { "add": response.product_id },
                    //                     dataType: "json",
                    //                     success: function (response1) {
                    //                         build_cart();
                    //                         $.notify(response1.message, "info");
                    //                         $("#criterio_id").focus();
                    //                         $("#criterio_id").val("");
                    //                     }
                    //                 });
                    //             }		
                    //         }
                    //     });

                    // }else{
                        // console.log(" No Barra");
                        $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/reload.gif'></center>");
                    
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/controller/search.php",
                            dataType: "json",
                            data: { "get_products": $("#criterio_id").val() },
                            success: function (response) {
                                if (response.length == 0) {
                                    $('#mitabla').html("<p>Sin Resultados  <a href='<?php echo get_site_url(); ?>/wp-admin/post-new.php?post_type=product' target='_blank' class='btn btn-sm btn-dark'>Crear Nuevo</a></p>");	
                                } else {
                                    
                                    let table = "";
                                    
                                    
                                    table += "<table class='table'><tbody>";
                                    for(var i=0; i< response.length; i++){
                                        var userObjList = JSON.parse(response[i].brands);
                                        let roleList = '';
                                        if (userObjList.length > 0) {								
                                            userObjList.forEach(userObj => {
                                                roleList += userObj.name+', ';
                                            });
                                        }
                                        
                                        var userObjList2 = JSON.parse(response[i].cats);
                                        let roleList2 = '';
                                        if (userObjList2.length > 0) {
                                            userObjList2.forEach(userObj => {
                                                roleList2 += userObj.name+', ';
                                            });
                                        }
                                        var userObjList3 = JSON.parse(response[i].tags);
                                        let roleList3 = '';
                                        if (userObjList3.length > 0) {
                                            userObjList3.forEach(userObj => {
                                                roleList3 += userObj.name+', ';
                                            });
                                        }
                                        let img = response[i].image ? response[i].image : '<?php echo WP_PLUGIN_URL; ?>/fatcomwp-main/resources/default_product.png';
                                        table += "<tr><td><figure class='itemside'><div class='aside'><img src="+img+
                                            " class='img-sm'></div><figcaption class='info'><h6>"+response[i].name+
                                            "</h6><button onclick='product_add("+response[i].id+")' type='button' class='btn btn-sm btn-primary'><i class='fa fa-shopping-cart'></i></button><p class='text-muted small'>  Precio Venta: "+response[i].regular_price+
                                            "<p class='text-muted small'>  Stock: "+response[i].stock_quantity+
                                            "<br> ID: "+response[i].id+"<br> SKU: "+response[i].sku+"<br> MARCAS: "+roleList+"<br> CATEGORIAS: "+roleList2+"</p></figcaption></figure></td>"+
                                            "<td><strong>Detalles</strong><br><small>Precio Compra: "+response[i].bought_price+"<br> Estante: "+response[i].lg_estante+"<br> Bloque: "+response[i].lg_bloque+"<br> Vence: "+response[i].lg_date+"</small><br> Etiquetas: "+roleList3+"<br></td></tr>";
                                    }	
                                    table += "</tbody></table>";
                                    table += "<p> "+response.length+" resultados para: '"+$("#criterio_id").val()+"' <a href='#' onclick='clear_search_products()' class='btn btn-sm btn-dark' id='clear_search_products'>Borrar</a></p>";
                                    $('#mitabla').html(table);	
                                }		
                            }
                        });

                        
                    // }
                }
            });
    </script>
    <?php
}