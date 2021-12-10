
<?php 
    require_once('../../../../wp-load.php');
?>
<br />
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="title">Nueva Proforma
                <button onclick="save()" class="btn btn-sm btn-dark">Guardar</button>
                <button onclick="list()" class="btn btn-sm">Cancelar</button>
            </h3>
            <hr />
        </div>
    </div>

    <div class="row">

        <div class="col-sm-6">
            <h4 class="title">Producto</h4>
            
            <select id="product" class="form-control">
                <option value="0" > Elije una opcion</option>
                <?php  $products = wc_get_products(array('orderby' => 'date', 'order' => 'DESC', 'limit' => -1)); foreach ( $products as $product ) { $product_meta = wc_get_product($product->get_id() ); ?>
                    <option value="<?php echo $product->id; ?>"> <?php echo $product->id.' - '.$product->name;  ?></option>
                <?php } ?>
            </select>
            <br />
            <dl class="row">    
                <dt class="col-sm-2">Precio:</dt>
                <dd class="col-sm-10"><div id="precio"></div></dd>

                <dt class="col-sm-2">Titulo:</dt>
                <dd class="col-sm-10"> <div id="product_title"></div></dd>

                <dt class="col-sm-2">Descrpcion:</dt>
                <dd class="col-sm-10"><div id="product_description"></div></dd>

                <dt class="col-sm-2">Tienda:</dt>
                <div id="description" hidden></div>
                <dd class="col-sm-10"><div id="product_link"></div></dd>
            </dl>

        </div>
        <div class="col-sm-6">
            <div id="product_img"></div>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-4">
            <h4 class="title">Requisitos</h4>
            <div class="form-group">
                <label for="">Cantidad de  Garantes</label>
                <input class="form-control" type="number" name="" id="garante" value="2">
            </div>
            <p>Para el Clientes y los Garantes</p>
        </div>
        <div class="col-sm-4">
            <h4 class="title">Dependientes</h4>
            <form>
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="fci" checked>
                    <span class="form-check-label">
                        --- Fotocopia Carnet de Identidad a Color
                    </span>
                </label> 
                <label class="form-check">
                    <input class="form-check-input" type="checkbox" id="ubs"  value="" checked>
                    <span class="form-check-label">
                        --- Ultima Boleta de Sueldo, Planilla o Certificado de trabajo
                    </span>
                </label>
                <label class="form-check">
                    <input class="form-check-input" id="cfl" type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Copia de Factura de luz del Domicilio
                    </span>
                </label>
                <label class="form-check">
                    <input class="form-check-input" id="cdt" type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Croquis Domicilio y Trabajo
                    </span>
                </label>
                <label class="form-check">
                    <input class="form-check-input" id="afp" type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Extracto de  AFP
                    </span>
                </label>
            </form>
        </div>
        <div class="col-sm-4">
            <h4 class="title">Independientes</h4>
            <!-- <form> -->
                <label class="form-check">
                    <input class="form-check-input" id="fci2" type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Fotocopia de Carnet de Identidad a Color
                    </span>
                </label> 
                <label class="form-check">
                    <input class="form-check-input" id="nit"  type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Fotocopia de NIT o Licencia de Funcionamiento
                    </span>
                </label>
                <label class="form-check">
                    <input class="form-check-input" id="cfd"  type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Copia Factura de Luz del Domicilio
                    </span>
                </label>
            <!-- </form> -->
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-4">
            <h4 class="title">Plan de Pago</h4>
            <div class="form-group">
                <label for="">Cuota Inicial</label>
                <input class="form-control" type="number" name="" id="inicial" value="0">
            </div>
            <div class="form-group">
                <label for="">Cuota Mensual</label>
                <input class="form-control" type="number" name="" id="mensual" value="0">
            </div>
            <div class="form-group">
                <label for="">Plazo</label>
                <input class="form-control" type="text" name="" id="plazo" value="0 Meses">
            </div>
            
        </div>
        <div class="col-sm-4">
            <h4 class="title">Cliente</h4>
            <div class="form-group">
                <label for="">Telefono (whatsapp)</label>
                <input class="form-control" type="number" name="" id="telefono" value="" placeholder="Escribe el telefono y presiona enter">
            </div>
            <div class="form-group">
                <label for="">Nombres</label>
                <input class="form-control" type="text" name="" id="nombre" value="">
            </div>
            <div class="form-group">
                <label for="">Apellidos</label>
                <input class="form-control" type="text" name="" id="apellido" value="">
            </div>
            
        </div>
        <div class="col-sm-4">
            <h4 class="title">Incluye</h4>
            <form>
                <label class="form-check">
                    <input class="form-check-input" id="soat" type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- SOAT 2021
                    </span>
                </label> 
                <label class="form-check">
                    <input class="form-check-input" id="garantia" type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Garantia de 1 Año o 10.000 KM
                    </span>
                </label>
                <label class="form-check">
                    <input class="form-check-input"  id="mantenimiento" type="checkbox" value="" checked>
                    <span class="form-check-label">
                        --- Primer Mantenimiento Gratis a los 1.500 KM
                    </span>
                </label>
            </form>
        </div>
     
    </div>
    <hr />
    <div class="row">
        <div class="col-sm-12">
            <button onclick="save()" class="btn btn-sm btn-dark">Guardar</button>
            <button onclick="list()" class="btn btn-sm">Cancelar</button>

        </div>
    </div>
</div>

<script>

    $( "#product" ).change(function() {
        let product = $("#product").val();
        console.log(product);
        let id= this.value;
        $.ajax({
            url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
            dataType: "json",
            data: { "product_id": id },
            success: function (response) {
                
                $('#precio').html(response.price);
                $('#product_title').html(response.name);
                $('#product_description').html(response.description);
                $('#product_img').html("<img class='img-thumbnail' src='"+response.image+"' />");
                $('#product_link').html("<a class='btn btn-sm' href='"+response.link+"' > Ver en Tienda </a>");
                
                $.notify("Cambio de Producto ", "success");	
            }		
        });
    });


    function save(){

        let product = $("#product").val();

        let garante = $("#garante").val();
        let fci = $("#fci").is(":checked") ? 'true' : 'false';
        let ubs = $("#ubs").is(":checked") ? 'true' : 'false';
        let cfl = $("#cfl").is(":checked") ? 'true' : 'false';
        let cdt = $("#cdt").is(":checked") ? 'true' : 'false';
        let afp = $("#afp").is(":checked") ? 'true' : 'false';

        let fci2 = $("#fci2").is(":checked") ? 'true' : 'false';
        let nit = $("#nit").is(":checked") ? 'true' : 'false';
        let cfd = $("#cfd").is(":checked") ? 'true' : 'false';

        let inicial = $("#inicial").val();
        let mensual = $("#mensual").val();
        let plazo = $("#plazo").val();

        let nombre = $("#nombre").val();
        let apellido = $("#apellido").val();
        let telefono = $("#telefono").val();

        let soat = $("#soat").is(":checked") ? 'true' : 'false';
        let garantia = $("#garantia").is(":checked") ? 'true' : 'false';
        let mantenimiento = $("#mantenimiento").is(":checked") ? 'true' : 'false';
        
        var midata = { "save": true, 
                "product": product, 
                "garante": garante,
                "fci": fci, "ubs": ubs, "cfl": cfl, "cdt": cdt, "afp": afp, 
                "fci2": fci2, "nit": nit, "cfd": cfd, 
                "inicial": inicial, "mensual": mensual, "plazo": plazo, 
                "nombre": nombre, "apellido": apellido, "telefono": telefono, 
                "soat": soat, "garantia": garantia, "mantenimiento": mantenimiento};
        var dataString = JSON.stringify(midata);
        
        
        if (product == 0 || garante == '' || inicial == '' || mensual == '' || plazo == '' || nombre == '' || mensual == '' || telefono == '') {
            $.notify("Rellene todos los Campos", "info");
        } else {
            if (confirm('Desea Gaurdar la Proforma?')) {
                $.ajax({
                    url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/proformas.php",
                    dataType: "json",
                    data: {"midata": dataString},
                    success: function (response) {
                        if (response.error) {
                            $.notify(response.error, "warn")
                        } else {
                            list();
                        }
                    }
                });
            } else {
                list();
            }
         
        }
  
    }

    $("#telefono").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13 || e.keyCode === 9 || e.key === 'Tab') {
            let telefono = $("#telefono").val();
            $.ajax({
                url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
                dataType: 'json',
                data: {"telefono": telefono},
                success: function (response) {
                    $("#nombre").val(response.nombre);
                    $("#apellido").val(response.apellido);
                    console.log(response.id);
                    if (response.id == null) {
                        $.notify("Cliente NO Encontrado", "success");
                    }else{
                        $.notify("Cliente Encontrado", "success");
                    }
                }
            });
        }
    });
</script>
