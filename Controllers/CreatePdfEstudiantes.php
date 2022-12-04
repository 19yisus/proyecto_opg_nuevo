<?php

require_once("./fpdf/fpdf.php");
require_once("../Models/NotasModel.php");
$model = new NotasModel();
$estudiante = $model->reportePorseccion($_POST['id_seccion'], $_POST['id_periodo']);

if($_POST['ope'] == '1'){
  require_once('../Views/Contents/VisPdfSeccion_final.php');
  // var_dump($estudiante);
  // for($i = 0; $i < 30; $i++){
  //   if(isset($estudiante[$i])){
  //     for($x = 0; $x < 9; $x++){
  //       if(isset($estudiante[$i]['notas'][$x])){
  //         echo 'Notas del estudiante '.$estudiante[$i]['cedula'];
  //         echo '<br/>';
  //         var_dump($estudiante[$i]['notas'][$x]);  
  //         echo '<br/><br/>';
  //       }
        
  //     }
  //   }
  // }
  // header('location: ../Views/Contents/PdfSeccion.html.pdf');
}
if($_POST['ope'] == '2'){
  header('location: ../Views/Contents/PdfSeccion_revision.html.pdf');
}
if($_POST['ope'] == '3'){
  header('location: ../Views/Contents/PdfSeccion_pendiente.html.pdf');
}






// foreach($estudiante[0]['notas'] as $i){
//   $re = '/\b(\w)[^\s]*\s*/m';
//   $str = $i['des_materia'];
//   $subst = '$1';
//   $texto = preg_replace($re, $subst, $str);
//   var_dump($i);
//   echo "</br></br>";
//   echo $texto;
//   echo "</br></br>";
// }
// die("FFF");

// $pdf = new FPDF();
// $pdf->AddPage("L");
// $pdf->SetFont("Arial", "B", 7);
// EMPIEZA LA PRIMERA FILA
// $pdf->Cell(70, 7, "1.1 NOMBRE: UEN OSCAR PICON GIACOPINI", 1);
// $pdf->Cell(50, 7, "1.2 CODIGO O.M.A.D: S1185D1802", 1);
// $pdf->Cell(34, 7, "1.3 CODIGO UNICO: *", 1);
// $pdf->SetRightMargin(50);
// $pdf->Cell(20, 7, "");
// $pdf->Cell(47, 7, "2000-2001", 1, 0, "C");
// TERMINO DE LA PRIMERA FILA
// $pdf->Ln();
// EMPIEZA LA SEGUNDA FILA
// $pdf->Cell(47, 7, "1.4 ZONA EDUCATIVA: PORTUGUESA", 1);
// $pdf->Cell(35, 7, "1.5 DISTRITO ESCOLAR: 02", 1);
// $pdf->Cell(22, 7, "1.6 SECTOR: 03", 1);
// $pdf->Cell(50, 7, "1.7 ENTIDAD FEDERAL: PORTUGUESA", 1);
// $pdf->Cell(20, 7, "");
// $pdf->MultiCell(35,7,"3. MES Y AÑO DE LA EVALUACIÓN",1);
// $pdf->Cell(47, 7, "3. MES Y ANO DE LA EVALUACION", 1);
// TERMINA LA SEGUNDA FILA
// $pdf->Ln();
// // EMPIEZA LA TERCERA FILA
// $pdf->Cell(49, 7, "1.8 DEPENDENCIA: NACIONAL", 1);
// $pdf->Cell(65, 7, "1.9 DIRECCION: PROLONGACION CALLE 10", 1);
// $pdf->Cell(40, 7, "1.10 TELEFONO: 055 921061", 1);
// $pdf->Cell(20, 7, "");
// $pdf->Cell(47, 7, "JULIO 2001", 1, 0, "C");
// // TERMINA LA TERCERA FILA
// $pdf->Ln();
// // EMPIEZA LA CUARTA FILA
// $pdf->Cell(100, 7, "1.11 NOMBRE DEL DIRECTOR: GRACIA BENIGNA TORREALBA S.", 1);
// $pdf->Cell(54, 7, "1.12 CEDULA DE IDENTIDAD: V-1121844", 1);
// // TERMINA LA CUARTA FILA
// $pdf->Ln(10);
// $pdf->Cell(10, 7, "N", 1, 0, "C");
// $pdf->Cell(170, 7, "4 - DATOS DE IDENTIFICACION DEL ALUMNO", 1, 0, "C");
// $pdf->Cell(89, 7, "5 - CALFICACION DE LAS ASIGNATURAS", 1, 0, "C");
// $pdf->Ln();
// EMPIEZAN LOS DATOS DE LOS ESTUDIANTES
// $pdf->Cell(10, 7, "", 1, 0);
// $pdf->Cell(25, 7, "4.1 - CED IDENT", 1, 0, "C");
// $pdf->Cell(40, 7, "4.2 - APELLIDOS", 1, 0, "C");
// $pdf->Cell(40, 7, "4.3 - NOMBRES", 1, 0, "C");
// $pdf->Cell(30, 7, "4.4 FEC. NAC.", 1, 0, "C");
// $pdf->Cell(35, 7, "4.5 LUGAR DE NACIMIENTO.", 1, 0, "C");
// $pdf->Cell(8.1, 7, "CL", 1, 0, "C");
// $pdf->Cell(8.1, 7, "IN", 1, 0, "C");
// $pdf->Cell(8.1, 7, "MA", 1, 0, "C");
// $pdf->Cell(8.1, 7, "HV", 1, 0, "C");
// $pdf->Cell(8.1, 7, "EF", 1, 0, "C");
// $pdf->Cell(8.1, 7, "GB", 1, 0, "C");
// $pdf->Cell(8.1, 7, "EA", 1, 0, "C");
// $pdf->Cell(8.1, 7, "EF", 1, 0, "C");
// $pdf->Cell(8.1, 7, "ET", 1, 0, "C");
// $pdf->Cell(8.1, 7, "UC", 1, 0, "C");
// $pdf->Cell(8.1, 7, "NS", 1, 0, "C");
// // TERMINAN LOS DATOS DE LOS ESTUDIANTES
// $pdf->Ln();
// foreach ($estudiante as $item) {
//   // $re = '/\b(\w)[^\s]*\s*/m';
//   // $str = 'CORPORACIÓN GR AN FORMATO SAC';
//   // $subst = '$1';
//   // $texto = preg_replace($re, $subst, $str);

//   // var_dump($item['notas']);
//   // die("F");

//   $pdf->Cell(10, 7, 1, 1, 0, "C");
//   $pdf->Cell(25, 7, $item['cedula'], 1, 0, "C");
//   $pdf->Cell(40, 7, $item['apellido'], 1, 0, "C");
//   $pdf->Cell(40, 7, $item['nombre'], 1, 0, "C");
//   $pdf->Cell(30, 7, $item['fec'], 1, 0, "C");
//   $pdf->Cell(35, 7, $item['lugar'], 1, 0, "C");

//   $pdf->Cell(8.1, 7, (isset($item['notas'][0]['nota_final']) && $item['notas'][0]['nota_final'] > 9) ? $item['notas'][0]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][1]['nota_final']) && $item['notas'][1]['nota_final'] > 9) ? $item['notas'][1]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][2]['nota_final']) && $item['notas'][2]['nota_final'] > 9) ? $item['notas'][2]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][3]['nota_final']) && $item['notas'][3]['nota_final'] > 9) ? $item['notas'][3]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][4]['nota_final']) && $item['notas'][4]['nota_final'] > 9) ? $item['notas'][4]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][5]['nota_final']) && $item['notas'][5]['nota_final'] > 9) ? $item['notas'][5]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][6]['nota_final']) && $item['notas'][6]['nota_final'] > 9) ? $item['notas'][6]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][7]['nota_final']) && $item['notas'][7]['nota_final'] > 9) ? $item['notas'][7]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][8]['nota_final']) && $item['notas'][8]['nota_final'] > 9) ? $item['notas'][8]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][9]['nota_final']) && $item['notas'][9]['nota_final'] > 9) ? $item['notas'][9]['nota_final']: "", 1, 0, "C");
//   $pdf->Cell(8.1, 7, (isset($item['notas'][10]['nota_final']) && $item['notas'][10]['nota_final'] > 9) ? $item['notas'][10]['nota_final']: "", 1, 0, "C");
//   $pdf->Ln();
// }
// $pdf->Output("", "index.pdf", true);
