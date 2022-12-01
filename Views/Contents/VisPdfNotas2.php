<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./Views/Css/estilos.css" />
  <style>
    * {
      font-size: 9px !important;
    }
  </style>
  <title>.</title>
</head>

<body>
  <?php
  if ($primero == [] && $segundo == [] && $tercero == [] && $cuarto == [] && $quinto == [] && $sexto == []) {
  ?>
    <script>
      alert("El estudiante no tiene notas registradas");
      window.close();
    </script>
  <?php
  }
  ?>
  <div class="mx-auto w-10/12 text-sm p-1" id="pagina">
    <div class="w-full flex justify-between items-center">
      <img src="./Views/includes/images.png" alt="" srcset="" width="300" />
      <div class="flex flex-col justify-right">
        <span class="font-bold underline">
          CERTIFICACIÓN DE CALIFICACIONES EMG
        </span>
        <span class="flex flex-row space-x-2">
          <p class="">
            I. Plan de estudio:
          <div class="border-b-2 border-black w-30">
            <span class="font-bold"> EDUCACIÓN MEDIA GENERAL </span>
          </div>
          </p>

          <div class="border-b-2 border-black w-30">
            Código:
            <span class="font-bold"><?php echo $code_pensum; ?></span>
          </div>
        </span>
        <span class="flex flex-row">
          Lugar y Fecha de Expedición:
          <div class="border-b-2 border-black w-60 text-center">
            <span class="font-bold"><?php echo $fecha_actual; ?></span>
          </div>
        </span>
      </div>
    </div>
    <!-- DATOS DE LA INSTITUCION -->
    <div class="w-full flex flex-col">
      <span class="font-bold capitalize">
        II. datos del plantel o zona educativa que emite la certificación:
      </span>
      <div class="flex space-x-1 mx-1 my-1">
        <span class="w-4/12 flex flex-row">
          Código:
          <div class="border-b border-black w-full mx-1">
            <?php echo strtoupper($inst['codigo_institucion']); ?>
          </div>
        </span>
        <span class="w-8/12 flex flex-row">
          Nombre:
          <div class="border-b border-black w-full mx-1">
            <?php echo strtoupper($inst['des_institucion']); ?>
          </div>
        </span>
      </div>

      <div class="flex space-x-1 mx-1 my-1">
        <span class="w-8/12 flex flex-row">
          Dirección:
          <div class="border-b border-black w-full mx-1">
            <?php echo strtoupper($inst['direccion_institucion']); ?>
          </div>
        </span>
        <span class="w-4/12 flex flex-row">
          Telefono:
          <div class="border-b border-black w-full mx-1">
            <?php echo $inst['telefono']; ?>
          </div>
        </span>
      </div>

      <div class="flex space-x-1 mx-1 my-2">
        <span class="w-3/12 flex flex-row">
          Municipio:
          <div class="border-b border-black w-3/4 ml-1">
            <?php echo strtoupper($inst['municipio']); ?>
          </div>
        </span>

        <span class="w-5/12 flex flex-row">
          Entidad Federal:
          <div class="border-b border-black w-4/6 ml-1">
            <?php echo strtoupper($inst['entidad_federal']); ?>
          </div>
        </span>

        <span class="w-4/12 flex flex-row">
          Zona Educativa:
          <div class="border-b border-black w-6/12 ml-1">
            <?php echo strtoupper($inst['zona_educativa']); ?>
          </div>
        </span>
      </div>
      <span class="font-bold capitalize">
        III. datos de identificación del estudiante:
      </span>
      <div class="flex space-x-1 space-y-1 mx-1 my-1">
        <span class="w-4/12 flex flex-row">
          Cédula:
          <div class="border-b border-black w-4/6 mx-1">
            <?php echo $nacionalidad . "-" . $cedula; ?>
          </div>
        </span>
        <span class="w-full flex flex-row">
          Fecha de Nacimiento:
          <div class="border-b border-black w-4/6 mx-1">
            <?php echo $fecha->format("d/m/Y"); ?>
          </div>
        </span>
      </div>
      <div class="flex space-x-1 space-y-1 mx-1 my-1">
        <span class="w-6/12 flex flex-row">
          Nombre:
          <div class="border-b border-black w-full mx-1">
            <?php echo $nombre; ?>
          </div>
        </span>
        <span class="w-6/12 flex flex-row">
          Apellido:
          <div class="border-b border-black w-full mx-1">
            <?php echo $apellido; ?>
          </div>
        </span>
      </div>
      <div class="flex space-x-1 space-y-1 mx-1 my-1">
        <span class="w-5/12 flex flex-row">
          Lugar de nacimiento: Pais:
          <div class="border-b border-black w-2/4 ml-1">
            <!-- Agua Blanca -->
          </div>
        </span>

        <span class="w-3/12 flex flex-row">
          Estado:
          <div class="border-b border-black w-full ml-1">
            <!-- PORTUGUESA -->
          </div>
        </span>

        <span class="w-4/12 flex flex-row">
          Municipio:
          <div class="border-b border-black w-full ml-1">
            <!-- PORTUGUESA -->
          </div>
        </span>
      </div>
      <span class="font-bold capitalize my-1">
        IV. planteles donde cursó estudios:
      </span>
      <div class="flex space-x-1 space-y-1 mx-1 items-center relative h-24"">
        <table class="table-auto border border-collapse  border-black w-3/6 h-24">
          <thead>
            <th class="border border-black my-2 p-1">N</th>
            <th class="border border-black my-2 p-1">Nombre del plantel</th>
            <th class="border border-black my-2 p-1">Localidad</th>
            <th class="border border-black my-2 p-1">E.F</th>
          </thead>
          <tbody class="text-center">
            <tr>
              <td class="border border-black my-2 p-1">1</td>
              <td class="border border-black my-2 p-1"></td>
              <td class="border border-black my-2 p-1"></td>
              <td class="border border-black my-2 p-1"></td>
            </tr>
            <tr>
              <td class="border border-black my-2 p-1">2</td>
              <td class="border border-black my-2 p-1"></td>
              <td class="border border-black my-2 p-1"></td>
              <td class="border border-black my-2 p-1"></td>
            </tr>
          </tbody>
        </table>
        <table class="table-auto border border-black w-3/6 h-24 absolute text-center -right-1 -top-0" style="transform: translateY(-7px) !important; ">  
          <thead class="p-2">
            <th class="border border-black p-1">N</th>
            <th class="border border-black p-1">Nombre del plantel</th>
            <th class="border border-black p-1">Localidad</th>
            <th class="border border-black p-1">E.F</th>
          </thead>
          <tbody class="p-2">
            <tr>
              <td class="border border-black p-1">3</td>
              <td class="border border-black p-1"></td>
              <td class="border border-black p-1"></td>
              <td class="border border-black p-1"></td>
            </tr>
            <tr>
              <td class="border border-black p-1">4</td>
              <td class="border border-black p-1"></td>
              <td class="border border-black p-1"></td>
              <td class="border border-black p-1"></td>
            </tr>
            <tr>
              <td class="border border-black p-1">5</td>
              <td class="border border-black p-1"></td>
              <td class="border border-black p-1"></td>
              <td class="border border-black p-1"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <span class="font-bold capitalize mt-1">
        V. plan de estudio:
      </span>
      <div class="flex space-x-1 space-y-auto mx-1 my-1 items-center">
        <!-- PRIMER AÑO ./ -->

        <div class="flex flex-col text-center w-6/12">
          <span class="font-bold my-1">PRIMER AÑO</span>
          <table class="table-auto border border-collapse  border-black w-full">
            <thead class="h-12">
              <th class="border border-black p-1">ÁREA DE FORMACIÓN</th>
              <th class="border border-black p-0 relative w-48">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>CALIFICACIÓN</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black w-1/6">N</td>
                      <td class="border-l border-black">LETRA</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">T-E</th>
              <th class="border border-black p-1 relative w-36">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>FECHA</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black space-x-2 w-1/6">MES</td>
                      <td class="border-l border-black">AÑO</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">Plantel <br> N</th>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < 7; $i++) {
                $materias_1 = $primero[$i];
                if (intval($materias_1['nota_final']) < 10) {
                  if (intval($materias_1['recuperativo_1']) < 10) {
                    if (intval($materias_1['recuperativo_2']) < 10) {
                      if (intval($materias_1['recuperativo_3']) < 10) {
                        if (intval($materias_1['recuperativo_4']) < 10) {
                          $final = $materias_1['recuperativo_4'];
                        } else {
                          $final = $materias_1['recuperativo_4'];
                        }
                      } else {
                        $final = $materias_1['recuperativo_3'];
                      }
                    } else {
                      $final = $materias_1['recuperativo_2'];
                    }
                  } else {
                    $final = $materias_1['recuperativo_1'];
                  }
                } else {
                  $final = $materias_1['nota_final'];
                }

                $letra = ($final >= 10) ? "F" : "R";
                $periodo = explode("-", $materias_1['periodoescolar']);
                $number = new NumberFormatter("es", NumberFormatter::SPELLOUT);
                $numer_letra = $number->format(intval($final));
              ?>
                <tr>
                  <td class="border border-black p-1"><?php echo isset($materias_1['des_materia']) ? $materias_1['des_materia'] : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 16px !important;"><?php echo isset($final) ? $final : '**'; ?></td>
                          <td class="border-l border-black "><?php echo isset($final) ? $numer_letra : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1"><?php echo isset($final) ? $letra : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 21px !important;"><?php echo isset($final) ? '07' : '**'; ?></td>
                          <td class="border-l border-black"><?php echo isset($final) ? $periodo[0] : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1">1</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- ./PRIMERO AÑO -->

        <!-- SEGUNDO AÑO ./ -->
        <div class="flex flex-col text-center w-6/12">
          <span class="font-bold my-1">SEGUNDO AÑO</span>
          <table class="table-auto border border-collapse  border-black w-full">
            <thead class="h-12">
              <th class="border border-black p-1">ÁREA DE FORMACIÓN</th>
              <th class="border border-black p-0 relative w-48">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>CALIFICACIÓN</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black w-1/6">N</td>
                      <td class="border-l border-black">LETRA</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">T-E</th>
              <th class="border border-black p-1 relative w-36">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>FECHA</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black space-x-2 w-1/6">MES</td>
                      <td class="border-l border-black">AÑO</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">Plantel <br> N</th>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < 7; $i++) {
                $materias_2 = $segundo[$i];
                if (intval($materias_2['nota_final']) < 10) {
                  if (intval($materias_2['recuperativo_1']) < 10) {
                    if (intval($materias_2['recuperativo_2']) < 10) {
                      if (intval($materias_2['recuperativo_3']) < 10) {
                        if (intval($materias_2['recuperativo_4']) < 10) {
                          $final = $materias_2['recuperativo_4'];
                        } else {
                          $final = $materias_2['recuperativo_4'];
                        }
                      } else {
                        $final = $materias_2['recuperativo_3'];
                      }
                    } else {
                      $final = $materias_2['recuperativo_2'];
                    }
                  } else {
                    $final = $materias_2['recuperativo_1'];
                  }
                } else {
                  $final = $materias_2['nota_final'];
                }

                $letra = ($final >= 10) ? "F" : "R";
                $periodo = explode("-", $materias_2['periodoescolar']);
                $number = new NumberFormatter("es", NumberFormatter::SPELLOUT);
                $numer_letra = $number->format(intval($final));
              ?>
                <tr>
                  <td class="border border-black p-1"><?php echo isset($materias_2['des_materia']) ? $materias_2['des_materia'] : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 16px !important;"><?php echo isset($final) ? $final : '**'; ?></td>
                          <td class="border-l border-black "><?php echo isset($final) ? $numer_letra : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1"><?php echo isset($final) ? $letra : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 21px !important;"><?php echo isset($final) ? '07' : '**'; ?></td>
                          <td class="border-l border-black"><?php echo isset($final) ? $periodo[0] : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1">1</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- ./SEGUNDO AÑO -->

      </div>
      <div class="flex space-x-1 space-y-auto mx-1 my-1 items-center">

        <!-- TERCER AÑO ./ -->
        <div class="flex flex-col text-center w-6/12">
          <span class="font-bold my-1">TERCER AÑO</span>
          <table class="table-auto border border-collapse  border-black w-full">
            <thead class="h-12">
              <th class="border border-black p-1">ÁREA DE FORMACIÓN</th>
              <th class="border border-black p-0 relative w-48">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>CALIFICACIÓN</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black w-1/6">N</td>
                      <td class="border-l border-black">LETRA</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">T-E</th>
              <th class="border border-black p-1 relative w-36">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>FECHA</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black space-x-2 w-1/6">MES</td>
                      <td class="border-l border-black">AÑO</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">Plantel <br> N</th>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < 8; $i++) {
                $materias_3 = $tercero[$i];
                if (intval($materias_3['nota_final']) < 10) {
                  if (intval($materias_3['recuperativo_1']) < 10) {
                    if (intval($materias_3['recuperativo_2']) < 10) {
                      if (intval($materias_3['recuperativo_3']) < 10) {
                        if (intval($materias_3['recuperativo_4']) < 10) {
                          $final = $materias_3['recuperativo_4'];
                        } else {
                          $final = $materias_3['recuperativo_4'];
                        }
                      } else {
                        $final = $materias_3['recuperativo_3'];
                      }
                    } else {
                      $final = $materias_3['recuperativo_2'];
                    }
                  } else {
                    $final = $materias_3['recuperativo_1'];
                  }
                } else {
                  $final = $materias_3['nota_final'];
                }

                $letra = ($final >= 10) ? "F" : "R";
                $periodo = explode("-", $materias_3['periodoescolar']);
                $number = new NumberFormatter("es", NumberFormatter::SPELLOUT);
                $numer_letra = $number->format(intval($final));
              ?>
                <tr>
                  <td class="border border-black p-1"><?php echo isset($materias_3['des_materia']) ? $materias_3['des_materia'] : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 16px !important;"><?php echo isset($final) ? $final : '**'; ?></td>
                          <td class="border-l border-black "><?php echo isset($final) ? $numer_letra : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1"><?php echo isset($final) ? $letra : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 21px !important;"><?php echo isset($final) ? '07' : '**'; ?></td>
                          <td class="border-l border-black"><?php echo isset($final) ? $periodo[0] : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1">1</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- ./TERCER AÑO -->

        <!-- CUARTO AÑO ./ -->
        <div class="flex flex-col text-center w-6/12">
          <span class="font-bold my-1">CUARTO AÑO</span>
          <table class="table-auto border border-collapse  border-black w-full">
          <thead class="h-12">
              <th class="border border-black p-1">ÁREA DE FORMACIÓN</th>
              <th class="border border-black p-0 relative w-48">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>CALIFICACIÓN</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black w-1/6">N</td>
                      <td class="border-l border-black">LETRA</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">T-E</th>
              <th class="border border-black p-1 relative w-36">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>FECHA</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black space-x-2 w-1/6">MES</td>
                      <td class="border-l border-black">AÑO</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">Plantel <br> N</th>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < 8; $i++) {
                $materias_4 = $cuarto[$i];
                if (intval($materias_4['nota_final']) < 10) {
                  if (intval($materias_4['recuperativo_1']) < 10) {
                    if (intval($materias_4['recuperativo_2']) < 10) {
                      if (intval($materias_4['recuperativo_3']) < 10) {
                        if (intval($materias_4['recuperativo_4']) < 10) {
                          $final = $materias_4['recuperativo_4'];
                        } else {
                          $final = $materias_4['recuperativo_4'];
                        }
                      } else {
                        $final = $materias_4['recuperativo_3'];
                      }
                    } else {
                      $final = $materias_4['recuperativo_2'];
                    }
                  } else {
                    $final = $materias_4['recuperativo_1'];
                  }
                } else {
                  $final = $materias_4['nota_final'];
                }

                $letra = ($final >= 10) ? "F" : "R";
                $periodo = explode("-", $materias_4['periodoescolar']);
                $number = new NumberFormatter("es", NumberFormatter::SPELLOUT);
                $numer_letra = $number->format(intval($final));
              ?>
                <tr>
                  <td class="border border-black p-1"><?php echo isset($materias_4['des_materia']) ? $materias_4['des_materia'] : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 16px !important;"><?php echo isset($final) ? $final : '**'; ?></td>
                          <td class="border-l border-black "><?php echo isset($final) ? $numer_letra : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1"><?php echo isset($final) ? $letra : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 21px !important;"><?php echo isset($final) ? '07' : '**'; ?></td>
                          <td class="border-l border-black"><?php echo isset($final) ? $periodo[0] : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1">1</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- ./CUARTO AÑO -->

      </div>
      <div class="flex space-x-1 space-y-auto mx-1 my-1 items-center">

        <!-- QUINTO AÑO ./ -->
        <div class="flex flex-col text-center w-6/12">
          <span class="font-bold my-1">QUINTO AÑO</span>
          <table class="table-auto border border-collapse  border-black w-full">
            <thead class="h-12">
              <th class="border border-black p-1">ÁREA DE FORMACIÓN</th>
              <th class="border border-black p-0 relative w-48">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>CALIFICACIÓN</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black w-1/6">N</td>
                      <td class="border-l border-black">LETRA</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">T-E</th>
              <th class="border border-black p-1 relative w-36">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>FECHA</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black space-x-2 w-1/6">MES</td>
                      <td class="border-l border-black">AÑO</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">Plantel <br> N</th>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < 10; $i++) {
                $materias_5 = $quinto[$i];
                if (intval($materias_5['nota_final']) < 10) {
                  if (intval($materias_5['recuperativo_1']) < 10) {
                    if (intval($materias_5['recuperativo_2']) < 10) {
                      if (intval($materias_5['recuperativo_3']) < 10) {
                        if (intval($materias_5['recuperativo_4']) < 10) {
                          $final = $materias_5['recuperativo_4'];
                        } else {
                          $final = $materias_5['recuperativo_4'];
                        }
                      } else {
                        $final = $materias_5['recuperativo_3'];
                      }
                    } else {
                      $final = $materias_5['recuperativo_2'];
                    }
                  } else {
                    $final = $materias_5['recuperativo_1'];
                  }
                } else {
                  $final = $materias_5['nota_final'];
                }

                $letra = ($final >= 10) ? "F" : "R";
                $periodo = explode("-", $materias_5['periodoescolar']);
                $number = new NumberFormatter("es", NumberFormatter::SPELLOUT);
                $numer_letra = $number->format(intval($final));
              ?>
                <tr>
                  <td class="border border-black p-1"><?php echo isset($materias_5['des_materia']) ? $materias_5['des_materia'] : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 16px !important;"><?php echo isset($final) ? $final : '**'; ?></td>
                          <td class="border-l border-black "><?php echo isset($final) ? $numer_letra : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1"><?php echo isset($final) ? $letra : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 21px !important;"><?php echo isset($final) ? '07' : '**'; ?></td>
                          <td class="border-l border-black"><?php echo isset($final) ? $periodo[0] : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1">1</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- ./QUINTO AÑO -->
        <!-- SEXTO AÑO ./ -->
        <div class="flex flex-col text-center w-6/12">
          <span class="font-bold my-1">SEXTO AÑO</span>
          <table class="table-auto border border-collapse  border-black w-full">
            <thead class="h-12">
              <th class="border border-black p-1">ÁREA DE FORMACIÓN</th>
              <th class="border border-black p-0 relative w-48">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>CALIFICACIÓN</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black w-1/6">N</td>
                      <td class="border-l border-black">LETRA</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">T-E</th>
              <th class="border border-black p-1 relative w-36">
                <table class="table-auto border-collapse border-black w-full m-0 p-0 absolute left-0 top-0">
                  <tbody>
                    <tr class="w-full border-b border-black">
                      <td></td>
                      <td>FECHA</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr class="w-full">
                      <td class="border-r border-black space-x-2 w-1/6">MES</td>
                      <td class="border-l border-black">AÑO</td>
                    </tr>
                  </tbody>
                </table>
              </th>
              <th class="border border-black p-1">Plantel <br> N</th>
            </thead>
            <tbody>
              <?php
              for ($i = 0; $i < 10; $i++) {
                $materias_6 = $sexto[$i];
                if (intval($materias_6['nota_final']) < 10) {
                  if (intval($materias_6['recuperativo_1']) < 10) {
                    if (intval($materias_6['recuperativo_2']) < 10) {
                      if (intval($materias_6['recuperativo_3']) < 10) {
                        if (intval($materias_6['recuperativo_4']) < 10) {
                          $final = $materias_6['recuperativo_4'];
                        } else {
                          $final = $materias_6['recuperativo_4'];
                        }
                      } else {
                        $final = $materias_6['recuperativo_3'];
                      }
                    } else {
                      $final = $materias_6['recuperativo_2'];
                    }
                  } else {
                    $final = $materias_6['recuperativo_1'];
                  }
                } else {
                  $final = $materias_6['nota_final'];
                }

                $letra = ($final >= 10) ? "F" : "R";
                $periodo = explode("-", $materias_6['periodoescolar']);
                $number = new NumberFormatter("es", NumberFormatter::SPELLOUT);
                $numer_letra = $number->format(intval($final));
              ?>
                <tr>
                  <td class="border border-black p-1"><?php echo isset($materias_6['des_materia']) ? $materias_6['des_materia'] : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 16px !important;"><?php echo isset($final) ? $final : '**'; ?></td>
                          <td class="border-l border-black "><?php echo isset($final) ? $numer_letra : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1"><?php echo isset($final) ? $letra : '**'; ?></td>
                  <td class="border border-black relative">
                    <table class="table-auto border-collapse border-black w-full h-full m-0 p-0 absolute top-0">
                      <tbody>
                        <tr class="w-full">
                          <td class="border-r border-black" style="width: 21px !important;"><?php echo isset($final) ? '07' : '**'; ?></td>
                          <td class="border-l border-black"><?php echo isset($final) ? $periodo[0] : '**'; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                  <td class="border border-black p-1">1</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- ./SEXTO AÑO -->
      </div>
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
                        <td><input type="text" class="w-full outline-none border-none" value="<?php echo isset($director['nacionalidad_persona']) ? $director['nacionalidad_persona'] . $director['cedula_persona'] : '**'; ?>"></td>
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
        <!-- ./PLANTEL -->
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