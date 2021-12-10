<?php 

    require_once('../../../../wp-load.php');
    require('../library/pdf/fpdf.php');

    
    
    class PDF extends FPDF
    {
        protected $col = 0; // Columna actual
        protected $y0;      // Ordenada de comienzo de la columna
        
        // Cabecera de página
        function Header()
        {
            global $title;
            $setting = get_posts( array('post_status' => 'publish', 'post_type' => 'pos_lw_setting') );
            $image = get_post_meta($setting[0]->ID, 'lw_image', true);
            // Logo
            $this->Image($image, 5, 5, 25, 25);
            $this->SetFont('Arial','B',15);
            $w = $this->GetStringWidth($title)+6;
            $this->SetX((210-$w)/2);
            // $this->SetDrawColor(0,80,180);
            // $this->SetFillColor(230,230,0);
            // $this->SetTextColor(220,50,50);
            // $this->SetLineWidth(1);
            $this->Cell($w,9,$title,1,1,'C');
            // $this->Ln();
            // $proforma = get_post( $_GET["cod_proforma"] );
            // $proforma->post_date;
            // $this->Cell(0,10, $proforma->post_date,0,0,'C');
            $this->Ln(12);
            // Guardar ordenada
            $this->y0 = $this->GetY();
        }
        
        // Pie de página
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,'Pagina '.$this->PageNo(),0,0,'C');
        }
        function SetCol($col)
        {
            // Establecer la posición de una columna dada
            $this->col = $col;
            $x = 10+$col*65;
            $this->SetLeftMargin($x);
            $this->SetX($x);
        }

        function AcceptPageBreak()
        {
            // Método que acepta o no el salto automático de página
            if($this->col<2)
            {
                // Ir a la siguiente columna
                $this->SetCol($this->col+1);
                // Establecer la ordenada al principio
                $this->SetY($this->y0);
                // Seguir en esta página
                return false;
            }
            else
            {
                // Volver a la primera columna
                $this->SetCol(0);
                // Salto de página
                return true;
            }
        }
        function PrintProduct($product, $proforma, $higth, $border)
        {
            $precio =  $product->regular_price;
            $inicial = get_post_meta($proforma->ID, 'lw_inicial', true);
            $mensual = get_post_meta($proforma->ID, 'lw_mensual', true); 
            $plazo = get_post_meta($proforma->ID, 'lw_plazo', true); 

            $this->AddPage();
            $this->SetFont('Arial','B',13);

            $this->Image(get_the_post_thumbnail_url($product->id), 110, 26, 70, 70);
            //$this->Ln($higth);

            $this->Cell(0, $higth, 'MODELO: '.$product->name, $border, 0, 'L');
            $this->Ln($higth);
            $this->SetFont('Arial','',10);
            $this->Cell(40, $higth, 'Precio Contado:', $border, 0, 'L');
            $this->Cell(40, $higth, 'Bs.'.number_format($precio, 2), $border, 0, 'L');
            $this->Ln($higth);
            $this->Cell(40, $higth, 'Cuota Inicial:', $border, 0, 'L');
            $this->Cell(40, $higth, 'Bs.'.number_format($inicial, 2), $border, 0, 'L');
            $this->Ln($higth);
            $this->Cell(40, $higth, 'Cuota Mensual:', $border, 0, 'L');
            $this->Cell(40, $higth, 'Bs.'.number_format($mensual, 2), $border, 0, 'L');
            $this->Ln($higth);
            $this->Cell(40, $higth, 'Plazo:', $border, 0, 'L');
            $this->Cell(40, $higth, $plazo, $border, 0, 'L');
            $this->Ln($higth);
            $this->Cell(40, $higth, 'Fecha:', $border, 0, 'L');
            $this->Cell(40, $higth, $proforma->post_date, $border, 0, 'L');
            $this->Ln($higth*2);
            $this->SetFont('Arial','B',10);
            $this->Cell(80, $higth, '2REQUISITOS PARA EL CLIENTE Y '.get_post_meta($proforma->ID, 'lw_garante', true).' GARANTES', $border, 0, 'L');
            
            // $this->Cell(40, $higth, 'Observaciones:', $border, 0, 'L');
            // $this->Cell(40, $higth, 'S/N', $border, 0, 'L');
            $this->Ln(30);
            //$this->Ln($higth);
            $this->Cell(0, 0.1, '', 1, 0, 'C', true);
        }
        function PrintRequisitos($proforma, $higth, $border)
        {
            $this->Ln();
            
            // $this->SetFont('Arial','B',10);
            // $this->Cell(0, $higth, 'REQUISITOS PARA EL CLIENTE Y '.get_post_meta($proforma->ID, 'lw_garante', true).' GARANTES', $border, 0, 'L');
            // // $this->Ln($higth*2);
            // $this->Ln();
            
            $this->SetFont('Arial','B',13);
            $this->Cell(95, $higth, 'DEPENDIENTES CON APORTES AFP:', $border, 0, 'L');
            $this->Cell(95, $higth, 'INDEPENDIENTES:', $border, 0, 'L');
            $this->Ln();
            // $this->Cell(0, 0, '', 0 , 0, 'C', true);
            $this->SetFont('Arial','',10);
            if (get_post_meta($proforma->ID, 'lw_fci', true)) {
                $this->Cell(95, $higth, '- Fotocopia Carnet de Identidad a Color', $border, 0, 'L');
            }
            if (get_post_meta($proforma->ID, 'lw_fci2', true)) {
            $this->Cell(95, $higth, '- Fotocopia Carnet de Identidad a Color', $border, 0, 'L');
            }
            $this->Ln($higth);

            if (get_post_meta($proforma->ID, 'lw_ubs', true)) {
                $this->Cell(95, $higth, '- Ultima Boleta de Sueldo, Planilla o Certificado de trabajo', $border, 0, 'L');
            }
            if (get_post_meta($proforma->ID, 'lw_nit', true)) {
            $this->Cell(95, $higth, '- Fotocopia de NIT o Licencia de Funcionamiento', $border, 0, 'L');
            }
            $this->Ln($higth);

            if (get_post_meta($proforma->ID, 'lw_cdt', true)) {
                $this->Cell(95, $higth, '- Copia de Factura de luz del Domicilio', $border, 0, 'L');
            }
            if (get_post_meta($proforma->ID, 'lw_cfd', true)) {
            $this->Cell(95, $higth, '- Copia Factura de Luz del Domicilio', $border, 0, 'L');
            }
            $this->Ln($higth);

            if (get_post_meta($proforma->ID, 'lw_cdt', true)) {
                $this->Cell(95, $higth, '- Croquis Domicilio y Trabajo', $border, 0, 'L');
            }
            $this->Ln($higth);

            if (get_post_meta($proforma->ID, 'lw_afp', true)) {
                $this->Cell(95, $higth, '- Extracto de AFP', $border, 0, 'L');
            }
            $this->Ln($higth);

            $this->Cell(0, 0.1, '', 1, 0, 'C', true);

            $this->Ln($higth-3);
            // $this->Ln();
            $this->SetFont('Arial','B',13);
            $this->Cell(95, $higth, 'INCLUYE:', $border, 0, 'L');
            $this->Cell(95, $higth, 'CLIENTE:', $border, 0, 'L');

            $userid = get_post_meta($proforma->ID, 'lw_customer', true);
            $user = get_user_by( 'id', $userid );
            $this->Ln($higth);
            $this->SetFont('Arial','',11);
            if (get_post_meta($proforma->ID, 'lw_soat', true)) {
                $this->Cell(95, $higth, '- SOAT', $border, 0, 'L');
                $this->Cell(95, $higth, '- '.$user->first_name.' '.$user->last_name, $border, 0, 'L');
                
            }
            $this->Ln($higth);
            if (get_post_meta($proforma->ID, 'lw_garantia', true)) {
                $this->Cell(95, $higth, '- Garantia de 1 Anio o 10.000 KM', $border, 0, 'L');
                $usermeta = get_user_meta($user->id);
                $this->Cell(95, $higth, '- '.$usermeta['billing_phone'][0], $border, 0, 'L');
            }
            $this->Ln($higth);
            if (get_post_meta($proforma->ID, 'lw_mantenimiento', true)) {
                $this->Cell(95, $higth, '- Primer Mantenimiento Gratis a los 1.500 KM', $border, 0, 'L');
                $this->Cell(95, $higth, '- '.$user->user_email, $border, 0, 'L');
            }
            $this->Ln($higth);
            $this->Cell(0, 0.1, '', 1, 0, 'C', true);

            $this->Ln($higth*12);
            // $this->Cell(0, 0.1, '', 1, 0, 'C', true);
            // $this->Ln();
            $this->Cell(0, $higth, '----------------------------------------', $border, 0, 'C');
            $this->Ln($higth);
            $this->Cell(0, $higth, 'Ejecutiv@  de Ventas', $border, 0, 'C');
            $this->Ln($higth);
            $user = get_user_by( 'id', $proforma->post_author );
            $this->Cell(0, $higth, $user->first_name.' '.$user->last_name, $border, 0, 'C');
            $this->Ln($higth);

        }
    }
    
    $pdf = new PDF();
    $proforma = get_post( $_GET["cod_proforma"] );
    $product = wc_get_product( $proforma->lw_product );
    $num_prof = get_post_meta($proforma->ID, 'lw_num_prof', true);
    $higth = 6;  $border = 0;
    $title = 'PROFORMA #'.$num_prof;
    $pdf->SetTitle($title);
    $pdf->SetAuthor('Ing. Percy Alvarez');

    $pdf->PrintProduct($product, $proforma, $higth, $border);
    $pdf->PrintRequisitos($proforma, $higth, $border);

    $pdf->Output();
?>