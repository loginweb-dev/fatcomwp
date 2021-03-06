<?php 

    require_once('../../../../wp-load.php');
    require('../library/pdf/fpdf.php');
    $QR_BASEDIR = dirname(__FILE__).DIRECTORY_SEPARATOR;

    require '../library/NumeroALetras.php';
    use Luecano\NumeroALetras\NumeroALetras;
    $formatter = new NumeroALetras();

    // // get data of facturas--------------------------
    $datos_factura = get_posts( array('post_status' => 'publish', 'post_type' => 'pos_lw_setting') );

    // echo 'hola';
    

    // // get order ------------------------------------
    $cod_order = $_GET["cod_order"];
    $order = wc_get_order( $cod_order );
    $items = $order->get_items();
    $data = $order->get_data();
    $cupon = get_post_meta($order->ID, 'lw_coupon_code', true);

    // echo $_GET["cod_order"];

    // // creating PDF-------------------------------------------------
    $border = 0;
    $position = 1;
    $aling = 'C';
    $higth = 4;
    $size_font = 10;
    $type_font = 'Arial';
    $higth_qr = 110;

    $pdf = new FPDF('P','mm',array(80,190));
    $pdf->SetMargins(1, 8, 1, 1);
    $pdf->SetFont($type_font, '', $size_font);
    $pdf->AddPage();
        // Encabezado------------------------------------------
        $pdf->SetFont($type_font, '', $size_font+10);
        $pdf->Cell(0, $higth, 'TICKET #'.$order->get_meta('lw_pos_tickes'), $border , $position, $aling);
        $pdf->Ln(2);
    $pdf->Image(get_post_meta($datos_factura[0]->ID, 'lw_image', true),25,15,20,20, get_post_meta($datos_factura[0]->ID, 'lw_img_extencion', true));
        $pdf->Ln(22);
        // datos de factura------------------------------------------
        $pdf->SetFont($type_font, '', $size_font);
        $pdf->Cell(0, $higth, 'RECIBO #'.$data['id'], $border , $position, $aling);
        $pdf->SetFont($type_font, '', $size_font -1);
        $pdf->Cell(0, $higth, 'FECHA: '.$data['date_created']->date('Y-m-d H:i:s'), $border , $position, $aling);
    $pdf->Cell(0, 0, '', 1 , 1, 'C');
        //Detalle de la Venta ------------------------------------------------------
        $pdf->SetFont($type_font, '', $size_font);  
        $pdf->Cell(0, $higth, 'DETALLE DE COMPRA:', 0 , 1, 'L');
        $pdf->SetFont($type_font, '', $size_font-2);  
        $pdf->Cell(40, $higth, 'PRODUCTO', 0);
        $pdf->SetFont($type_font, '', $size_font-4);  
        $pdf->Cell(10, $higth, 'CANT', 0);
        $pdf->Cell(10, $higth, 'PRECIO', 0);
        $pdf->Cell(10, $higth, 'TOTAL', 0, 1, 'C');
        $pdf->SetFont($type_font, '', $size_font-2);  
        $pdf->Cell(0, 0, '', 1 , 1, 'C');
        $lc = 0;
        foreach ( $items as $item ) {
            $extra = $item->get_meta_data();
            $product = $item->get_product();
            $pdf->Cell(40, $higth, $item['name'], 0);
            $pdf->Cell(10, $higth, $item['quantity'], 0);
            $pdf->Cell(10, $higth, $product->get_price(), 0);
            $pdf->Cell(10, $higth, $product->get_price() * $item['quantity'], 0, 1, 'C');
            for ($i=0; $i < count($extra); $i++) { 
                if($extra[$i]->key == '_wc_cog_item_cost' || $extra[$i]->key == '_wc_cog_item_total_cost' || $extra[$i]->key == 'pa_sabores-refrescos' || $extra[$i]->key == 'pa_sabores-gaseosas'){

                }else{
                    $pdf->Cell(40, $higth, $extra[$i]->key, 0);
                    $pdf->Cell(10, $higth, $extra[$i]->value, 0);
                    $miprice = substr($extra[$i]->key, -2);
                    $miprice = str_replace(')', '', $miprice);
                    $pdf->Cell(10, $higth, $miprice, 0);
                    $pdf->Cell(10, $higth, $miprice * $extra[$i]->value, 0, 1, 'C');
                }
                $lc++;
            }
            $aux = get_post_meta($_GET["cod_order"], 'lw_line', true); 
            if($aux.$lc == $lc){
                $pdf->Cell(0, 0, '', 1 , 1, 'C');
                $higth_qr += 4;
                $lc--;
            }
            $higth_qr += 4;
            $lc++;
        }

    $pdf->SetFont($type_font, '', $size_font-2);
    $pdf->Cell(0, 0, '', 1 , 1, 'C');
        $pdf->Cell(30, $higth, '', 0);
        $micupon = $order->get_coupon_codes(); //get_used_coupons
        $pdf->Cell(30, $higth, 'DESCUENTO: ', 0);
        $pdf->Cell(10, $higth, get_post_meta($micupon[0], "coupon_amount", true) ? get_post_meta($micupon[0], "coupon_amount", true) : 0 , 0, 1, 'C');
        $pdf->Cell(30, $higth, '', 0);
        $pdf->Cell(30, $higth, 'TOTAL: ', 0);
        $pdf->Cell(10, $higth, $order->get_total(), 0, 1, 'C');

        $pdf->MultiCell(0, $higth, $formatter->toInvoice($order->get_total(), 2, 'BOLIVIANOS'), 0, 1);

    $pdf->Cell(0, 0, '', 1 , 1, 'C');
    $pdf->Cell(0, 0, '', 1 , 1, 'C');
        $pdf->Cell(0, $higth, 'ATENDIDO POR: '.$order->get_meta('wc_pos_served_by_name'), 0, 1, 'L');
        $pdf->Cell(0, $higth, 'PARA: '.$order->get_meta('lw_or'), 0, 1, 'L');
        $pdf->Cell(0, $higth, 'NOTAS : '.$order->customer_message, 0, 1, 'L');
        $pdf->Image(WP_PLUGIN_URL.'/fatcomwp/controller/qrcode/temp/'.$order->id.'.jpg', 23, $higth_qr-30, 25, 25, 'JPG');
    
    $pdf->Ln(40);
    $pdf->SetFont($type_font, '', $size_font+10);
    $pdf->Cell(0, $higth, 'TICKET #'.$order->get_meta('lw_pos_tickes'), $border , $position, $aling);

    $pdf->Output();
?>