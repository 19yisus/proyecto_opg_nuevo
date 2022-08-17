<?php
    
    require_once("./Models/NotasModel.php");

    $nota_model = new NotasModel();

    $datos = $nota_model->ConsultaParaPdf($_GET['cedula']);
    
    if(!isset($datos['notas'])) exit;

    $resultado = $datos['datos'];
    $notas = $datos['notas'];

    $nacionalidad = $resultado['nacionalidad_persona'];
    $cedula = $resultado['cedula_estudiante'];
    $nombre = $resultado['nombre_persona'];
    $apellido = $resultado['apellido_persona'];
    $telefono = $resultado['telefono_persona'];
    $lugarN = $resultado['direccion_n_persona'];
    $direccion = $resultado['direccion_persona'];
    $fecha = new DateTime($resultado['fecha_n_persona']);
    $seguimiento = $resultado['seguimiento_estudiante'];
    $primero = $segundo = $tercero = $cuarto = $quinto = $sexto = [];
    $fecha_actual = "10/01/2022";

    foreach($notas as $nota){
        if($nota['ano_seguimiento'] == 1) array_push($primero, $nota);
        if($nota['ano_seguimiento'] == 2) array_push($segundo, $nota);
        if($nota['ano_seguimiento'] == 3) array_push($tercero, $nota);
        if($nota['ano_seguimiento'] == 4) array_push($cuarto, $nota);
        if($nota['ano_seguimiento'] == 5) array_push($quinto, $nota);
        if($nota['ano_seguimiento'] == 6) array_push($sexto, $nota);
    }

    $file_route = dirname(__FILE__).'/../../Controllers/vendor/autoload.php';

    if(file_exists($file_route)){
        require_once($file_route);
        
        $mpdf = new \Mpdf\Mpdf([ 'mode' => 'utf-8', 'format' => 'Legal', 'default_font_size' => '10', 'tempDir' => dirname(__FILE__).'/../../Controllers/TemporalMpdf']);

        $mpdf->SetFooter("{PAGENO}");
        $mpdf->shrink_tables_to_fit = "1.4";
        $mpdf->AddPage('p','','','','',1,1,1,1);
        ob_start();
        require("./Views/Contents/VispdfNotas.php");
        $html = ob_get_contents();
        ob_end_clean();

        $stylesheet = file_get_contents("Views/Css/estilosNotasFinales.css");
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        $mpdf->Output("boletin-$cedula.pdf","I");    
    }
    
?>
