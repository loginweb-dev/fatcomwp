
<?php 
    require_once('../../../../wp-load.php');
?>
<br />
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="title">Nueva Proforma</h3>
            <hr />
            <div class="form-group">
                <label for="">Titulo</label>
                <input class="form-control" type="text" name="" id="title">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <h4 class="title">Cliente</h4>
            <select id="customer" class="form-control">
                <option> Elije una opcion</option>
                <?php  $users = get_users( array('role__in' => "customer") ); foreach ( $users as $user ) { $usermeta = get_user_meta($user->id); ?>
                    <option value="<?php echo $user->id; ?>"> <?php echo $user->id.' - '.$user->billing_first_name.' - '.$user->billing_last_name;  ?></option>
                <?php } ?>
            </select>
            <br />
            <dl class="row">
                <?php $user = get_user_by( 'id', 3 ); $usermeta = get_user_meta($user->ID); ?>
                <dt class="col-sm-2">Telefono:</dt>
                <dd class="col-sm-10"><div id="telefono"></div></dd>

                <dt class="col-sm-2">Correo:</dt>
                <dd class="col-sm-10"><div id="correo"></div></dd>

                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10"><div id="login"></div></dd>
            </dl>
        </div>
        <div class="col-sm-6">
            <h4 class="title">Producto</h4>
            
            <select id="product" class="form-control">
                <option> Elije una opcion</option>
                <?php  $products = wc_get_products(array('orderby' => 'date', 'order' => 'DESC')); foreach ( $products as $product ) { $product_meta = wc_get_product($product->get_id() ); ?>
                    <option value="<?php echo $product->id; ?>"> <?php echo $product->id.' - '.$product->name;  ?></option>
                <?php } ?>
            </select>
            <br />
            <dl class="row">    
                <dt class="col-sm-2">Precio</dt>
                <dd class="col-sm-10"><div id="precio"></div></dd>

                <dt class="col-sm-2">titulo</dt>
                <dd class="col-sm-10"> <div id="product_title"></div></dd>

                <dt class="col-sm-2">Link</dt>
                <dd class="col-sm-10"><div id="descripcion"></div></dd>
            </dl>

        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-6">
            <h4 class="title">Plan de Pago</h4>
            <select id="term" class="form-control">
                <option> Elije una opcion</option>
                <?php  $terms = get_terms(array('taxonomy' => 'wcdp_payment_plan', 'hide_empty' => false)); foreach ( $terms as $term ) {  ?>
                    <option value="<?php echo $term->term_id; ?>"> <?php echo $term->term_id.' - '.esc_attr($term->name);  ?></option>
                <?php } ?>
            </select>
            <br />
            <dl class="row">
                    <dt class="col-sm-2"><?php echo 'Titulo:'; ?></dt>
                    <dd class="col-sm-10"><div id="term_title"></div></dd>

                    <dt class="col-sm-2"><?php echo 'Inicial:'; ?></dt>
                    <dd class="col-sm-10"><div id="deposit_percentage"></div></dd>

                    <dt class="col-sm-2"><?php echo 'Detalles:'; ?></dt>
                    <dd class="col-sm-10"><div id="payment_details"></div></dd>
            </dl>
        </div>
        <div class="col-sm-6">
            <h4 class="title">Notificaciones</h4>
            <br />
            <form>
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Whatsapp Web
                    </span>
                </label> 
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Correo Electronico
                    </span>
                </label>
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" value="" disabled>
                    <span class="form-check-label">
                        --- Telegram
                    </span>
                </label>
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" value="" disabled>
                    <span class="form-check-label">
                        --- SMS
                    </span>
                </label>
                <p>Marca las opciones para enviar una notificacion al cliente.</p>
            </form>
        </div>
    </div>

    <hr />
    <div class="row">
        <div class="col-sm-12">
            <button onclick="save()" class="btn btn-sm btn-dark">Guardar y Enviar</button>
            <button onclick="list()" class="btn btn-sm">Cancelar</button>

        </div>
    </div>
</div>

<script>
    $( "#customer" ).change(function() {
        let id= this.value;
        $.ajax({
            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
            dataType: "json",
            data: { "user_id": id },
            success: function (response) {
                console.log(response);
                $('#telefono').html(response.billing_phone);
                $('#correo').html(response.user_email);
                $('#login').html(response.billing_first_name+' - '+response.billing_last_name );
                
                $.notify("Cambio de Cliente ", "success");	
            }		
        });
    });

    $( "#product" ).change(function() {
        let id= this.value;
        $.ajax({
            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
            dataType: "json",
            data: { "product_id": id },
            success: function (response) {
                console.log(response);
                $('#precio').html(response.price);
                $('#product_title').html(response.name);
                $('#descripcion').html(response.link);
                
                $.notify("Cambio de Producto ", "success");	
            }		
        });
    });

    $( "#term" ).change(function() {
        let id= this.value;
        $.ajax({
            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
            dataType: "json",
            data: { "term_id": id },
            success: function (response) {
                console.log(response);
                $("#deposit_percentage").html(response.deposit_percentage+' %');
                $("#term_title").html(response.title);
                // let aux = JSON.parse(response.payment_details);
                // let aux_html = '';
                // for (let i = 0; i < aux['payment-plan'].length; i++) {
                //     aux_html = aux_html + '<p>Importe: '+aux['payment-plan'][i].percentage+'</p>';
                // }
                $("#payment_details").html(response.payment_details);
                $.notify("Cambio de Plan de Pagos ", "success");	
            }		
        });
    });
    function save(){
        let title = $("#title").val();
        
        let customer = $("#customer").val();
        let product = $("#product").val();
        let term = $("#term").val();

        let customer_name = $("#login").text();
        let product_name = $("#product_title").text();
        let term_name = $("#term_title").text();

        let phone = $("#telefono").text();
        let link = $("#descripcion").text();

        // console.log(customer);
        $.ajax({
            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/proformas.php",
            data: { "save": true, "title": title, "customer": customer, "product": product, "term": term, "customer_name": customer_name, "product_name": product_name, "term_name": term_name },
            success: function () {

                let wusap = 'ℹ Proforma # 450 ℹ\n'; 
                wusap = wusap + 'Cliente: '+customer_name+'\n'; 
                wusap = wusap + 'Producto: '+product_name+'\n'; 
                wusap = wusap + '--------Plan de Pagos-------- \n'; 
                wusap = wusap + term_name+'\n'; 
                wusap = wusap + '-------------------------------------- \n'; 
                wusap = wusap + 'Mas informacion: '+link+'\n'; 
                wusap = wusap + '🇧🇴Honda Prada - BENI BOLIVIA🇧🇴'; 

                $.ajax({
                    url: "http://localhost:3000",
                    data: {"message": wusap, "phone": phone, "type": "text"  },
                    success: function () {
                        $.notify("Enviando proforma", "success");
                        // list();
                    }
                });
                list();
            }
        });
        
    }
</script>
