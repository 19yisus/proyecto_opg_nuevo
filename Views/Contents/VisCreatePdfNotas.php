<?php
require_once("./Models/NotasModel.php");
$nota_model = new NotasModel();
$datos = $nota_model->ConsultaParaPdf($_GET['cedula'], $_GET['periodo']);
$director = $nota_model->director_activo();
if (!isset($datos['notas'][0])) {
	echo "<script>
            alert('No hay datos suficiente para generar este reporte');
            window.close();
        </script>";
}

// var_dump($datos);
// die("FDF");

$resultado = $datos['datos'];
$notas = $datos['notas'];
$inst = $datos['institucion'];
$planteles = $datos['planteles'];

$nacionalidad = $resultado['nacionalidad_persona'];
$cedula = $resultado['cedula_estudiante'];
$nombre = $resultado['nombre_persona'];
$apellido = $resultado['apellido_persona'];
$telefono = $resultado['telefono_persona'];
$lugarN = $resultado['direccion_n_persona'];
$direccion = $resultado['direccion_persona'];
$fecha = new DateTime($resultado['fecha_n_persona']);
$seguimiento = $resultado['seguimiento_estudiante'];
$pais = $resultado['pais'];
$enidad_federal_nacimiento = $resultado['entidad_federal'];
$municipio_nacimiento = $resultado['municipio'];
$primero = $segundo = $tercero = $cuarto = $quinto = $sexto = [];
$fecha_actual = date("d/m/Y");
$code_pensum = $notas[sizeof($notas) - 1]['cod_pensum'];

foreach ($notas as $nota) {
	if ($nota['ano_seguimiento'] == 1) array_push($primero, $nota);
	if ($nota['ano_seguimiento'] == 2) array_push($segundo, $nota);
	if ($nota['ano_seguimiento'] == 3) array_push($tercero, $nota);
	if ($nota['ano_seguimiento'] == 4) array_push($cuarto, $nota);
	if ($nota['ano_seguimiento'] == 5) array_push($quinto, $nota);
	if ($nota['ano_seguimiento'] == 6) array_push($sexto, $nota);
}

// var_dump($planteles);
// die("FDF");

if (!isset($primero[0])) {
	$resultado = $nota_model->ConsultarParaPdfNotasExternas($cedula, 1);
	if (isset($resultado[0])) {
		foreach ($resultado as $item) {
			array_push($primero, [
				'nota_final' => $item['nota_ext'],
				'des_materia' => $item['des_materia_ext'],
				'periodoescolar' => $item['periodo_ext'] . '-' . '1',
				'plantel' => $item['plantel_ext']
			]);
		}
	}
}

if (!isset($segundo[0])) {
	$resultado = $nota_model->ConsultarParaPdfNotasExternas($cedula, 2);
	if (isset($resultado[0])) {
		foreach ($resultado as $item) {
			array_push($segundo, [
				'nota_final' => $item['nota_ext'],
				'des_materia' => $item['des_materia_ext'],
				'periodoescolar' => $item['periodo_ext'] . '-' . '1',
				'plantel' => $item['plantel_ext']
			]);
		}
	}
}

if (!isset($tercero[0])) {
	$resultado = $nota_model->ConsultarParaPdfNotasExternas($cedula, 3);
	if (isset($resultado[0])) {
		foreach ($resultado as $item) {
			array_push($tercero, [
				'nota_final' => $item['nota_ext'],
				'des_materia' => $item['des_materia_ext'],
				'periodoescolar' => $item['periodo_ext'] . '-' . '1',
				'plantel' => $item['plantel_ext']
			]);
		}
	}
}

if (!isset($cuarto[0])) {
	$resultado = $nota_model->ConsultarParaPdfNotasExternas($cedula, 4);
	if (isset($resultado[0])) {
		foreach ($resultado as $item) {
			array_push($cuarto, [
				'nota_final' => $item['nota_ext'],
				'des_materia' => $item['des_materia_ext'],
				'periodoescolar' => $item['periodo_ext'] . '-' . '1',
				'plantel' => $item['plantel_ext']
			]);
		}
	}
}

if (!isset($quinto[0])) {
	$resultado = $nota_model->ConsultarParaPdfNotasExternas($cedula, 5);
	if (isset($resultado[0])) {
		foreach ($resultado as $item) {
			array_push($quinto, [
				'nota_final' => $item['nota_ext'],
				'des_materia' => $item['des_materia_ext'],
				'periodoescolar' => $item['periodo_ext'] . '-' . '1',
				'plantel' => $item['plantel_ext']
			]);
		}
	}
}

require_once './Views/Contents/VisPdfNotas2.php';

    // $file_route = dirname(__FILE__).'/../../Controllers/vendor/autoload.php';
    
    // if(file_exists($file_route)){
    //     require_once($file_route);    
    //     try{
    //         $mpdf = new \Mpdf\Mpdf([ 'mode' => 'utf-8', 'format' => 'Legal', 'default_font_size' => '12', 'tempDir' => dirname(__FILE__).'/../../Controllers/TemporalMpdf']);
            
    //         $mpdf->SetFooter("{PAGENO}");
    //         $mpdf->shrink_tables_to_fit = "1.4";
    //         $mpdf->AddPage('p','','','','',2,2,2,2);
    //         ob_start();
    //         $tipo_pensum = "B";
    //         require("./Views/Contents/VispdfNotas.php");
    //         $html = ob_get_contents();
    //         ob_end_clean();            

    //         $stylesheet = file_get_contents("Views/Css/estilosNotasFinales.css");
    //         $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
    //         $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

    //         $mpdf->Output("boletin-$cedula.pdf","I");    
    //     }catch(\Mpdf\MpdfException $e){
    //         echo $e->getMessage();
    //     }
        
    // }
