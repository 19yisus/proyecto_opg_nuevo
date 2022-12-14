<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
</head>

<body id="body">
	<main>
		<div class="contenedor-total">
			<div id="content-form" class="content-form">
				<h3>CERTIFICADO DE CALIFICACIÓN EMG</h3>
				<div class="div-table">
					<div>
						<div class="planEstudio" >
							<span class="title">I. Plan de Estudio:</span>
							<span class="educacion-media">EDUCACIÓN MEDIA GENERAL </span> Código: <input type="text" class="codigo" value="<?php echo $code_pensum;?>">
						</div>
						<div class="planFecha">
							<span class="title">Lugar y Fecha de Expedición: </span><input type="text" class="lugar-fecha" value="AGUA BLANCA <?php echo $fecha_actual; ?>">
						</div>
						<div class="datosPlantel">
							<span class="title">II. Datos del Plantel o Zona Educativa que Emite la certificación: </span>
						</div>
						<div class="datosPlantel">
							Código: <input type="text" class="cedulaE" value="<?php echo strtoupper($inst['codigo_institucion']);?>"> Nombre:<span class="nombreInstitución"><?php echo strtoupper($inst['des_institucion']);?></span>
						</div>
						<div class="datosPlantel">
							Dirección:<input type="text" class="ubicacion" value="<?php echo strtoupper($inst['direccion_institucion']);?>"> Teléfono: <input type="text" class="telefono" value="<?php echo $inst['telefono'];?>">
						</div>
						<div class="datosPlantel">
							Municipio:<span class="municipio"><?php echo strtoupper($inst['municipio']);?></span> Entidad Federal:<span class="entidadF"><?php echo strtoupper($inst['entidad_federal']); ?></span> Zona Educativa:<span class="zonaE"><?php echo strtoupper($inst['zona_educativa']);?></span>
						</div>
						<div class="datosPlantel">
							<span class="title"> III. Datos de Identificación del Estudiante: </span>
						</div>
						<div class="datosPlantel">
							Cédula de Identidad:<input type="text" class="cedula" value="<?php echo $nacionalidad . "-" . $cedula; ?>">Fecha de Nacimiento: <input type="text" class="fechaNacimiento" value="<?php echo $fecha->format("d/m/Y"); ?>">
							Apellidos:<input type="text" class="apellidos" value="<?php echo $apellido; ?>"> Nombres:<input type="text" class="nombres" value="<?php echo $nombre; ?>">
						</div>
						<!-- <div class="datosPlantel">

                  </div> -->
						<div class="datosPlantel">
							Lugar de Nacimiento: <input type="text" class="pais" value="<?php echo $lugarN; ?>">
							<!-- Lugar de Nacimiento: País: <input type="text" class="pais" value="VENEZUELA">Estado: <input type="text" class="estado" value="PORTUGUESA">Ciudad: <input type="text" class="ciudad" value="PÁEZ"> -->
						</div>
						<div class="datosPlantel">
							<span class="title"> IV. Planteles donde cursó estudios: </span>
						</div>
						<div class="datosPlantelNuevo">
							<table style="margin: -5px; padding: 0;">
								<tr>
									<td>
										<table>
											<thead>
												<tr>
													<th class="numeroP1">N°</th>
													<th class="nombreP1">Nombre del Plantel</th>
													<th class="localidadP1">Localidad</th>
													<th class="ef1">E.F</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="text" class="numeroP2" value="1"></td>
													<td><input type="text" class="nombreP2" value="UEN ÓSCAR PICÓN GIACOPÍNI"></td>
													<td><input type="text" class="localidadP2" value="AGUA BLANCA"></td>
													<td><input type="text" class="ef2" value="PO"></td>
												</tr>
												<tr>
													<td><input type="text" class="numeroP2" value="**"></td>
													<td><input type="text" class="nombreP2" value="**"></td>
													<td><input type="text" class="localidadP2" value="**"></td>
													<td><input type="text" class="ef2" value="**"></td>
												</tr>
											</tbody>
										</table>
									</td>
									<td>
										<table class="tablaPlantel2">
											<thead>
												<tr>
													<th class="numeroP1">N°</th>
													<th class="nombreP1">Nombre del Plantel</th>
													<th class="localidadP1">Localidad</th>
													<th class="ef1">E.F</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><input type="text" class="numeroP2" value="**"></td>
													<td><input type="text" class="nombreP2" value="**"></td>
													<td><input type="text" class="localidadP2" value="**"></td>
													<td><input type="text" class="ef2" value="**"></td>
												</tr>
												<tr>
													<td><input type="text" class="numeroP2" value="**"></td>
													<td><input type="text" class="nombreP2" value="**"></td>
													<td><input type="text" class="localidadP2" value="**"></td>
													<td><input type="text" class="ef2" value="**"></td>
												</tr>
												<tr>
													<td><input type="text" class="numeroP2" value="**"></td>
													<td><input type="text" class="nombreP2" value="**"></td>
													<td><input type="text" class="localidadP2" value="**"></td>
													<td><input type="text" class="ef2" value="**"></td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</table>
						</div>
						<div>
							<div class="datosPlantelEstudio">
								<span class="title"> V. Plan de Estudio: </span>
							</div>
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
							<table>
								<tbody>
									<tr>
										<?php
										if ($seguimiento > 1 && $primero != []) {
										?>
											<td>
												<div class="primeranio-title">PRIMER AÑO</div>
												<table class="datatable-container" autosize="1.0" style="margin: -5px; padding: 0;">
													<thead>
														<tr>
															<th class="content-areaFormacion">ÁREAS DE <br> FORMACIÓN</th>
															<th>
																<div class="spanClasificacion">CALIFICACIÓN</div>
																<span class="spanNumero">N°</span>
																<span class="spanLetras">LETRAS</span>
															</th>
															<th>T-E</th>
															<th>
																<div class="spanFecha">FECHA</div>
																<span class="spanMes">MES</span>
																<span class="spanYear">AÑO</span>
															</th>
															<th class="content-plantel">PLANTEL N°</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($primero as $materias_1) {
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
																<td class="table-input">
																	<input type="text" class="materia" value="<?php echo $materias_1['des_materia']; ?>">
																</td>
																<td>
																	<input type="text" class="numero" name="" value="<?php echo $final; ?>" id="">
																	<input type="text" class="letras" name="" id="" value="<?php echo $numer_letra; ?>">
																</td>
																<td>
																	<input type="text" class="content-te" name="" value="<?php echo $letra; ?>" id="">
																</td>
																<td>
																	<input type="text" class="month" name="" id="" value="07">
																	<input type="text" class="year" name="" id="" value="<?php echo $periodo[0]; ?>">
																</td>
																<td>
																	<input class="plantel" type="text" value="1">
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
											</td>
										<?php
										}
										if ($seguimiento > 2 && $segundo != []) {
										?>
											<td>
												<div class="segundoanio-title">SEGUNDO AÑO</div>
												<table class="datatable-container" style="margin: -5px; padding: 0;">
													<thead>
														<tr>
															<th class="content-areaFormacion">ÁREAS DE <br> FORMACIÓN</th>
															<th>
																<div class="spanClasificacion">CALIFICACIÓN</div>
																<span class="spanNumero">N°</span>
																<span class="spanLetras">LETRAS</span>
															</th>
															<th>T-E</th>
															<th>
																<div class="spanFecha">FECHA</div>
																<span class="spanMes">MES</span>
																<span class="spanYear">AÑO</span>
															</th>
															<th class="content-plantel">PLANTEL N°</th>

														</tr>
													</thead>
													<tbody>
														<?php foreach ($segundo as $materias_2) {
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
																<td class="table-input">
																	<input type="text" class="materia" value="<?php echo $materias_2['des_materia']; ?>">
																</td>
																<td>
																	<input type="text" class="numero" name="" value="<?php echo $final; ?>" id="">
																	<input type="text" class="letras" name="" id="" value="<?php echo $numer_letra; ?>">
																</td>
																<td>
																	<input type="text" class="content-te" name="" value="<?php echo $letra; ?>" id="">
																</td>
																<td>
																	<input type="text" class="month" name="" id="" value="07">
																	<input type="text" class="year" name="" id="" value="<?php echo $periodo[0]; ?>">
																</td>
																<td>
																	<input class="plantel" type="text" value="1">
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
											</td>
										<?php
										}
										?>
									</tr>
									<tr>
										<?php
										if ($seguimiento > 3 && $tercero != []) {
										?>
											<td>
												<div class="primeranio-title">TERCER AÑO</div>
												<table class="datatable-container" style="margin: -5px; padding: 0;">
													<thead>
														<tr>
															<th class="content-areaFormacion">ÁREAS DE <br> FORMACIÓN</th>
															<th>
																<div class="spanClasificacion">CALIFICACIÓN</div>
																<span class="spanNumero">N°</span>
																<span class="spanLetras">LETRAS</span>
															</th>
															<th>T-E</th>
															<th>
																<div class="spanFecha">FECHA</div>
																<span class="spanMes">MES</span>
																<span class="spanYear">AÑO</span>
															</th>
															<th class="content-plantel">PLANTEL N°</th>
														</tr>
													</thead>
													<tbody class="notas_tbody">
														<?php
														foreach ($tercero as $materias_3) {
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
																<td class="table-input">
																	<input type="text" class="materia" value="<?php echo $materias_3['des_materia']; ?>">
																</td>
																<td>
																	<input type="text" class="numero" name="" value="<?php echo $final; ?>" id="">
																	<input type="text" class="letras" name="" id="" value="<?php echo $numer_letra; ?>">
																</td>
																<td>
																	<input type="text" class="content-te" name="" value="<?php echo $letra; ?>" id="">
																</td>
																<td>
																	<input type="text" class="month" name="" id="" value="07">
																	<input type="text" class="year" name="" id="" value="<?php echo $periodo[0]; ?>">
																</td>
																<td>
																	<input class="plantel" type="text" value="1">
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
											</td>
										<?php
										}
										if ($seguimiento > 4 && $cuarto != []) {
										?>
											<td>
												<div class="segundoanio-title">CUARTO AÑO</div>
												<table class="datatable-container" style="margin: -5px; padding: 0;">
													<thead>
														<tr>
															<th class="content-areaFormacion">ÁREAS DE <br> FORMACIÓN</th>
															<th>
																<div class="spanClasificacion">CALIFICACIÓN</div>
																<span class="spanNumero">N°</span>
																<span class="spanLetras">LETRAS</span>
															</th>
															<th>T-E</th>
															<th>
																<div class="spanFecha">FECHA</div>
																<span class="spanMes">MES</span>
																<span class="spanYear">AÑO</span>
															</th>
															<th class="content-plantel">PLANTEL N°</th>
														</tr>
													</thead>
													<tbody>
														<?php
														foreach ($cuarto as $materias_4) {
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
																<td class="table-input">
																	<input type="text" class="materia" value="<?php echo $materias_4['des_materia']; ?>">
																</td>
																<td>
																	<input type="text" class="numero" name="" value="<?php echo $final; ?>" id="">
																	<input type="text" class="letras" name="" id="" value="<?php echo $numer_letra; ?>">
																</td>
																<td>
																	<input type="text" class="content-te" name="" value="<?php echo $letra; ?>" id="">
																</td>
																<td>
																	<input type="text" class="month" name="" id="" value="07">
																	<input type="text" class="year" name="" id="" value="<?php echo $periodo[0]; ?>">
																</td>
																<td>
																	<input class="plantel" type="text" value="1">
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
											</td>
										<?php
										}
										?>
									</tr>
									<tr>
										<?php
										if ($seguimiento > 5 && $quinto != []) {
										?>
											<td>
												<div class="primeranio-title">QUINTO AÑO</div>
												<table class="datatable-container" style="margin: -5px; padding: 0;">
													<thead>
														<tr>
															<th class="content-areaFormacion">ÁREAS DE <br> FORMACIÓN</th>
															<th>
																<div class="spanClasificacion">CALIFICACIÓN</div>
																<span class="spanNumero">N°</span>
																<span class="spanLetras">LETRAS</span>
															</th>
															<th>T-E</th>
															<th>
																<div class="spanFecha">FECHA</div>
																<span class="spanMes">MES</span>
																<span class="spanYear">AÑO</span>
															</th>
															<th class="content-plantel">PLANTEL N°</th>
														</tr>
													</thead>
													<tbody>
														<?php
														foreach ($quinto as $materias_5) {
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
																<td class="table-input">
																	<input type="text" class="materia" value="<?php echo $materias_5['des_materia']; ?>">
																</td>
																<td>
																	<input type="text" class="numero" name="" value="<?php echo $final; ?>" id="">
																	<input type="text" class="letras" name="" id="" value="<?php echo $numer_letra; ?>">
																</td>
																<td>
																	<input type="text" class="content-te" name="" value="<?php echo $letra; ?>" id="">
																</td>
																<td>
																	<input type="text" class="month" name="" id="" value="07">
																	<input type="text" class="year" name="" id="" value="<?php echo $periodo[0]; ?>">
																</td>
																<td>
																	<input class="plantel" type="text" value="1">
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
											</td>
										<?php
										}
										if ($seguimiento == 6  && $sexto != []) {
										?>
											<td>
												<div class="segundoanio-title">SEXTO AÑO</div>
												<table class="datatable-container" style="margin: -5px; padding: 0;">
													<thead>
														<tr>
															<th class="content-areaFormacion">ÁREAS DE <br> FORMACIÓN</th>
															<th>
																<div class="spanClasificacion">CALIFICACIÓN</div>
																<span class="spanNumero">N°</span>
																<span class="spanLetras">LETRAS</span>
															</th>
															<th>T-E</th>
															<th>
																<div class="spanFecha">FECHA</div>
																<span class="spanMes">MES</span>
																<span class="spanYear">AÑO</span>
															</th>
															<th class="content-plantel">PLANTEL N°</th>
														</tr>
													</thead>
													<tbody>
														<?php
														foreach ($sexto as $materias_6) {
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
																<td class="table-input">
																	<input type="text" class="materia" value="<?php echo $materias_6['des_materia']; ?>">
																</td>
																<td>
																	<input type="text" class="numero" name="" value="<?php echo $final; ?>" id="">
																	<input type="text" class="letras" name="" id="" value="<?php echo $numer_letra; ?>">
																</td>
																<td>
																	<input type="text" class="content-te" name="" value="<?php echo $letra; ?>" id="">
																</td>
																<td>
																	<input type="text" class="month" name="" id="" value="07">
																	<input type="text" class="year" name="" id="" value="<?php echo $periodo[0]; ?>">
																</td>
																<td>
																	<input class="plantel" type="text" value="1">
																</td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
											</td>
										<?php } ?>
									</tr>
									<tr style="height: 15px;">
										<td style="border: 1px solid black; border-right: none;">
											<div class=""> VI. Observaciones: </div>
										</td>
										<td style="border: 1px solid black; border-left: none;">

										</td>
									</tr>
									<tr>
										<td style="border: 1px solid black; border-right: none;">
											<div class="">Fecha: </div>
										</td>
										<td style="border: 1px solid black; border-left: none;">
										</td>
									</tr>
								</tbody>
							</table>
							<table>
								<tbody>
									<tr>
										<td>
											<div class="segundoanio-title">VII. Plantel</div>
											<table style="width: 100%;" class="areas_formacion">
												<tbody>
													<tr>
														<td>
															<input type="text" class="plantel_input" value="Director(a)"><br>
															<input type="text" class="plantel_input" value="Apellidos y Nombres"><br>
															<input type="text" class="plantel_input" value="<?php echo isset($director['nombre_persona']) ? $director['nombre_persona'].$director['apellido_persona'] : ''; ?>"><br>
															<input type="text" class="plantel_input" value="Cedula de Identidad"><br>
															<input type="text" class="plantel_input" value="<?php echo isset($director['nacionalidad_persona']) ? $director['nacionalidad_persona'].$director['cedula_persona'] : ''; ?>"><br>
															<input type="text" class="plantel_input" value="Firma: "><br>
															<input type="text" class="plantel_input" value="Para efectos de su Validez Nacional">
														</td>
														<td class="content-areaFormacion" style="text-align: center;  border: 1px solid black; height: 130px; width: 170px;">
															SELLO DEL PLANTEL </td>
													</tr>
												</tbody>
											</table>
										</td>
										<td>
											<div class="segundoanio-title">VIII. Zona Edutativa</div>
											<table style="width: 100%;" class="areas_formacion">
												<tbody>
													<tr>
														<td>
															<input type="text" class="plantel_input" style="width: 220px;" value="Director(a)"><br>
															<input type="text" class="plantel_input" style="width: 220px;" value="Apellidos y Nombres"><br>
															<input type="text" class="plantel_input" style="width: 220px;" value=""><br>
															<input type="text" class="plantel_input" style="width: 220px;" value="Cedula de Identidad"><br>
															<input type="text" class="plantel_input" style="width: 220px;" value=""><br>
															<input type="text" class="plantel_input" style="width: 220px;" value="Firma"><br>
															<input type="text" class="plantel_input" style="width: 220px;" value="Para efectos de su Validez Internacional">
														</td>
														<td class="content-areaFormacion" style="text-align: center;  border: 1px solid black; height: 130px; width: 150px;">
															SELLO DE LA ZONA EDUCATIVA </td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</body>

</html>