
const fs = require("fs");
const qrcode = require("qrcode-terminal");
const { Client } = require("whatsapp-web.js");


const SESSION_FILE_PATH = "./session.json";

const country_code = '591';
const number = '76886773';
const msg = '👋 Hola, el BOT iBy esta listo.';

let sessionData;
if (fs.existsSync(SESSION_FILE_PATH)) {
    sessionData = require(SESSION_FILE_PATH);
}

const client = new Client({
    session: sessionData,
    puppeteer: {
        ignoreDefaultArgs: ['--disable-extensions'],
        args: ['--no-sandbox']
    }
});

//---------------------------------------
client.on("qr", (qr) => {
    qrcode.generate(qr, { small: true });
});

client.on('ready', () => {
    console.log('El BOT esta listo.');
    // let chatId = country_code + number + "@c.us";
    // client.sendMessage(chatId, msg).then((response) => {
    //     if (response.id.fromMe) {
    //         console.log("el mensaje fui enviado!");
    //     }
    // })
});

client.on("authenticated", (session) => {
    sessionData = session;
    fs.writeFile(SESSION_FILE_PATH, JSON.stringify(session), function (err) {
        if (err) {
            console.error(err);
        }
    });
});
client.on("auth_failure", msg => {
    console.error('AUTHENTICATION FAILURE', msg);
})

client.on('message', async msg => {
    console.log('MESSAGE RECEIVED', msg);
    if (msg.body === "Hola" || msg.body === "hola" || msg.body === "Buenas" || msg.body === "buenas") {
        const chat = await msg.getChat();
        const user = await msg.getContact();
        await chat.sendMessage(`Hola @${user.id.user}`+'\nSoy el 🤖BOT(iBy)🤖 de la Tienda 🇧🇴Libre Mercado🇧🇴, Elije una opcion por favor. \n 1.- 🛒Catalogo Completo🛒 \n2.- 🛍Ofertas Especiales🛍 \n3.- 💣Cupones de Descuento💣 \n4.- 🚚Precios Delivery🚚 \n5.- 💳Metodos de Pago💳 \n6.- ℹMas Informacionℹ \n7.- 🆘Soporte Tecnico🆘 \n8.- 👑Eres Cliente?👑 \n\nElije un # y envialo.', {
            mentions: [user]
        });
    } else if (msg.body.startsWith('1')) {
        msg.reply('🛒Genial, ingresa a nuestra tienda virtual y realiza tu pedido, cotizacion o reserva.🛒 \nhttps://loginweb.dev/tienda');
    }else if (msg.body.startsWith('2')) {
        msg.reply('🛍Eres un comprador inteligente, ingresa a nuestro catalogo de ofertas especiales y enterate de las novedades.🛍 \nhttps://loginweb.dev/ofertas-especiales' );
    } else if (msg.body.startsWith('3')) {
        msg.reply('💣Aprocha nuestros  cupones de  descuento, ingresa a la lista de los cupones disponibles.💣  \nhttps://loginweb.dev/cupones-de-descuentos');
    }else if (msg.body.startsWith('4')) {
        msg.reply('🚚Ingresa a ver los precios de los envio, los precios varian segun su ubicacion.🚚 \nhttps://loginweb.dev/precios-delivery' );
    }else if (msg.body.startsWith('5')) {
        msg.reply('💳En nuestra tienda puedes realizar tu pagos via TARJETA DEBITO/CREDITO, Tigo Money, Codigo QR y otros.💳\n https://loginweb.dev/metodos-de-pago' );
    }else if (msg.body.startsWith('6')) {
        msg.reply('ℹBienvenido a LoginWeb@2021, Estas interesado en algunos de nuestro productos o servicios? si es asi, ingersa a nuestra pagina web y enterate de todas las novedades.ℹ \nhttps://loginweb.dev' );
    }else if (msg.body.startsWith('7')) {
        msg.reply('🆘Bienvenido a LoginWeb@2021, Estas interesado en algunos de nuestro productos o servicios? si es asi, ingersa a nuestra pagina web y enterate de todas las novedades.🆘 \nhttps://loginweb.dev/soporte-tecnico');
    }else if (msg.body.startsWith('8')) {
        msg.reply('👑Bienvenido estimado cliente, ingresa a tu panel de pedidos y datos personales. (Gracias por tu 💝 preferencia)👑 \nhttps://loginweb.dev/mi-cuenta' );
    }
});

client.initialize();

