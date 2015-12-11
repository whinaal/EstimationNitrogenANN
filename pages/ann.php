		<!DOCTYPE html>
		<html lang="en">
		<!-- SB Admin 2 Twitter Bootstrap theme -->
		<head>

			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">

			<title>Aplikasi ANN </title>

			<!-- Bootstrap Core CSS -->
			<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

			<!-- MetisMenu CSS -->
			<link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

			<!-- Custom CSS -->
			<link href="../dist/css/sb-admin-2.css" rel="stylesheet">

			<!-- Custom Fonts -->
			<link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

			<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
			<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
			<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->

		</head>

		<body>

			<div id="wrapper">

				<!-- Navigation -->
				<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						
						<a class="navbar-brand">Aplikasi Web Estimasi Kadar Nitrogen Daun Padi</a>
					</div>
					<!-- /.navbar-header -->

				</nav>

				<div id="page-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">Estimasi Kadar Nitrogen Daun Padi</h1>
						</div>
						<!-- /.col-lg-12 -->
					</div>
					
					<!-- /.row -->
					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Pelatihan dan Pengujian
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6">
										
									
											<form role="form" action="" method="POST" enctype="multipart/form-data" data-toggle="validator">
											
											<h4><b>Data</b></h4>
											   <hr width="300" align="left"</hr>
											   
												<div class="form-group">
													<label>File training</label>
													<input type="file" name="filetr"  required/>
													
												</div>
												
												
												<div class="form-group">
													<label>File testing</label>
													<input type="file" name="file"  required/>
													<div class="help-block with-errors"></div>
												</div>
											
												
												<div class="form-group">
													<label>Jumlah node input layer</label>
													<input class="form-control" placeholder="Contoh: 20" name="attrib" required>
												</div>
												
												<div class="form-group">
													<label>Jumlah node hidden layer</label>
													<select class="form-control" name="options" required>
														<option>3</option>
														<option>4</option>
														<option>5</option>
														<option>6</option>
														<option>7</option>
														<option>8</option>
														<option>9</option>
														<option>10</option>
														<option>11</option>
														<option>12</option>
														<option>13</option>
														<option>14</option>
														<option>15</option>
														<option>16</option>
														<option>17</option>
														<option>18</option>
														<option>19</option>
														<option>20</option>
													</select>
												</div>
												
												<div class="form-group">
													<label>Jumlah data latih</label>
													<input class="form-control" placeholder="Contoh: 100 " name="dl" required>
												</div>
												
												<div class="form-group">
													<label>Jumlah data uji</label>
													<input class="form-control" placeholder="Contoh: 30 " name="dt" required>
												</div>
												
												
												
												
										</div>
										<!-- /.col-lg-6 (nested) -->
										
										<div class="col-lg-6">		
										
										       <h4><b>Parameter model</b></h4>
											   <hr width="300" align="left"</hr>
											   
												<div class="form-group">
													<label>Epoch</label>
													<input class="form-control" placeholder="Maximum is 1000" name="epoch" required>
												</div>

											<div class="form-group">
													<label>Learning rate</label>
													<input class="form-control" placeholder="Contoh: 0.01 " name="lrate" required>
												</div>
												
												
												
												<div class="form-group">
													<label>Momentum</label>
													<input class="form-control" placeholder="Contoh: 0.01 " name="momentum" required>
												</div>
												
												 <div class="form-group">
													<label>Toleransi error</label>
													<input class="form-control" placeholder="Contoh: 0.0000001" name="error" required>
												</div>
												
												
												
												
																				
					</div>              
					</div>
					
					<div class="row">
					<div class="col-lg-12">
					<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
					</div>
					
					</div>
					
					</div>
					</div></div>
					
					
					<div class="col-lg-6">
							<div class="panel panel-primary">
								<div class="panel-heading">
									Hasil Estimasi
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
										
											<form role="form">
											<?php
											if (isset( $_POST['submit'])) 
											{ 
											$ftr=$_FILES['filetr']['tmp_name'];
											$fts=$_FILES['file']['tmp_name'];
											$dt=$_POST['dt'];
											$dl=$_POST['dl'];
											$attrib=$_POST['attrib'];
											$var=$_POST['options'];
											$epoch=$_POST['epoch'];
											$error=$_POST['error'];
											$lrate=$_POST['lrate'];
											$momentum=$_POST['momentum'];
											
											//Fungsi exec untuk pass parameter dari PHP ke argumen fungsi di program c++
											exec("bin\\Debug\\ann $dl $var $epoch $error $lrate $momentum $ftr $fts $dt $attrib",$output);
											$val = implode("", $output);
											$split=str_split($val,4);
											$rmse=$split[0];
											$accuracy=$split[1]."%";
											$length=strlen($val);
											for($i=2; $i<=($length/4)-1;$i++){
											$hasil[$i]=$split[$i]."\n"; }
											//echo $val;
											}?>
											<div class="form-group">
											<div class="row">
											<div class="col-lg-4">
													<label>RMSE</label>
													<input class="form-control" value="<?php echo @$rmse;?>">
													<label>Akurasi Estimasi</label>
													<input class="form-control" value="<?php echo @$accuracy;?>"> </div></div>
													<div class="row">
													<div class="col-lg-12">
													<label>Hasil Estimasi</label>
													<textarea class="form-control" rows="17"><?php if ( isset( $_POST['submit'] ) ) 
											        { 
													 for($i=2; $i<$length/4;$i++){	
													echo "Data ".($i-1).": ".$hasil[$i];}}?>
													</textarea></div></div>
											</div>
									  
											</form>
											
										</div>
										<!-- /.col-lg-6 (nested) -->
									</div>
									<!-- /.row (nested) -->
								</div>
								<!-- /.panel-body -->
							</div>
							<!-- /.panel -->
						</div>
						<!-- /.col-lg-1 -->
						
						 </form>
					</div>
					<!-- /.row -->
					
					<!-- Charts -->
					
					
				<!-- /#page-wrapper -->

			</div>
			<!-- /#wrapper -->

			<!-- jQuery -->
			<script src="../bower_components/jquery/dist/jquery.min.js"></script>
		    <script src="../bower_components/morrisjs/morris.min.js></script>
			
		    <script src="../bower_components/raphael/raphael-min.js"></script>
			 <script src="../bower_components/raphael/raphael.js"></script>


			<!-- Bootstrap Core JavaScript -->
			<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

			<!-- Metis Menu Plugin JavaScript -->
			<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

			<!-- Custom Theme JavaScript -->
			<script src="../dist/js/sb-admin-2.js"></script>
			
			
			<!-- CSS -->
			<link rel="stylesheet" src="../bower_components/morrisjs/morris.css">
			
			<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.5.1.css">


			<script src="http://cdn.oesmith.co.uk/morris-0.5.1.min.js"></script>
			
			
			<!-- Bottom Navigation -->
				<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-brand">©2015 Whina Ayu Lestari | Computer Science | Institut Pertanian Bogor | SB Admin 2 Theme</a>
					</div>
				</nav>
				
			<!-- Script for Morris Line -->
				<script>
				var rmse= 20;
					new Morris.Line({
					// ID of the element in which to draw the chart.
					element: 'divname',
					// Chart data records -- each entry in this array corresponds to a point on the chart.
					data: [
						{ Data: '1', value: rmse},
						{ Data: '2', value: 10 },
						{ Data: '3', value: 5 },
						{ Data: '4', value: 5 },
						{ Data: '5', value: 20 }
						],
						
					// The name of the data record attribute that contains x-values.
					xkey: 'Data',
					// A list of names of data record attributes that contain y-values.
				    ykeys: ['value'],
					// Labels for the ykeys -- will be displayed when you hover over the chart.
					labels: ['Value']
								});
								
				</script>
				
	
		</body>

		</html>
