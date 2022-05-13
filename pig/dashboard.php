<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Inicio Sistema Bovino Buthay</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>
 <div class="w3-container" style="padding-top:22px">
 <div class="w3-row">
 	<h2>Bovino recientes</h2>
 <div class="table-responsive">
 	<table class="table table-hover" id="table">
 		<thead>
 			<tr>
 				<th>S/N</th>
 				<th>No. Bovino</th>
				 <th>Precio</th>
				 <th>Edad</th>
 				<th>Raza</th>
 				<th>Peso Entrada</th>
				 <th>Pesaje Rutinario</th>
				 <th>Peso Final</th>
				 <th>Estado</th>
 				<th>Género</th>
 				<th>Llegada</th>
 				<th>Desc.</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php
               $qpi = $db->query("SELECT * FROM pigs ORDER BY id");
               $result = $qpi->fetchAll(PDO::FETCH_OBJ);
               $c = $qpi->rowCount();

               foreach ($result as $j) {
               	 $pigname = $j->pigno;
					$precio = $j->precio;
					$edad = $j->edad;
               	 $b_id = $j->breed_id;
               	 $weight = $j->weight;
					$peso2 = $j->peso2;
					$peso3 = $j->peso3;
			     $health = $j->health_status;
               	 $gender = $j->gender;
               	 $remark = $j->remark;
               	 $arr = $j->arrived;

               	 $k = $db->query("SELECT * FROM breed WHERE id = '$b_id' ");
               	 $ks = $k->fetchAll(PDO::FETCH_OBJ);
               	 foreach ($ks as $r) {
               	 	$bname = $r->name;
               	 ?>
                  <tr>
                  	<td>
                  		<?php for ($i=1; $i <= $c ; $i++) { 
                  			echo $i;
                  		} ?>
                  	</td>
                  	<td><?php echo $pigname; ?></td>
					  <td><?php echo $precio; ?></td>
					  <td><?php echo $edad; ?></td>
                  	<td><?php echo $bname; ?></td>
                  	<td><?php echo $weight; ?></td>
					  <td><?php echo $peso2; ?></td>
					  <td><?php echo $peso3; ?></td>
					<td><?php echo $health; ?></td>
                  	<td><?php echo $gender; ?></td>
                  	<td><?php echo $arr; ?></td>
                  	<td><?php echo $remark; ?></td>
                  </tr>
               	 <?php
                 }
              }
 			?>
 		</tbody>
 	</table>
 </div>
 </div>
</div>


</div>


<?php include 'theme/foot.php'; ?>