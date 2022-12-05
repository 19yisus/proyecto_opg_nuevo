<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Views/Css/estilos.css" />
  <style>
    * {
      font-size: 10px !important;
    }

    /* td{margin:0px !important; padding:0px !important;} */
  </style>
  <title>Document</title>
</head>

<body>
  <div class="mx-auto w-12/12 text-sm p-1" id="pagina">
    <div class="flex justify-between items-center">
      <img src="../Views/includes/images.png" alt="" srcset="" width="300" />
      <div class="flex flex-row w-full">
        <div class="flex flex-col w-full ">
          <div class="underline flex-row items-end font-bold" style="text-align: right !important;">
            RESUMEN FINAL DEL RENDIMIENTO ESTUDIANTIL
          </div>
          <span class="font-bold" style="text-align: right !important; margin-right: 80px !important;">
            Codigo del Formato: EMG
          </span>
          <div class="flex space-x-1 mx-1 my-1">
            <span class="w-5/12 flex flex-row capitalize">
              <span class="w-10/12 font-bold">
                I. año escolar:
              </span>

              <span class="border-b border-black w-full">

              </span>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- DATOS DE LA INSTITUCION -->
    <div class="w-full flex flex-col">
      <div class="flex flex-row w-full justify-between">
        <span class="font-bold">
          II. Datos del Plantel:
        </span>

        <div class="flex flex-row justify-evenly w-8/12">
          <span class="flex flex-row mx-1">
            <span class="font-bold"">
              Tipo de Evaluacion:
            </span>
            
            <div class=" border-b border-black w-40 mx-1">
              <?php echo $tipo_descripcion;?>
        </div>
        </span>
        <span class="flex flex-row">
          <span class="font-bold">
            Mes y año:
          </span>

          <div class="border-b border-black w-40">
            <!-- UEN  OSCAR PICÓN GIACOPINI -->
          </div>
        </span>
      </div>

    </div>


    <div class="flex space-x-1 my-1">
      <span class="w-4/12 flex flex-row">
        <span class="font-bold">
          Código del plantel:
        </span>

        <div class="border-b border-black w-5/12 mx-1">
          <?php echo strtoupper($inst['codigo_institucion']); ?>
        </div>
      </span>
      <span class="w-11/12 flex flex-row">
        <span class="font-bold">
          Nombre:
        </span>
        <div class="border-b border-black w-11/12 mx-1">
          <?php echo strtoupper($inst['des_institucion']); ?>
        </div>
      </span>
    </div>

    <div class="flex space-x-1 my-1">
      <span class="w-8/12 flex flex-row">
        <span class="font-bold">
          Dirección:
        </span>

        <div class="border-b border-black w-full mx-1">
          <?php echo strtoupper($inst['direccion_institucion']); ?>
        </div>
      </span>
      <span class="w-4/12 flex flex-row">
        <span class="font-bold">
          Teléfono:
        </span>:
        <div class="border-b border-black w-10/12 mx-1">
          <?php echo $inst['telefono']; ?>
        </div>
      </span>
    </div>

    <div class="flex my-2">
      <span class="w-4/12 flex flex-row">
        <span class="font-bold">
          Municipio:
        </span>

        <div class="border-b border-black w-3/4 ml-1">
          <?php echo strtoupper($inst['municipio']); ?>
        </div>
      </span>

      <span class="w-5/12 flex flex-row">
        <span class="font-bold">
          Entidad Federal:
        </span>
        <div class="border-b border-black w-8/12 ml-1">
          <?php echo strtoupper($inst['entidad_federal']); ?>
        </div>
      </span>

      <span class="w-3/12 flex flex-row">
        <span class="font-bold">
          Zona Educativa:
        </span>
        <div class="border-b border-black w-6/12">
          <?php echo strtoupper($inst['zona_educativa']); ?>
        </div>
      </span>
    </div>
    <div class="flex space-x-1 my-1">
      <span class="w-8/12 flex flex-row">
        <span class="font-bold">
          Director(a):
        </span>

        <div class="border-b border-black w-full mx-1">
          <?php echo isset($director['nombre_persona']) ? $director['nombre_persona'] . $director['apellido_persona'] : '**'; ?>
        </div>
      </span>
      <span class="w-6/12 flex flex-row">
        <span class="font-bold">
          Cédula de Identidad:
        </span>:
        <div class="border-b border-black w-7/12 mx-1">
          <?php echo isset($director['nacionalidad_persona']) ? $director['nacionalidad_persona'] . ' ' . $director['cedula_persona'] : '**'; ?>
        </div>
      </span>
    </div>
    <!-- ./PLANTEL -->


    <div class="w-full my-2">
      <table class="w-full">
        <thead class="w-full">
          <tr class="w-full font-bold">
            <td class="border border-black p-1 w-9/12">III. Identificación del Estudiante: </td>
            <td class="border border-black p-1 text-center w-11/12">IV. Resumen Final del Rendimiento</td>
          </tr>
        </thead>
        <tbody class="w-full">
          <tr class="w-full">
            <td class="">
              <table class="w-full h-40">
                <tbody class="" style="height: 100px !important;">
                  <tr class="border-l border-r border-b border-t border-black ">
                    <td class="text-center border border-black" style="width: 14px !important;">N</td>
                    <td class="text-center border-l border-t border-r border-black" style="width: 57px !important;">Cedula de
                      <br>
                      Identidad
                    </td>
                    <td class=" text-center border-r border-black" style="width: 130px !important;">Apellidos</td>
                    <td class=" text-center border-r border-black" style="width: 130px !important;">Nombres</td>
                    <td class=" text-center" style="width: 120px !important;">Lugar de Nacimiento</td>
                    <td class="h-full " style="width: 10px !important;">
                      <table class=" h-40 m-0">
                        <tbody class="h-full">
                          <tr>
                            <td class='border-l border-black' style="width: 1px !important;">E.F</td>
                            <td class='border-l border-black text-center' style="width: 14px !important;">S E X O</td>
                            <td class="h-full border-l border-black" style="width: 18px !important;">
                              <table class="w-full h-full bg-red-">
                                <tbody class="bg-red-">
                                  <tr class="border-b border-black" style="height: 66px !important;">
                                    <td class=" text-center">Fecha de Nacimiento</td>
                                  </tr>
                                  <tr class="flex justify-around" style="height: 32px !important;">
                                    <td class=" border-black w-full text-center">D</td>
                                    <td class="border-l border-r border-black w-full text-center">M</td>
                                    <td class=" border-black w-full text-center">A</td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
            <td class="border border-black">
              <table class="w-full h-40">
                <tbody class="">
                  <tr>
                    <td class="border border-black" style="width: 16px !important;">
                      <table class="text-center w-full h-full" style="margin: -2px !important;">
                        <tbody class="h-full">
                          <tr class="border-b border-black">
                            <td class="h-16">ÁREAS DE FORMACIÓN</td>
                          </tr>
                          <tr class="">
                            <td class="h-14">ÁREA COMÚN</td>
                          </tr>
                          <tr class="">
                            <td class="p-0 m-0 h-14">
                              <table class="w-full h-full border-t border-black">
                                <tbody class="w-full">
                                  <tr class="">
                                    <td style="width: 16px !important;" class="border-r border-b border-black text-center">1</td>
                                    <td style="width: 16px !important;" class="border-r border-b border-black text-center">2</td>
                                    <td style="width: 16px !important;" class="border-r border-b border-black text-center">3</td>
                                    <td style="width: 16px !important;" class="border-r border-b border-black text-center">4</td>
                                    <td style="width: 16px !important;" class="border-r border-b border-black text-center">5</td>
                                    <td style="width: 16px !important;" class="border-r border-b border-black text-center">6</td>
                                    <td style="width: 16px !important;" class="border-r border-b border-black text-center">7</td>
                                    <td style="width: 16px !important;" class="border-b border-black text-center">8</td>
                                  </tr>
                                  <tr>
                                    <td style="width: 16px !important;" class="border-r border-black text-center">CA</td>
                                    <td style="width: 16px !important;" class="border-r border-black text-center">CA</td>
                                    <td style="width: 16px !important;" class="border-r border-black text-center">MA</td>
                                    <td style="width: 16px !important;" class="border-r border-black text-center">EF</td>
                                    <td style="width: 16px !important;" class="border-r border-black text-center">AP</td>
                                    <td style="width: 16px !important;" class="border-r border-black text-center">CN</td>
                                    <td style="width: 16px !important;" class="border-r border-black text-center">GH</td>
                                    <td style="width: 16px !important;" class="border-black text-center">OC</td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border-l border-black">
                      <table class=" border-black w-full h-full " style="margin: -1px !important;">
                        <tbody>
                          <tr class="border-b border-black" style="height: 75px !important;">
                            <td class="text-center" style="font-size: 8px !important;">PARTICIPACIÓN EN GRUPOS DE CREACIÓN, REACREACIÓN Y PRODUCCIÓN </td>
                          </tr>
                          <tr>
                            <td class="w-full border-black">
                              <table class="w-full h-full ">
                                <tbody class="">
                                  <tr>
                                    <td class="border border-black">
                                      <table class="w-full">
                                        <tbody>
                                          <tr>
                                            <td style="width: 16px !important;" class=" border-b border-black text-center">9</td>
                                          </tr>
                                          <tr>
                                            <td style="width: 16px !important;" class="border-black text-center">PG</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                    <td class="w-full h-full">
                                      <table class="w-full">
                                        <tbody>
                                          <tr>
                                            <td class=" border-black text-center">GRUPO</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
          <div class="flex flex-col text-center w-6/12">
            <tr class="w-full">
              <table class="w-full">
                <tbody>
                  <?php
                  for ($i = 0; $i < 30; $i++) {
                    if (isset($estudiante[$i])) {
                      $cedula = $estudiante[$i]['cedula'];
                      $apellido = $estudiante[$i]['apellido'];
                      $nombre = $estudiante[$i]['nombre'];
                      $lugar_n = $estudiante[$i]['lugar_n'];
                      $sexo = $estudiante[$i]['sexo'];
                      $fecha_n = $estudiante[$i]['fec'];
                      $date = new DateTime($fecha_n);
                      $dia = $date->format('d');
                      $mes = $date->format('m');
                      $anio = $date->format('Y');
                    } else {
                      $cedula = '**';
                      $apellido = '**';
                      $nombre = '**';
                      $lugar_n = '**';
                      $sexo = '**';
                      $fecha_n = '**';
                      $dia = '**';
                      $mes = '**';
                      $anio = '**';
                    }

                  ?>
                    <tr class="w-full">
                      <td class="border border-black " style="width: 16px !important;"><?php echo ($i + 1); ?></td>
                      <td class="border border-black " style="width: 61px !important;"><?php echo $cedula; ?></td>
                      <td class="border border-black " style="width: 140px !important;"><?php echo $apellido; ?></td>
                      <td class="border border-black " style="width: 140px !important;"><?php echo $nombre; ?></td>
                      <td class="border border-black " style="width: 130px !important;"><?php echo $lugar_n; ?></td>
                      <td class="border border-black" style="width: 19px !important;"><?php echo 'P'; ?></td>
                      <td class="border border-black text-center" style="width: 14px !important;"><?php echo $sexo; ?></td>

                      <td class="border border-black" style="width: 19px !important;"><?php echo $dia; ?></td>
                      <td class="border border-black" style="width: 17px !important;"><?php echo $mes; ?></td>
                      <td class="border border-black" style="width: 30px !important;"><?php echo $anio; ?></td>
                      <?php
                      for ($x = 0; $x < 9; $x++) {
                        if (isset($estudiante[$i]['notas'][$x])) {
                          $nota = $estudiante[$i]['notas'][$x]['nota_final'];
                        } else $nota = '*';
                      ?>
                        <td class="border border-black" style="width: 17px !important;"><?php echo $nota; ?></td>
                      <?php
                      }
                      ?>
                      <td class="border border-black">GRUPO</td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </tr>
            <tr>
              <td>
                <table class="w-full h-full">
                  <tbody class="w-full">
                    <tr class="" style="height: 80px !important;">
                      <td class="w-5/12 border border-black font-bold" style="font-size: 16px !important; padding-left:10px !important;">Total de Áreas de Formación</td>
                      <td class="w-4/12 text-center">
                        <table class="w-full">
                          <tbody class="w-full">
                            <tr class="h-full w-full">
                              <td class="h-full ">
                            <tr class="border border-black text-center">
                              <td class="font-bold text-center">Inscritos</td>
                            </tr>
                            <tr class="border border-black text-center">
                              <td class="font-bold text-center">Inasistentes</td>
                            </tr>
                            <tr class="border border-black text-center">
                              <td class="font-bold text-center">Aprobados</td>
                            </tr>
                            <tr class="border border-black text-center">
                              <td class="font-bold text-center">No Aprobados</td>
                            </tr>
                            <tr class="border border-black text-center">
                              <td class="font-bold text-center">No Cursantes</td>
                            </tr>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </td>
              <td>
                <table>
                  <tbody>
                    <tr>
                      <td class="border border-black" style="width: 16px !important;">1</td>
                      <td class="border border-black" style="width: 16px !important;">2</td>
                      <td class="border border-black" style="width: 16px !important;">3</td>
                      <td class="border border-black" style="width: 16px !important;">4</td>
                      <td class="border border-black" style="width: 16px !important;">5</td>
                      <td class="border border-black" style="width: 16px !important;">6</td>
                      <td class="border border-black" style="width: 16px !important;">7</td>
                      <td class="border border-black" style="width: 16px !important;">8</td>
                      <td class="border border-black" style="width: 16px !important;">9</td>
                      <td class="border border-black" style="width: 16px !important;">10</td>
                    </tr>
                    <tr>
                      <td class="border border-black" style="width: 16px !important;">1</td>
                      <td class="border border-black" style="width: 16px !important;">2</td>
                      <td class="border border-black" style="width: 16px !important;">3</td>
                      <td class="border border-black" style="width: 16px !important;">4</td>
                      <td class="border border-black" style="width: 16px !important;">5</td>
                      <td class="border border-black" style="width: 16px !important;">6</td>
                      <td class="border border-black" style="width: 16px !important;">7</td>
                      <td class="border border-black" style="width: 16px !important;">8</td>
                      <td class="border border-black" style="width: 16px !important;">9</td>
                      <td class="border border-black" style="width: 16px !important;">10</td>
                    </tr>
                    <tr>
                      <td class="border border-black" style="width: 16px !important;">1</td>
                      <td class="border border-black" style="width: 16px !important;">2</td>
                      <td class="border border-black" style="width: 16px !important;">3</td>
                      <td class="border border-black" style="width: 16px !important;">4</td>
                      <td class="border border-black" style="width: 16px !important;">5</td>
                      <td class="border border-black" style="width: 16px !important;">6</td>
                      <td class="border border-black" style="width: 16px !important;">7</td>
                      <td class="border border-black" style="width: 16px !important;">8</td>
                      <td class="border border-black" style="width: 16px !important;">9</td>
                      <td class="border border-black" style="width: 16px !important;">10</td>
                    </tr>
                    <tr>
                      <td class="border border-black" style="width: 16px !important;">1</td>
                      <td class="border border-black" style="width: 16px !important;">2</td>
                      <td class="border border-black" style="width: 16px !important;">3</td>
                      <td class="border border-black" style="width: 16px !important;">4</td>
                      <td class="border border-black" style="width: 16px !important;">5</td>
                      <td class="border border-black" style="width: 16px !important;">6</td>
                      <td class="border border-black" style="width: 16px !important;">7</td>
                      <td class="border border-black" style="width: 16px !important;">8</td>
                      <td class="border border-black" style="width: 16px !important;">9</td>
                      <td class="border border-black" style="width: 16px !important;">10</td>
                    </tr>
                    <tr>
                      <td class="border border-black" style="width: 16px !important;">1</td>
                      <td class="border border-black" style="width: 16px !important;">2</td>
                      <td class="border border-black" style="width: 16px !important;">3</td>
                      <td class="border border-black" style="width: 16px !important;">4</td>
                      <td class="border border-black" style="width: 16px !important;">5</td>
                      <td class="border border-black" style="width: 16px !important;">6</td>
                      <td class="border border-black" style="width: 16px !important;">7</td>
                      <td class="border border-black" style="width: 16px !important;">8</td>
                      <td class="border border-black" style="width: 16px !important;">9</td>
                      <td class="border border-black" style="width: 16px !important;">10</td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td class=" border-black w-36">
                <table class="w-full">
                  <tbody class="w-full ">
                    <tr class="w-full">
                      <td class="border w-12/12 border-black text-center">×××××</td>
                    </tr>
                    <tr class="w-full">
                      <td class="border w-12/12 border-black text-center">×××××</td>
                    </tr>
                    <tr class="w-full">
                      <td class="border w-12/12 border-black text-center">×××××</td>
                    </tr>
                    <tr class="w-full">
                      <td class="border w-12/12 border-black text-center">×××××</td>
                    </tr>
                    <tr class="w-full">
                      <td class="border w-12/12 border-black text-center">×××××</td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
        </tbody>
      </table>
      </td>
      </tr>
      <table class="w-full">
        <tbody>

          <tr class="">
            <td>
              <table class="w-full">
                <tbody class="w-full text-center">
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td class="border-b border-black">V. Profesores por Área:</td>
                          </tr>
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">N</td>
                                    <td class="">Áreas de Formación</td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black">Apellidos y Nombres</td>
                    <td class="border border-black">Cédula de Identidad</td>
                    <td class="border border-black">Firma:</td>
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody>
                          <tr>
                            <td class="border-b border-black">VI. Identiicación del Curso</td>
                          </tr>
                          <tr>
                            <td>Plan de estudio</td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">01</td>
                                    <td class="border-t border-r border-black">CA</td>
                                    <td class="">
                                      <input type="text" name="" id="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black">Educacion Media General:</td>
                  </tr>
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">01</td>
                                    <td class="border-t border-r border-black">CA</td>
                                    <td class="">
                                      <input type="text" name="" id="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black font-bold">Codigo:</td>
                  </tr>
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">01</td>
                                    <td class="border-t border-r border-black">CA</td>
                                    <td class="">
                                      <input type="text" name="" id="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"></td>
                  </tr>
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">01</td>
                                    <td class="border-t border-r border-black">CA</td>
                                    <td class="">
                                      <input type="text" name="" id="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black">AÑO CURSADO: </td>
                  </tr>
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">01</td>
                                    <td class="border-t border-r border-black">CA</td>
                                    <td class="">
                                      <input type="text" name="" id="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"></td>
                  </tr>
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">01</td>
                                    <td class="border-t border-r border-black">CA</td>
                                    <td class="">
                                      <input type="text" name="" id="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black">SECCIÓN:</td>
                  </tr>
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">01</td>
                                    <td class="border-t border-r border-black">CA</td>
                                    <td class="">
                                      <input type="text" name="" id="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"></td>
                  </tr>
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">01</td>
                                    <td class="border-t border-r border-black">CA</td>
                                    <td class="">
                                      <input type="text" name="" id="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black">
                      <table>
                        <tbody>
                          <tr>
                            <td class="w-6/12 border border-black">Nº DE ESTUDIANTES POR SECCIÓN</td>
                            <td class="w-6/12 h-full border border-black">Nº DE ESTUDIANTES POR ESTA PÁGINA</td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr class="w-full">
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td>
                              <table class="w-full text-center">
                                <tbody>
                                  <tr class="w-full">
                                    <td class="border-t border-r border-black">01</td>
                                    <td class="border-t border-r border-black">CA</td>
                                    <td class="">
                                      <input type="text" name="" id="">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black"><input type="text" name="" id=""></td>
                    <td class="border border-black">
                      <table class="w-full">
                        <tbody class="">
                          <tr>
                            <td class="w-6/12">0</td>
                            <td class="w-6/12">0</td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </tbody>
    </table>
    <span class="font-bold mt-2 ml-1">
      <span class="w-full flex flex-row">
        VI.Observaciones:
        <div class="border-b  border-black w-11/12 mr-2">
          <!-- Agua Blanca -->
        </div>
      </span>
    </span>
    <br>
    <div class="flex flex-row border-l border-black w-12/12 mx-2">
      <!-- Agua Blanca -->
    </div>

    <div class="flex space-x-1 space-y-auto mx-1 items-center border-black">

      <!-- PLANTEL ./ -->
      <div class="flex flex-col w-6/12">
        <span class="font-bold text-left p-1 border border-black border-b-0">VII. Plantel</span>
        <table class="table-auto w-full">
          <tbody>
            <tr>
              <td class=" p-0 w-2/4">
                <table class="table-auto w-full max-w-sm ">
                  <tbody>
                    <tr class="border border-black p-1">
                      <td>Director(a)</td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>Apellidos y Nombres:</td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>
                        <input type="text" class="w-full outline-none border-none" value="<?php echo isset($director['nombre_persona']) ? $director['nombre_persona'] . $director['apellido_persona'] : '**'; ?>">
                      </td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>Cédula de Identidad</td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td><input type="text" class="w-full outline-none border-none" value="<?php echo isset($director['nacionalidad_persona']) ? $director['nacionalidad_persona'] . ' ' . $director['cedula_persona'] : '**'; ?>"></td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>Firma</td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>Para efectos de su validez Nacional</td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td class="border-t border-b border-r border-black p-1 text-center">SELLO DEL PLANTEL</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- ./PLANTEL -->
      <!-- PLANTEL ./ -->
      <div class="flex flex-col w-6/12">
        <span class="font-bold text-left p-1 border border-black border-b-0"">VIII. Zona Educativa</span>
            <table class=" table-auto border-black w-full">
          <tbody>
            <tr>
              <td class="border-black p-0 w-2/4">
                <table class="table-auto w-full max-w-sm ">
                  <tbody>
                    <tr class="border border-black p-1">
                      <td>Director(a)</td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>Apellidos y Nombres:</td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>
                        <input type="text" class="w-full outline-none border-none">
                      </td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>Cédula de Identidad</td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td><input type="text" class="w-full outline-none border-none"></td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>Firma</td>
                    </tr>
                    <tr class="border border-black p-1">
                      <td>Para efectos de su validez Nacional</td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td class="border-t border-b border-r border-black p-1 text-center">SELLO DE LA ZONA EDUCATIVA</td>
            </tr>
          </tbody>
          </table>
      </div>
    </div>
  </div>
  </div>
  <script>
    window.matchMedia('print').addListener((evento) => {
      if (!evento.matches) window.close()
    });
    window.print()
  </script>
</body>

</html>