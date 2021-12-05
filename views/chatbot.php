<?php
function chatbot() {
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
    <script src="<?php echo WP_PLUGIN_URL; ?>/fatcomwp/library/notify.js" type="text/javascript"></script>
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="title">Enviar mensaje con (iBy) el Chatbot</h4>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">

                    <div class="card">
                        
                        <article class="card-group-item">
                            <header class="card-header">
                                <h6 class="title">Cliente </h6>
                            </header>
                            <div class="card-body">
                                <!-- <form> -->
                                    <!-- <div class="form-row">
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadio" value="" checked>
                                            <span class="form-check-label">
                                                --- Texto
                                            </span>
                                        </label>
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                            <span class="form-check-label">
                                                --- Galegria
                                            </span>
                                        </label>
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                            <span class="form-check-label">
                                                --- Ubicacion
                                            </span>
                                        </label>
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                            <span class="form-check-label">
                                                --- Catalogo
                                            </span>
                                        </label>
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                            <span class="form-check-label">
                                                --- Audio
                                            </span>
                                        </label>
                                        <label class="form-check">
                                            <input class="form-check-input" type="radio" name="exampleRadio" value="">
                                            <span class="form-check-label">
                                                --- Contacto
                                            </span>
                                        </label>
                                    </div> -->
                                <!-- </form> -->
                                <!-- <hr /> -->
                                <!-- <br /> -->
                                <!-- <label>Cliente</label> -->
                                <select id="customer" class="form-control">
                                    <option> Elije una opcion</option>
                                    <?php  $users = get_users( array('role__in' => "customer") ); foreach ( $users as $user ) { $usermeta = get_user_meta($user->id); ?>
                                        <option value="<?php echo $user->id; ?>"> <?php echo $user->id.' - '.$user->billing_first_name.' - '.$user->billing_last_name;  ?></option>
                                    <?php } ?>
                                </select>
                                <br />
                                <dl class="row">
                                    <dt class="col-sm-3">Telefono:</dt>
                                    <dd class="col-sm-9"><div id="telefono"></div></dd>

                                    <dt class="col-sm-3">Correo:</dt>
                                    <dd class="col-sm-9"><div id="correo"></div></dd>

                                    <dt class="col-sm-3">Nombre:</dt>
                                    <dd class="col-sm-9"><div id="login"></div></dd>
                                </dl>

                            </div> <!-- card-body.// -->
                        </article> <!-- card-group-item.// -->
                    </div> <!-- card.// -->

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="card">
                        <article class="card-group-item">
                            <header class="card-header">
                                <h6 class="title">Texto y Adjuntos</h6>
                            </header>
                            <!-- <button id="button">Add Emoji</button> -->
                            <div class="card-body smartcat-uploader">
                                <p>
                                    <a class="btn btn-sm btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Smileys
                                    </a>
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">Gestures</button>
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">People</button>
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample4" aria-expanded="false" aria-controls="collapseExample4">Clothing</button>
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample5" aria-expanded="false" aria-controls="collapseExample5">Objects</button>
                                        
                                </p>
                                <!-- <div class="row"> -->
                                    <!-- <div class="col"> -->
                                        <div class="collapse multi-collapse" id="collapseExample">
                                          
                                            😀 😃 😄 😁 😆 😅 😂 🤣 🥲 ☺️ 😊 😇 🙂 🙃 😉 😌 😍 🥰 😘 😗 😙 😚 😋 😛 😝 😜 🤪 🤨 🧐 🤓 😎 🥸 🤩 🥳 😏 😒 😞 😔 😟 😕 🙁 ☹️ 😣 😖 😫 😩 🥺 😢 😭 😤 😠 😡 🤬 🤯 😳 🥵 🥶 😱 😨 😰 😥 😓 🤗 🤔 🤭 🤫 🤥 😶 😐 😑 😬 🙄 😯 😦 😧 😮 😲 🥱 😴 🤤 😪 😵 🤐 🥴 🤢 🤮 🤧 😷 🤒 🤕 🤑 🤠 😈 👿 👹 👺 🤡 💩 👻 💀 ☠️ 👽 👾 🤖 🎃 😺 😸 😹 😻 😼 😽 🙀 😿 😾
                                           
                                        </div>
                                    <!-- </div> -->
                                
                                    <!-- <div class="col"> -->
                                        <div class="collapse multi-collapse" id="collapseExample2">
                                           
                                            👋 🤚 🖐 ✋ 🖖 👌 🤌 🤏 ✌️ 🤞 🤟 🤘 🤙 👈 👉 👆 🖕 👇 ☝️ 👍 👎 ✊ 👊 🤛 🤜 👏 🙌 👐 🤲 🤝 🙏 ✍️ 💅 🤳 💪 🦾 🦵 🦿 🦶 👣 👂 🦻 👃 🫀 🫁 🧠 🦷 🦴 👀 👁 👅 👄 💋 🩸
                                           
                                        </div>
                                    <!-- </div> -->

                                    <!-- <div class="col"> -->
                                        <div class="collapse multi-collapse" id="collapseExample3">
                                          
                                            👶 👧 🧒 👦 👩 🧑 👨 👩‍🦱 🧑‍🦱 👨‍🦱 👩‍🦰 🧑‍🦰 👨‍🦰 👱‍♀️ 👱 👱‍♂️ 👩‍🦳 🧑‍🦳 👨‍🦳 👩‍🦲 🧑‍🦲 👨‍🦲 🧔 👵 🧓 👴 👲 👳‍♀️ 👳 👳‍♂️ 🧕 👮‍♀️ 👮 👮‍♂️ 👷‍♀️ 👷 👷‍♂️ 💂‍♀️ 💂 💂‍♂️ 🕵️‍♀️ 🕵️ 🕵️‍♂️ 👩‍⚕️ 🧑‍⚕️ 👨‍⚕️ 👩‍🌾 🧑‍🌾 👨‍🌾 👩‍🍳 🧑‍🍳 👨‍🍳 👩‍🎓 🧑‍🎓 👨‍🎓 👩‍🎤 🧑‍🎤 👨‍🎤 👩‍🏫 🧑‍🏫 👨‍🏫 👩‍🏭 🧑‍🏭 👨‍🏭 👩‍💻 🧑‍💻 👨‍💻 👩‍💼 🧑‍💼 👨‍💼 👩‍🔧 🧑‍🔧 👨‍🔧 👩‍🔬 🧑‍🔬 👨‍🔬 👩‍🎨 🧑‍🎨 👨‍🎨 👩‍🚒 🧑‍🚒 👨‍🚒 👩‍✈️ 🧑‍✈️ 👨‍✈️ 👩‍🚀 🧑‍🚀 👨‍🚀 👩‍⚖️ 🧑‍⚖️ 👨‍⚖️ 👰‍♀️ 👰 👰‍♂️ 🤵‍♀️ 🤵 🤵‍♂️ 👸 🤴 🥷 🦸‍♀️ 🦸 🦸‍♂️ 🦹‍♀️ 🦹 🦹‍♂️ 🤶 🧑‍🎄 🎅 🧙‍♀️ 🧙 🧙‍♂️ 🧝‍♀️ 🧝 🧝‍♂️ 🧛‍♀️ 🧛 🧛‍♂️ 🧟‍♀️ 🧟 🧟‍♂️ 🧞‍♀️ 🧞 🧞‍♂️ 🧜‍♀️ 🧜 🧜‍♂️ 🧚‍♀️ 🧚 🧚‍♂️ 👼 🤰 🤱 👩‍🍼 🧑‍🍼 👨‍🍼 🙇‍♀️ 🙇 🙇‍♂️ 💁‍♀️ 💁 💁‍♂️ 🙅‍♀️ 🙅 🙅‍♂️ 🙆‍♀️ 🙆 🙆‍♂️ 🙋‍♀️ 🙋 🙋‍♂️ 🧏‍♀️ 🧏 🧏‍♂️ 🤦‍♀️ 🤦 🤦‍♂️ 🤷‍♀️ 🤷 🤷‍♂️ 🙎‍♀️ 🙎 🙎‍♂️ 🙍‍♀️ 🙍 🙍‍♂️ 💇‍♀️ 💇 💇‍♂️ 💆‍♀️ 💆 💆‍♂️ 🧖‍♀️ 🧖 🧖‍♂️ 💅 🤳 💃 🕺 👯‍♀️ 👯 👯‍♂️ 🕴 👩‍🦽 🧑‍🦽 👨‍🦽 👩‍🦼 🧑‍🦼 👨‍🦼 🚶‍♀️ 🚶 🚶‍♂️ 👩‍🦯 🧑‍🦯 👨‍🦯 🧎‍♀️ 🧎 🧎‍♂️ 🏃‍♀️ 🏃 🏃‍♂️ 🧍‍♀️ 🧍 🧍‍♂️ 👭 🧑‍🤝‍🧑 👬 👫 👩‍❤️‍👩 💑 👨‍❤️‍👨 👩‍❤️‍👨 👩‍❤️‍💋‍👩 💏 👨‍❤️‍💋‍👨 👩‍❤️‍💋‍👨 👪 👨‍👩‍👦 👨‍👩‍👧 👨‍👩‍👧‍👦 👨‍👩‍👦‍👦 👨‍👩‍👧‍👧 👨‍👨‍👦 👨‍👨‍👧 👨‍👨‍👧‍👦 👨‍👨‍👦‍👦 👨‍👨‍👧‍👧 👩‍👩‍👦 👩‍👩‍👧 👩‍👩‍👧‍👦 👩‍👩‍👦‍👦 👩‍👩‍👧‍👧 👨‍👦 👨‍👦‍👦 👨‍👧 👨‍👧‍👦 👨‍👧‍👧 👩‍👦 👩‍👦‍👦 👩‍👧 👩‍👧‍👦 👩‍👧‍👧 🗣 👤 👥 🫂
                                          
                                        </div>
                                    <!-- </div> -->
                                <!-- </div> -->

                                    <div class="collapse multi-collapse" id="collapseExample4">      
                                        🧳 🌂 ☂️ 🧵 🪡 🪢 🧶 👓 🕶 🥽 🥼 🦺 👔 👕 👖 🧣 🧤 🧥 🧦 👗 👘 🥻 🩴 🩱 🩲 🩳 👙 👚 👛 👜 👝 🎒 👞 👟 🥾 🥿 👠 👡 🩰 👢 👑 👒 🎩 🎓 🧢 ⛑ 🪖 💄 💍 💼
                                    </div>
                                    <div class="collapse multi-collapse" id="collapseExample5">      
                                    ⌚️ 📱 📲 💻 ⌨️ 🖥 🖨 🖱 🖲 🕹 🗜 💽 💾 💿 📀 📼 📷 📸 📹 🎥 📽 🎞 📞 ☎️ 📟 📠 📺 📻 🎙 🎚 🎛 🧭 ⏱ ⏲ ⏰ 🕰 ⌛️ ⏳ 📡 🔋 🔌 💡 🔦 🕯 🪔 🧯 🛢 💸 💵 💴 💶 💷 🪙 💰 💳 💎 ⚖️ 🪜 🧰 🪛 🔧 🔨 ⚒ 🛠 ⛏ 🪚 🔩 ⚙️ 🪤 🧱 ⛓ 🧲 🔫 💣 🧨 🪓 🔪 🗡 ⚔️ 🛡 🚬 ⚰️ 🪦 ⚱️ 🏺 🔮 📿 🧿 💈 ⚗️ 🔭 🔬 🕳 🩹 🩺 💊 💉 🩸 🧬 🦠 🧫 🧪 🌡 🧹 🪠 🧺 🧻 🚽 🚰 🚿 🛁 🛀 🧼 🪥 🪒 🧽 🪣 🧴 🛎 🔑 🗝 🚪 🪑 🛋 🛏 🛌 🧸 🪆 🖼 🪞 🪟 🛍 🛒 🎁 🎈 🎏 🎀 🪄 🪅 🎊 🎉 🎎 🏮 🎐 🧧 ✉️ 📩 📨 📧 💌 📥 📤 📦 🏷 🪧 📪 📫 📬 📭 📮 📯 📜 📃 📄 📑 🧾 📊 📈 📉 🗒 🗓 📆 📅 🗑 📇 🗃 🗳 🗄 📋 📁 📂 🗂 🗞 📰 📓 📔 📒 📕 📗 📘 📙 📚 📖 🔖 🧷 🔗 📎 🖇 📐 📏 🧮 📌 📍 ✂️ 🖊 🖋 ✒️ 🖌 🖍 📝 ✏️ 🔍 🔎 🔏 🔐 🔒 🔓
                                    </div>
                                <small>Copia y Pega los Emojis..</small>
                                <textarea class="form-control" name="" id="message" rows="6"></textarea>
                                <!-- <hr /> -->
                                <!-- <div class="smartcat-uploader">
                                    <label for="">Adjuntar Multimedia</label>
                                    <input class="form-control" type="text" id="lw_image" name="lw_image" value="">
                            
                                </div> -->
                            </div>
                           
                        </article>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-6">
                <a href="#" class="btn btn-sm btn-dark" onclick="wusap()">Enviar Whatsapp</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $.notify.defaults({globalPosition: 'bottom right'});

            $.wpMediaUploader({
                target : '.smartcat-uploader', // The class wrapping the textbox
                uploaderTitle : 'Seleccione o suba image', // The title of the media upload popup
                uploaderButton : 'Set image', // the text of the button in the media upload popup
                multiple : false, // Allow the user to select multiple images
                buttonText : 'Adjunta Multimedia', // The text of the upload button
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
        
        function wusap(){
            let phone =  $('#telefono').text();
            let text = $('#message').val();
            $.ajax({
                url: "http://localhost:3000",
                data: {"message": text, "phone": phone, "type": "text" },
                success: function () {
                    // console.log('Mensaje enviado desde FATCOMWP.');
                    $.notify("Mesaje enviado", "success");
                }
            });
            $.notify("Mesaje enviado", "success");
            $("#message").val('');

        }

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
        $("#button").click(function() {
            let sms = $("#message").val();
            $("#message").val(sms+'<img src="https://cdn.okccdn.com/media/img/emojis/apple/1F60C.png"/>');
        });
    </script>

    <?php
}

