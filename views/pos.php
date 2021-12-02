<?php
function lw_pos() {

    $setting = get_posts( array('post_status' => 'publish', 'post_type' => 'pos_lw_setting', 'orderby' => 'date') );
    $box = get_post( $setting[0]->lw_caja_default );
    $outlet = get_post(get_post_meta($box->ID, 'outlet', true));
    $boxjs_outletjs = json_encode(array('idb' => $box->ID, 'titleb' => $box->post_title, 'ido' => $outlet->ID, 'titleo' => $outlet->post_title));

    ?>
        <!-- <meta http-equiv="pragma" content="no-cache" /> -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/jquery-2.0.0.min.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/ui.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
        <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/node_modules/intro.js/introjs.css" rel="stylesheet" type="text/css" />
        

        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/script.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/library/notify.js" type="text/javascript"></script>
        <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/node_modules/intro.js/intro.js" type="text/javascript"></script>

        
        <script type="text/javascript">
            
            let isMobile = {
                mobilecheck : function() {
                    return (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino|android|ipad|playbook|silk/i.test(navigator.userAgent||navigator.vendor||window.opera)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test((navigator.userAgent||navigator.vendor||window.opera).substr(0,4)))
                }
            }
            $(document).ready(function() {
                $.notify.defaults({globalPosition: 'bottom right'})

                // ------------------ Catalog -----------------------------------------
                $('#milistcatgs').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/catalogo.php",
                    dataType: 'html',
                    contentType: 'text/html',
                    success: function (response) {
                        $('#milistcatgs').html(response);	
                    }
                });
       
                //-------------------  SESSION -----------------------------------------
                if(sessionStorage.getItem('boxjs_outletjs') === null ){
                    sessionStorage.setItem('boxjs_outletjs', '<?php echo $boxjs_outletjs; ?>');
                } 
                $('#box_outlet').html("<span class='text-muted'>"+JSON.parse(sessionStorage.getItem('boxjs_outletjs')).titleb+"</span><br><span class='text-muted'>"+JSON.parse(sessionStorage.getItem('boxjs_outletjs')).titleo+"</span>");

                // -----------   Begin --------------------------------------------------
               
                if (<?php echo get_post_meta($setting[0]->ID, 'lw_tour', true); ?> == true) {
                    introJs().start();
                }
                build_costumer();
                get_totals();
            }); 
            // --------------------------  Custumer ------------------------------------
            //--------------------------------------------------------------------------
            function customer_add (customer_id){
                $('#list_search_customers').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
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
            function customer_create(){
                $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/modal_customer.php",
                    dataType: 'html',
                    contentType: 'text/html',
                    success: function (response) {
                        $('#mitabla').html(response);	
                        $(window).scrollTop(0);
                    }
                });
            }
            function build_costumer(){
                $('#list_search_customers').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
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
            function customer_store(){
                
                let first_name = $("#first_name").val();
                let last_name = $("#last_name").val();
                let billing_phone = $("#billing_phone").val();
                let billing_postcode = $("#billing_postcode").val();
                let user_login = first_name+'.'+last_name;
                let user_email = first_name+'.'+last_name+'@loginweb.dev';
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/customer.php",
                    dataType: "json",
                    data: {
                        "customer_store": true, 
                        "user_email":  user_email, 
                        "user_login":  user_login, 
                        "first_name":  first_name, 
                        "last_name":  last_name, 
                        "billing_phone":  billing_phone, 
                        "billing_postcode":  billing_postcode },
                    success: function (response) {
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
                            dataType: "json",
                            data: {"get_customers": user_email },
                            success: function (response) {
                                let  customer = "<ul class='list-group list-group-flush'>";
                                    customer += "<li class='list-group-item'><span>Cliente: </span><small>"+response[0].billing_first_name+"  "+response[0].billing_last_name+"</small></li>";
                                    customer += "<li class='list-group-item'><span>NIT O Carnet: </span><small>"+response[0].billing_postcode+"</small></li>";
                                    customer += "<li class='list-group-item'><span>Correo: </span><small>"+response[0].user_email+"</small></li>";
                                    customer += "<li class='list-group-item'><span>Telefono: </span><small>"+response[0].billing_phone+"</small></li>";
                                    customer += "</ul>";
                                $('#list_search_customers').html(customer);	
                                $("#id_customer").val(response[0].id);
                            }
                        });
                        $.notify(response.message, "succcess");
                        $('#mitabla').html("");	
                    }
                });
            }
            // -------------------  Products  ---------------------------------------------
            //-----------------------------------------------------------------------------
            function product_add (product_id){
                $('#milistsearch').html("");
                var stock = prompt("Cantidad a Ingresar", 1);
                if (stock) {
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                        dataType: "json",
                        data: {"add": product_id, "stock": stock },
                        success: function (response) {
                            $.notify(response.message, "success");	
                            get_totals();
                            // open_cart();
                            // clear_search_products();
                            // $(window).scrollTop(0);
                        }
                    });
                }
            }
            function update_sum(product_id){
                $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                    dataType: "json",
                    data: {"update_sum": product_id},
                    success: function (response) {
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/modal_cart.php",
                            dataType: 'html',
                            contentType: 'text/html',
                            success: function (response1) {
                                $('#mitabla').html(response1);	
                                get_totals();
                                $.notify("Item Actualizado..", "success");
                            }
                        });
                    }
                });
            }
            function update_rest(product_id){
                $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                    dataType: "json",
                    data: {"update_rest": product_id},
                    success: function (response) {
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/modal_cart.php",
                            dataType: 'html',
                            contentType: 'text/html',
                            success: function (response1) {
                                $('#mitabla').html(response1);	
                                get_totals();
                                $.notify("Item Actualizado..", "success");
                            }
                        });
                    }
                });
            }
            function remove(product_id){
                $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                    dataType: "json",
                    data: {"remove": product_id },
                    success: function (response) {
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/modal_cart.php",
                            dataType: 'html',
                            contentType: 'text/html',
                            success: function (response1) {
                                $('#mitabla').html(response1);	
                                get_totals();
                                $.notify("Item Eliminado..", "success");
                            }
                        });
                    }
                });
            }
            function open_order(){
                if ($('#mitabla').html() == "") {
                    $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/modal_orders.php",
                        dataType: 'html',
                        contentType: 'text/html',
                        data: {"box_id" : JSON.parse(sessionStorage.getItem('boxjs_outletjs')).idb },
                        success: function (response) {
                            $('#mitabla').html(response);	
                            // $('#modalBox').modal('show');
                        }
                    });
                } else {
                    $('#mitabla').html("");	
                }
        
            }
            // ----------------   Cart  -------------------------------------------------------
            //----------------------------------------------------------------------------------
            function open_cart(){
                if ($('#mitabla').html() == "") {
                    $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/modal_cart.php",
                        dataType: 'html',
                        contentType: 'text/html',
                        success: function (response) {
                            $('#mitabla').html(response);	
                        }
                    });
                } else {
                    $('#mitabla').html("");	
                }
            }
            function cart_clear(){
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                    dataType: "json",
                    data: {"clear": true },
                    success: function (response) {
                        $.notify(response.message, "success");
                        get_totals();
                        $('#mitabla').html("");
                    }
                });
            }
            function extras(id, title, price, type){
                if (type == 'checkbox') {
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                        dataType: "json",
                        data: {"extra": true, "id": id, "title": title, "price": price, "quantity": 1 },
                        success: function (response) {
                            $.notify(response.message, "success");
                            get_totals();
                            
                        }
                    });  
                } else if(type == 'input_multiplier'){
                    var stock = prompt("Cantidad a Ingresar", 1);
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                        dataType: "json",
                        data: {"extra": true, "id": id, "title": title, "price": price, "quantity": stock },
                        success: function (response) {
                            $.notify(response.message, "success");
                            get_totals();
                            
                        }
                    });  
                }
            
            }
            function linea(){
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                    dataType: "json",
                    data: {"linea": true },
                    success: function (response) {
                        $.notify(response.message, "success");
                        get_totals();
                    }
                });
            }

            // ------------- Orders--------------------------------------------------------
            // --------------------------------------------------------------------------
            function new_shop_order(type_payment){
                $.notify("Pedido en Proceso", "success");
                let id_customer = $("#id_customer").val();
                let cod_box = JSON.parse(sessionStorage.getItem('boxjs_outletjs')).idb;
                let entregado = $("#entregado").val();
                let cambio = $("#cambio").val();
                let tipo_venta = $("#no_estado").is(":checked") ? "recibo" : "factura";
                let option_restaurant = $("#em").is(":checked") ? "En Mesa" : $("#rt").is(":checked") ? "Recoger en Tienda" : $("#de").is(":checked") ? "Delivery" : null;
                let opciones_print = $("#volver").is(":checked") ? false : true;
                let note_customer = $("#note_customer").val();
                if (tipo_venta == "recibo" ) {
                    if (opciones_print) {
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/orders.php",
                            dataType: "json",
                            data: {"cod_customer": id_customer, "cod_box": cod_box, "entregado": entregado, "cambio": cambio, "tipo_venta": tipo_venta, "option_restaurant": option_restaurant, "type_payment": type_payment, "note_customer": note_customer },
                            success: function (response) {
                                $.ajax({
                                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/barcode.php",
                                    data: {"cod_order": response.cod_order, "text_qr": response.text_qr },
                                    success: function () {
                                        get_totals();
                                        clear_search_products();
                                        setTimeout(function(){ $.notify("Abriendo PDF", "info"); $('html, body').scrollTop(0); }, 1000);
                                        if(isMobile.mobilecheck()){
                                            window.location.href = '<?php echo WP_PLUGIN_URL; ?>'+'/fatcomwp/views/print_recibo.php?cod_order='+response.cod_order;
                                        }else{
                                            window.open('<?php echo WP_PLUGIN_URL; ?>'+'/fatcomwp/views/print_recibo.php?cod_order='+response.cod_order, '_blank', 'location=yes,height=600,width=400,scrollbars=yes,status=yes');
                                        }
                                    }
                                });
                            
                            }
                        });
                    } else {
                        $.notify("Pedido Rapido", "success");
                        $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/orders.php",
                            dataType: "json",
                            data: {"cod_customer": id_customer, "cod_box": cod_box, "entregado": entregado, "cambio": cambio, "tipo_venta": tipo_venta, "option_restaurant": option_restaurant, "type_payment": type_payment, "note_customer": note_customer },
                            success: function (response) {
                                $.ajax({
                                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/barcode.php",
                                    data: {"cod_order": response.cod_order, "text_qr": response.text_qr },
                                    success: function () {
                                        get_totals();
                                        clear_search_products();
                                        $.notify("Venta Recibo Sin Imprimir", "success");
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
            function entregado(){
                let entregado = $("#entregado").val();
                $('#cambio').val("trabajando...");
                $('#new_shop_order').html("trabajando...");
                $('#new_shop_order').prop("disabled", true);
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
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
            }
            function pasarela(type_payment) {
                if ($('#mitabla').html() == "") {
                    $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                    let total = 0;
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                        dataType: "json",
                        data: { "get_totals": true },
                        success: function (response) {
                            total = response.total_numeral;	
                            $.ajax({
                                url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/modal_pasarela.php",
                                dataType: 'html',
                                contentType: 'text/html',
                                data: {"total" : total, "type_payment" : type_payment},
                                success: function (response) {
                                    $('#mitabla').html(response);	
                                    $(window).scrollTop(0);
                                }
                            });
                        }
                    });	
                } else {
                    $('#mitabla').html("");
                }
          
            }
            function get_totals(){
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                    dataType: "json",
                    data: {"get_totals": true },
                    success: function (response) {
                        if (response.cant_items == 0) {
                            $('#btn_pago_efectivo').prop("disabled", true);
							$('#btn_pago_tigo_money').prop("disabled", true);
							$('#btn_pago_qr_simple').prop("disabled", true);
							$('#btn_pago_transferencia').prop("disabled", true);
							$('#btn_pago_tarjeta_cd').prop("disabled", true);
                            $('#payment_quick').prop("disabled", true);
                        } else {
                            $('#btn_pago_efectivo').prop("disabled", false);
							$('#btn_pago_tigo_money').prop("disabled", false);
							$('#btn_pago_qr_simple').prop("disabled", false);
							$('#btn_pago_transferencia').prop("disabled", false);
							$('#btn_pago_tarjeta_cd').prop("disabled", false);
                            $('#payment_quick').prop("disabled", false);

                        }
                        $('#total_numeral').html("<strong>"+response.total_numeral+"</strong>");
                        $('#total_literal').html("<samll>"+response.total_literal+"</samll>");
                        $('#cant_items').html("<strong>"+response.cant_items+"</strong>");
                    }
                });	
            }
            function re_imprimir(cod_order, type) {
                if(isMobile.mobilecheck()){
                    if (type == 'recibo') {
                        window.location.href = '<?php echo WP_PLUGIN_URL; ?>'+'/fatcomwp/views/print_recibo.php?cod_order='+cod_order;
                    } else {
                        window.location.href = '<?php echo WP_PLUGIN_URL; ?>'+'/fatcomwp/views/print_factura.php?cod_order='+cod_order;
                    }
                }else{
                    if (type == 'recibo') {
                        window.open('<?php echo WP_PLUGIN_URL; ?>'+'/fatcomwp/views/print_recibo.php?cod_order='+cod_order, '_blank', 'location=yes,height=600,width=400,scrollbars=yes,status=yes');				
                    } else {
                        window.open('<?php echo WP_PLUGIN_URL; ?>'+'/fatcomwp/views/print_factura.php?cod_order='+cod_order, '_blank', 'location=yes,height=600,width=400,scrollbars=yes,status=yes');				
                    }
                }
            }

            // ----------- Boxs ------------------------------------------------
            //-----------------------------------------------------------------
            function box_details(params) {
                if ($('#mitabla').html() == "") {
                    $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/modal_box.php",
                        dataType: 'html',
                        contentType: 'text/html',
                        data: {"box_id":  JSON.parse(sessionStorage.getItem('boxjs_outletjs')).idb },
                        success: function (response) {
                            $('#mitabla').html(response);	
                        }
                    });
                } else {
                    $('#mitabla').html("");	
                }
        
            }
            function box_close(){
                let nota_cierre = $("#nota_cierre").val();
                let lw_monto_final = $("#lw_monto_final").val();
             
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/boxs.php",
                    data: {"box_id": JSON.parse(sessionStorage.getItem('boxjs_outletjs')).idb, "nota_cierre": nota_cierre, "lw_monto_final": lw_monto_final },
                    success: function () {
                        $.notify("Session Cerrada", "success");
                        sessionStorage.removeItem('boxjs_outletjs');
                        window.location.href = "<?php echo admin_url(); ?>";
                    }
                });
            }
            function box_change(box_id) {
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/boxs.php",
                    // dataType: "json",
                    data: {"change": box_id},
                    success: function (response) {
                        sessionStorage.setItem('boxjs_outletjs', response  );
                        $('#box_outlet').html("<span class='text-muted'>"+JSON.parse(sessionStorage.getItem('boxjs_outletjs')).titleb+"</span><br><span class='text-muted'>"+JSON.parse(sessionStorage.getItem('boxjs_outletjs')).titleo+"</span>");
                        $('#mitabla').html("");
                        $.notify("Cambio de Caja", "success");
                    }
                });
            }
            function open_list(){
                if ($('#mitabla').html() == "") {
                    $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");	
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/views/modal_list.php",
                        dataType: 'html',
                        contentType: 'text/html',
                        data: {"box_id" : JSON.parse(sessionStorage.getItem('boxjs_outletjs')).idb },
                        success: function (response) {
                            $('#mitabla').html(response);	
                        }
                    });
                } else {
                    $('#mitabla').html("");	
                }
            }

        </script>

        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                    <div class="form-group">
                        <input type="text" class="form-control mr-sm-2" placeholder="Buscar Productos" id="criterio_id" data-intro='Ingresa el criterio de busquedas de los prodcutos y presiona enter.'>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="icontext">
                        <a href="#" onclick="open_cart()" class="icon icon-sm rounded-circle border" data-intro='Te muestra el carrito del TPV, al hacer click muestra y con otro click oculta.'><i class="fa fa-shopping-cart"></i></a>
                        <a href="#" onclick="open_order()" class="icon icon-sm rounded-circle border" data-intro='Te muestra la ventas de la caja actual, al hacer click muestra y con otro click oculta.'><i class="fa fa-address-book"></i></a>
                        <div class="text">
                            <div id="box_outlet"></div>
                            <button class="btn btn-dark btn-sm" onclick="open_list()" data-intro='Por defecto el TPV, carga la caja Predeterminada, por favor realize el cambio a caja correspondiente a su negocio, al hacer click muestra y con otro click oculta.'>Cambiar</button>
                            <button class="btn btn-dark btn-sm" onclick="box_details()" data-intro='Con esta opcion se puede realizar el cierre de caja actual, al hacer click muestra y con otro click oculta.'>Cerrar</button>
                            <button class="btn btn-primary btn-sm" id="payment_quick" onclick="pasarela('Efectivo')" data-intro='Con accion puede realiza una venta rapida con efectivo, al hacer click muestra y con otro click oculta.'>Pago</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="mitabla" style="border:thin"></div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8" data-intro='Catalago de Productos Filtrado por Categorias, Despliega por nombre, elige tu producto y agrega al carrito.'>
                    <div id="milistcatgs"></div>
                </div>
                <div class="col-md-4">
                    <?php if(get_post_meta($setting[0]->ID, 'lw_or', true) == 'true'){ ?>
                        <div class="">
                            <article class="">
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
                                    global $wpdb;
                                    $id_extra = get_post_meta($setting[0]->ID, 'lw_extra_id', true);
								    $results = $wpdb->get_row('SELECT meta_value FROM wp_postmeta WHERE post_id = '.$id_extra.' AND  meta_key = "_product_addons"');
                                    $results = unserialize($results->meta_value);
								    $k=0;
                                    foreach ( $results  as $j => $fieldoption ) {
                                        if($fieldoption['type'] == "checkbox"){
                                            foreach ( $fieldoption['options'] as $i => $option ) {
                                                $title = $option['label'];
                                                $price = $option['price'];
    
                                                ?>
                                                    <div class="form-check" id="miextra" disabled>
                                                        <input id='<?php echo $i+1; ?>' onclick="extras('<?php echo $k+1; ?>', '<?php echo $title; ?>', <?php echo $price; ?>, '<?php echo $fieldoption['type']; ?>')" class="form-check-input" type="checkbox">
                                                        <label for="my-input" class="form-check-label"> <?php echo '----'.$title; echo ' - '; echo $price; ?> Bs.</label>
                                                    </div>
                                                <?php
                                            }
                                        }else if($fieldoption['type'] == "input_multiplier"){
                                            ?>
                                                <div class="input-group">
                                                    <label for=""><?php echo $fieldoption['name'].' Bs.'.$fieldoption['price']; ?></small>
                                                    <button class="btn btn-dark btn-sm" type="button" onclick="extras('<?php echo $k+1; ?>', '<?php echo $fieldoption['name']; ?>', <?php echo $fieldoption['price']; ?>, '<?php echo $fieldoption['type']; ?>')">Agregar</button>
                                                </div>
                                            <?php
                                        }
                                        $k++;
                                    }
                                ?> 
                                <label>Linea de Separacion</label>
                                <button class="btn btn-dark btn-sm" type="button" onclick="linea()">Agregar</button>	
                                <!-- <hr>
                                <p for="" class="text-center">
                                    <u>Linea</u>
                                    <br />
                                    <button class="btn btn-light text-primary btn-sm" type="button" onclick="linea()">Agregar</button>								
                                </p> -->
                                
                            </article>
                        </div>
                    <?php } ?>
                    <div class="" data-intro='Resumen de Carrito, con opciones de adjuntar notas a la venta.'>
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
                                    <div class="form-group">
                                            <input class="form-control form-control-sm" type="text" id="cupon_code" placeholder="Ingresa el Cupon" value="">
                                        </div>
                                    <dl class="">
                                        <small>Notas:</small> 
                                        <dd class="h6"><textarea id="note_customer" class="form-control" name="" rows="3"></textarea></dd>
                                    </dl>
                                </div>
                            </div>
                        </article>

                    </div>
                    <div class="" data-intro='Widget del Cliente, por defecto el TPV carga un cliente para la venta, si desea cambiar o crear un clinete nuevo, primero realize la busqueda y si no se encuetra podra crear uno nuevo.'>
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
                                   
                                    </form>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="" data-intro='Widget pararela de pago, con el TPV puedes realizar tus cobros de diferentes forma.'>
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
                    <!-- <div class="">
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
                    </div> -->
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
                //     $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");

                //     $.ajax({
                //         url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
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
                    $('#mitabla').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");
                
                    $.ajax({
                        url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
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
                                    let img = response[i].image ? response[i].image : '<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/default_product.png';
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
            
        // searchs customer --------------------------------------------------------------
        $("#customer_search").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                $('#list_search_customers').html("<center><img class='img-sm' src='<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/reload.gif'></center>");
                let criterio = $("#customer_search").val();
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
                    dataType: "json",
                    data: { "get_customers": criterio },
                    success: function (response) {
                        if (response.length == 0) {
                            $('#list_search_customers').html("<p>Sin Resultados  <a href='#' class='btn btn-sm btn-dark' onclick='customer_create()' type='button'> Crear Nuevo </a> </p>");	
                        } else {
                            let table = "";
                            table += "<table class='table' style='overflow:auto; border-collapse: collapse; table-layout:fixed;'><tbody>";
                            for(var i=0; i< response.length; i++){
                                table += "<tr><td><small>"+response[i].billing_postcode+"</small></td><td><small>"+response[i].billing_first_name+"</small></td><td><small>"+response[i].billing_last_name+"</small></td><td><button onclick='customer_add("+response[i].id+")' type='button' class='btn btn-sm btn-dark'><i class='fa fa-save'></i></button></td></tr>";
                            }	
                            table += "</tbody></table>";
                            table += "<p>"+response.length+" Resultados </p>";
                            $('#list_search_customers').html(table);	
                        }		
                    }
                });
            }else{

            }
        });

        $("#cupon_code").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {

                $.notify("Iniciando el proceso..", "success");
                let cupon_code = $("#cupon_code").val();
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/coupons.php",
                    dataType: 'json',
                    data: {"cupon_code" : cupon_code},
                    success: function (response) {
                        
                        if (response.cupon_id) {
                            $.ajax({
                            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/micart.php",
                            dataType: 'json',
                            data: {"descuento" : true, "cupon_id" : response.cupon_id},
                            success: function (response1) {
                                $.notify(response1.message, "success");
                                get_totals();
                                $("#cupon_code").val("");
                            }
                        });
                        } else {
                            $.notify("Error en el Cupon", "success");
                        }
                    }
                });
            }
        });

    </script>
    <?php
}