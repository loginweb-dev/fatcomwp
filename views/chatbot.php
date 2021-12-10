<?php
function chatbot() {
    ?>
    <title>Whatsapp</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/jquery-2.0.0.min.js" type="text/javascript"></script>
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/fonts/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/ui.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/resources/js/script.js" type="text/javascript"></script>
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/library/wp_media_uploader.js" type="text/javascript"></script>
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/library/notify.js" type="text/javascript"></script>
    <br />
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h4 class="title">Enviar mensaje con (iBy) el Chatbot</h4>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="card">
                        <article class="card-group-item">
                            <header class="card-header">
                                <h6 class="title">CLIENTE 
                                    <br />
                                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter"> Nuevo </a>
                                </h6>
                            </header>
                            <div class="card-body">
                                <select id="customer" class="form-control">
                                    <option> Elije una opcion</option>
                                    <?php  $users = get_users( 'orderby=user_registered&order=DESCC&role=customer', array('role__in' => "customer") ); foreach ( $users as $user ) { $usermeta = get_user_meta($user->id); ?>
                                        <option value="<?php echo $user->id; ?>"> <?php echo $user->id.' - '.$user->billing_first_name.' '.$user->billing_last_name.' - '.$user->billing_phone;  ?></option>
                                    <?php } ?>
                                </select>
                                <dl class="row" hidden>
                                    <dt class="col-sm-3">Telefono:</dt>
                                    <dd class="col-sm-9"><div id="telefono"></div></dd>

                                    <dt class="col-sm-3">Correo:</dt>
                                    <dd class="col-sm-9"><div id="correo"></div></dd>

                                    <dt class="col-sm-3">Nombre:</dt>
                                    <dd class="col-sm-9"><div id="login"></div></dd>
                                </dl>
                                <hr />
                                <h6 class="title">Producto</h6>
                                <select id="product" class="form-control">
                                    <option value="0" > Elije una opcion</option>
                                    <?php  $products = wc_get_products(array('orderby' => 'date', 'order' => 'DESC', 'limit' => -1)); foreach ( $products as $product ) { $product_meta = wc_get_product($product->get_id() ); ?>
                                        <option value="<?php echo $product->id; ?>"> <?php echo $product->id.' - '.$product->name;  ?></option>
                                    <?php } ?>
                                </select> 
                                <hr />
                                <h6 class="title">Pedidos</h6>
                                <select id="product" class="form-control">
                                    <option value="0" > Elije una opcion</option>
                                    <?php  $products = wc_get_products(array('orderby' => 'date', 'order' => 'DESC', 'limit' => -1)); foreach ( $products as $product ) { $product_meta = wc_get_product($product->get_id() ); ?>
                                        <option value="<?php echo $product->id; ?>"> <?php echo $product->id.' - '.$product->name;  ?></option>
                                    <?php } ?>
                                </select>
                                <hr />
                                <h6 class="title">Cupon o Promocion</h6>
                                <select id="product" class="form-control">
                                    <option value="0" > Elije una opcion</option>
                                    <?php  $products = wc_get_products(array('orderby' => 'date', 'order' => 'DESC', 'limit' => -1)); foreach ( $products as $product ) { $product_meta = wc_get_product($product->get_id() ); ?>
                                        <option value="<?php echo $product->id; ?>"> <?php echo $product->id.' - '.$product->name;  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </article>
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="card">
                        <article class="card-group-item">
                            <header class="card-header">
                                <h6 class="title">CHAT - <small>Copia y Pega los Emojis!</small>
                                    <br />
                                    <a class="btn btn-sm btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Smileys
                                    </a>
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">Gestures</button>
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">People</button>
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4">Clothing</button>
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5">Objects</button>
                                        
                                </h6>
                                
                            </header>
                            <div class="card-body">
                                    <div class="collapse multi-collapse" id="collapseExample">
                                        
                                        😀 😃 😄 😁 😆 😅 😂 🤣 🥲 ☺️ 😊 😇 🙂 🙃 😉 😌 😍 🥰 😘 😗 😙 😚 😋 😛 😝 😜 🤪 🤨 🧐 🤓 😎 🥸 🤩 🥳 😏 😒 😞 😔 😟 😕 🙁 ☹️ 😣 😖 😫 😩 🥺 😢 😭 😤 😠 😡 🤬 🤯 😳 🥵 🥶 😱 😨 😰 😥 😓 🤗 🤔 🤭 🤫 🤥 😶 😐 😑 😬 🙄 😯 😦 😧 😮 😲 🥱 😴 🤤 😪 😵 🤐 🥴 🤢 🤮 🤧 😷 🤒 🤕 🤑 🤠 😈 👿 👹 👺 🤡 💩 👻 💀 ☠️ 👽 👾 🤖 🎃 😺 😸 😹 😻 😼 😽 🙀 😿 😾
                                        
                                    </div>
                                    <div class="collapse multi-collapse" id="collapseExample2">
                                        
                                        👋 🤚 🖐 ✋ 🖖 👌 🤌 🤏 ✌️ 🤞 🤟 🤘 🤙 👈 👉 👆 🖕 👇 ☝️ 👍 👎 ✊ 👊 🤛 🤜 👏 🙌 👐 🤲 🤝 🙏 ✍️ 💅 🤳 💪 🦾 🦵 🦿 🦶 👣 👂 🦻 👃 🫀 🫁 🧠 🦷 🦴 👀 👁 👅 👄 💋 🩸
                                        
                                    </div>
                                    <div class="collapse multi-collapse" id="collapseExample3">
                                        
                                        👶 👧 🧒 👦 👩 🧑 👨 👩‍🦱 🧑‍🦱 👨‍🦱 👩‍🦰 🧑‍🦰 👨‍🦰 👱‍♀️ 👱 👱‍♂️ 👩‍🦳 🧑‍🦳 👨‍🦳 👩‍🦲 🧑‍🦲 👨‍🦲 🧔 👵 🧓 👴 👲 👳‍♀️ 👳 👳‍♂️ 🧕 👮‍♀️ 👮 👮‍♂️ 👷‍♀️ 👷 👷‍♂️ 💂‍♀️ 💂 💂‍♂️ 🕵️‍♀️ 🕵️ 🕵️‍♂️ 👩‍⚕️ 🧑‍⚕️ 👨‍⚕️ 👩‍🌾 🧑‍🌾 👨‍🌾 👩‍🍳 🧑‍🍳 👨‍🍳 👩‍🎓 🧑‍🎓 👨‍🎓 👩‍🎤 🧑‍🎤 👨‍🎤 👩‍🏫 🧑‍🏫 👨‍🏫 👩‍🏭 🧑‍🏭 👨‍🏭 👩‍💻 🧑‍💻 👨‍💻 👩‍💼 🧑‍💼 👨‍💼 👩‍🔧 🧑‍🔧 👨‍🔧 👩‍🔬 🧑‍🔬 👨‍🔬 👩‍🎨 🧑‍🎨 👨‍🎨 👩‍🚒 🧑‍🚒 👨‍🚒 👩‍✈️ 🧑‍✈️ 👨‍✈️ 👩‍🚀 🧑‍🚀 👨‍🚀 👩‍⚖️ 🧑‍⚖️ 👨‍⚖️ 👰‍♀️ 👰 👰‍♂️ 🤵‍♀️ 🤵 🤵‍♂️ 👸 🤴 🥷 🦸‍♀️ 🦸 🦸‍♂️ 🦹‍♀️ 🦹 🦹‍♂️ 🤶 🧑‍🎄 🎅 🧙‍♀️ 🧙 🧙‍♂️ 🧝‍♀️ 🧝 🧝‍♂️ 🧛‍♀️ 🧛 🧛‍♂️ 🧟‍♀️ 🧟 🧟‍♂️ 🧞‍♀️ 🧞 🧞‍♂️ 🧜‍♀️ 🧜 🧜‍♂️ 🧚‍♀️ 🧚 🧚‍♂️ 👼 🤰 🤱 👩‍🍼 🧑‍🍼 👨‍🍼 🙇‍♀️ 🙇 🙇‍♂️ 💁‍♀️ 💁 💁‍♂️ 🙅‍♀️ 🙅 🙅‍♂️ 🙆‍♀️ 🙆 🙆‍♂️ 🙋‍♀️ 🙋 🙋‍♂️ 🧏‍♀️ 🧏 🧏‍♂️ 🤦‍♀️ 🤦 🤦‍♂️ 🤷‍♀️ 🤷 🤷‍♂️ 🙎‍♀️ 🙎 🙎‍♂️ 🙍‍♀️ 🙍 🙍‍♂️ 💇‍♀️ 💇 💇‍♂️ 💆‍♀️ 💆 💆‍♂️ 🧖‍♀️ 🧖 🧖‍♂️ 💅 🤳 💃 🕺 👯‍♀️ 👯 👯‍♂️ 🕴 👩‍🦽 🧑‍🦽 👨‍🦽 👩‍🦼 🧑‍🦼 👨‍🦼 🚶‍♀️ 🚶 🚶‍♂️ 👩‍🦯 🧑‍🦯 👨‍🦯 🧎‍♀️ 🧎 🧎‍♂️ 🏃‍♀️ 🏃 🏃‍♂️ 🧍‍♀️ 🧍 🧍‍♂️ 👭 🧑‍🤝‍🧑 👬 👫 👩‍❤️‍👩 💑 👨‍❤️‍👨 👩‍❤️‍👨 👩‍❤️‍💋‍👩 💏 👨‍❤️‍💋‍👨 👩‍❤️‍💋‍👨 👪 👨‍👩‍👦 👨‍👩‍👧 👨‍👩‍👧‍👦 👨‍👩‍👦‍👦 👨‍👩‍👧‍👧 👨‍👨‍👦 👨‍👨‍👧 👨‍👨‍👧‍👦 👨‍👨‍👦‍👦 👨‍👨‍👧‍👧 👩‍👩‍👦 👩‍👩‍👧 👩‍👩‍👧‍👦 👩‍👩‍👦‍👦 👩‍👩‍👧‍👧 👨‍👦 👨‍👦‍👦 👨‍👧 👨‍👧‍👦 👨‍👧‍👧 👩‍👦 👩‍👦‍👦 👩‍👧 👩‍👧‍👦 👩‍👧‍👧 🗣 👤 👥 🫂
                                        
                                    </div>
                                    <div class="collapse multi-collapse" id="collapseExample4">      
                                        🧳 🌂 ☂️ 🧵 🪡 🪢 🧶 👓 🕶 🥽 🥼 🦺 👔 👕 👖 🧣 🧤 🧥 🧦 👗 👘 🥻 🩴 🩱 🩲 🩳 👙 👚 👛 👜 👝 🎒 👞 👟 🥾 🥿 👠 👡 🩰 👢 👑 👒 🎩 🎓 🧢 ⛑ 🪖 💄 💍 💼
                                    </div>
                                    <div class="collapse multi-collapse" id="collapseExample5">      
                                        ⌚️ 📱 📲 💻 ⌨️ 🖥 🖨 🖱 🖲 🕹 🗜 💽 💾 💿 📀 📼 📷 📸 📹 🎥 📽 🎞 📞 ☎️ 📟 📠 📺 📻 🎙 🎚 🎛 🧭 ⏱ ⏲ ⏰ 🕰 ⌛️ ⏳ 📡 🔋 🔌 💡 🔦 🕯 🪔 🧯 🛢 💸 💵 💴 💶 💷 🪙 💰 💳 💎 ⚖️ 🪜 🧰 🪛 🔧 🔨 ⚒ 🛠 ⛏ 🪚 🔩 ⚙️ 🪤 🧱 ⛓ 🧲 🔫 💣 🧨 🪓 🔪 🗡 ⚔️ 🛡 🚬 ⚰️ 🪦 ⚱️ 🏺 🔮 📿 🧿 💈 ⚗️ 🔭 🔬 🕳 🩹 🩺 💊 💉 🩸 🧬 🦠 🧫 🧪 🌡 🧹 🪠 🧺 🧻 🚽 🚰 🚿 🛁 🛀 🧼 🪥 🪒 🧽 🪣 🧴 🛎 🔑 🗝 🚪 🪑 🛋 🛏 🛌 🧸 🪆 🖼 🪞 🪟 🛍 🛒 🎁 🎈 🎏 🎀 🪄 🪅 🎊 🎉 🎎 🏮 🎐 🧧 ✉️ 📩 📨 📧 💌 📥 📤 📦 🏷 🪧 📪 📫 📬 📭 📮 📯 📜 📃 📄 📑 🧾 📊 📈 📉 🗒 🗓 📆 📅 🗑 📇 🗃 🗳 🗄 📋 📁 📂 🗂 🗞 📰 📓 📔 📒 📕 📗 📘 📙 📚 📖 🔖 🧷 🔗 📎 🖇 📐 📏 🧮 📌 📍 ✂️ 🖊 🖋 ✒️ 🖌 🖍 📝 ✏️ 🔍 🔎 🔏 🔐 🔒 🔓
                                    </div>
                                <!-- <small>Copia y Pega los Emojis!</small> -->
                                <textarea class="form-control" name="" id="message" rows="8"></textarea>
                                <!-- <br /> -->
                               
                                <div class="form-group smartcat-uploader">
                                    <input class="form-control" type="text" name="" id="attachment" readonly>                                    
                                </div> 
                                <div class="form-group">
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="option1" checked>
                                        <span class="form-check-label"> Texto </span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" value="option2">
                                        <span class="form-check-label"> Medio </span>
                                    </label>
                                    <a href="#" class="btn btn-sm btn-dark" onclick="wusap()">Enviar Whatsapp</a>
                                </div> <!-- form-group end.// -->
                                
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <!-- <div class="card"> -->
                        <article class="card-group-item">
                            <header class="card-header">
                                <h6 class="title">Configuracion</h6>
                            </header>
                            <div class="card-body">
                            Cantidad de Clientes: <?php echo count(get_users( array('role__in' => "customer") )); ?>
                            <hr />
                            <div class="form-group">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="filtro" value="option1" checked>
                                    <span class="form-check-label"> Todos </span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="filtro" value="option2">
                                    <span class="form-check-label"> Ultimos 100 </span>
                                </label>
                            </div> <!-- form-group end.// -->
                            <hr />
                            <a href="#" class="btn btn-sm btn-dark" onclick="wusap_masivo()">Enviar Whatsapp Masivo</a>
                            </div>
                        </article>
                    <!-- </div> -->
                </div>
            </div>
            <div class="col-sm-6">
                <table class="table table-striped">
                    <thead class="">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <!-- <th scope="col">Acciones</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php $users = get_users( 'orderby=user_registered&order=DESC&role=customer', array('role__in' => "customer")); foreach($users as $user) { $usermeta = get_user_meta($user->id); ?>
                        <tr>
                            <td>
                                <?php echo '# '.$user->ID; ?>
                            </td>
                            <td>
                                <small>
                                    <?php echo $user->first_name.' '.$user->last_name; ?>
                                    <br />
                                    <?php echo $usermeta['billing_phone'][0]; ?>
                                    <br />
                                    <?php echo $user->user_email; ?>
                                    <br />
                                    <?php echo $user->user_registered; ?>
                                </small>
                            </td>
                            <td>
                
                            <td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Telefono (whatsapp)</label>
                    <input class="form-control" type="number" name="" id="phone" value="" placeholder="Escribe el telefono y presiona enter" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Nombres</label>
                    <input class="form-control" type="text" name="" id="first_name" value="">
                </div>
                <div class="form-group">
                    <label for="">Apellidos</label>
                    <input class="form-control" type="text" name="" id="last_name" value="">
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cerrar</button> -->
                <button type="button" onclick="save()" class="btn btn-sm btn-primary">Guardar</button>
            </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.notify.defaults({globalPosition: 'bottom right'});
            $.wpMediaUploader({
                target : '.smartcat-uploader', // The class wrapping the textbox
                uploaderTitle : 'Seleccione o suba image', // The title of the media upload popup
                uploaderButton : 'Elije el Archivo', // the text of the button in the media upload popup
                multiple : false, // Allow the user to select multiple images
                buttonText : 'Adjuntar Medio', // The text of the upload button
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
            $("#message").focus();
        }); 
        
        function wusap(){
            var selectedOption = $("input:radio[name=gender]:checked").val();
            let phone =  $('#telefono').text();
            let customer = $('#customer').val();
            console.log(selectedOption+'mierda');
            if(selectedOption == 'option1') {
                let text = $('#message').val();
                console.log(phone);
                $.ajax({
                    url: "http://localhost:3001",
                    data: {"message": text, "phone": phone, "type": "text" },
                    success: function () {
                
                    },
                    error: function (error) {
                        $.notify("Mesaje enviado al #"+phone, "success");
                        $("#message").val('');
                        $("#attachment").val('');
                        $('#message').focus();
                    }
                });
            } else if(selectedOption == 'option2') {
                let text = $('#message').val();
                let attachment = $('#attachment').val();
                console.log(attachment);
                $.ajax({
                    url: "http://localhost:3001",
                    data: {"message": text, "phone": phone, "type": "galery", "attachment": attachment },
                    success: function (response) {
                        $.notify(response, "info");
                    },
                    error: function (error) {
                        $.notify("Mesaje enviado al #"+phone, "success");
                        $("#message").val('');
                        $("#attachment").val('');
                        $('#message').focus();
                    }
                });
            }
    
            // $.notify("Mesaje enviado al"+phone, "success");
            // $("#message").val('');
            // $("#attachment").val('');
            // $('#message').focus();
        }
        function wusap_masivo(){
            $('#message').focus();
            // console.log('hola');
            $.ajax({
                url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
                dataType: "json",
                data: {"users_customer": true },
                success: function (response) {
                    for(var i in response){
                        (function(index) {
                            setTimeout(function() { 
                                console.log(index); 
                                console.log(i); 
                                // for(var i in response){
                                    let phone =  response[index].billing_phone;
                                    let text = $('#message').val();
                                    $.ajax({
                                        url: "http://localhost:3001",
                                        data: {"message": text, "phone": phone, "type": "galery" },
                                        success: function () {
                                            
                                        }
                                    });
                                    console.log(response[index].billing_phone);
                                    $.notify("Mesaje enviado", "success");
                                // }
                            }, i * 10000);
                        })(i);
                    }
                    // console.log(response);
                
                }
            });
        }

        $( "#customer" ).change(function() {
            let id= this.value;
            let text = $('#customer :selected').text();
            $.ajax({
                url: "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/search.php",
                dataType: "json",
                data: { "user_id": id },
                success: function (response) {
                    console.log(response);
                    $('#telefono').html(response.billing_phone);
                    $('#correo').html(response.user_email);
                    $('#login').html(response.billing_first_name+' - '+response.billing_last_name );
                    
                    $.notify(text, "success");	
                }		
            });
        });
        $("#button").click(function() {
            let sms = $("#message").val();
            $("#message").val(sms+'<img src="https://cdn.okccdn.com/media/img/emojis/apple/1F60C.png"/>');
        });

        function save(){
            // console.log('Hola');
            let phone = $('#phone').val();
            let first_name = $('#first_name').val();
            let last_name = $('#last_name').val();
            let urli = "<?php echo WP_PLUGIN_URL; ?>/fatcomwp/controller/customer.php";
            console.log(urli);
            $.ajax({
                url: urli,
                dataType: "json",
                data: {"save": true, "phone": phone, "first_name": first_name, "last_name": last_name},
                success: function (response) {
                    if (response.error) {
                        $.notify(response.error, "warn");
                    } else {
                        $("#customer").append('<option value='+response.id+' selected>'+response.first_name+' '+response.last_name+' - '+response.billing_phone+'</option>');
                        $('#exampleModalCenter').modal('toggle');
                        $('#phone').val('');
                        $('#first_name').val('');
                        $('#last_name').val('');
                        $.notify(response.message, "info");
                    }
                }
            });
        }
        $("#phone").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13 || e.keyCode === 9 || e.key === 'Tab') {
                let telefono = $("#phone").val();
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
                        $('#first_name').focus();
                    }
                });
            }
        });

        $("#last_name").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                save();
            }
        });
        $("#first_name").on('keyup', function (e) {
            if (e.key === 'Enter' || e.keyCode === 13) {
                $('#last_name').focus();
            }
        });

    </script>

    <?php
}

