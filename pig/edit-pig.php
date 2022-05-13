<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<?php 
 if(!$_GET['id'] OR empty($_GET['id']) OR $_GET['id'] == '')
 {
 	header('location: manage-pig.php');

 }else{
 	
 	$pigno = $weight = $peso2 = $peso3 = $gender = $remark = $precio = $edad = $arr = $bname = $b_id = $health = $img = "";
 	$id = (int)$_GET['id'];
 	$query = $db->query("SELECT * FROM pigs WHERE id = '$id' ");
 	$fetchObj = $query->fetchAll(PDO::FETCH_OBJ);

 	foreach($fetchObj as $obj){
       $pigno = $obj->pigno;
       $weight = $obj->weight;
	   $peso2 = $obj->peso2;
	   $peso3 = $obj->peso3;
	   $gender = $obj->gender;
	   $remark = $obj->remark;
	   $precio = $obj->precio;
	   $edad = $obj->edad;
	   $arr = $obj->arrived;
	   $b_id = $obj->breed_id;
	   $health = $obj->health_status;
	   $img = $obj->img;

	     $k = $db->query("SELECT * FROM breed WHERE id = '$b_id' ");
       	 $ks = $k->fetchAll(PDO::FETCH_OBJ);
       	 foreach ($ks as $r) {
       	 	$bname = $r->name;
       	 }
 	}
 }

?>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i>Mi tablero</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>

 
<div class="w3-container" style="padding-top:22px">
 <div class="w3-row">
  
 	<div class="col-md-6">

     <?php
      if(isset($_POST['submit']))
      {
      	$n_pigno = $_POST['pigno'];
      	$n_weight = $_POST['weight'];
		  $n_peso2 = $_POST['peso2'];
		  $n_peso3 = $_POST['peso3'];
      	$n_arrived = $_POST['arrived'];
      	$n_breed = $_POST['breed'];
      	$n_remark = $_POST['remark'];
      	$n_status = $_POST['status'];
		  $n_precio = $_POST['precio'];
      	$n_edad = $_POST['edad'];

      	$n_id = $_GET['id'];

      	$update_query = $db->query("UPDATE pigs SET pigno = '$n_pigno',weight = '$n_weight',arrived = '$n_arrived', breed_id = '$n_breed', remark = '$n_remark', health_status = '$n_status', precio = '$n_precio', edad = '$n_edad', peso2 = '$n_peso2', peso3 = '$n_peso3' WHERE id = '$n_id' ");

      	if($update_query){?>
      	<div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Los detalles del Bovino se actualizan correctamente <i class="fa fa-check"></i></strong>
        </div>
       <?php
      	}else{ ?>
          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Error al actualizar los datos del Bovino Inténtalo de nuevo <i class="fa fa-times"></i></strong>
        </div>
      	<?php
      }

      }

     ?>




 		<h2>Edit Bovino</h2>
	 	<form method="post">
	 		<div class="form-group">
	 			<label class="control-label">No.Bovino</label>
	 			<input type="text" name="pigno" class="form-control" value="<?php echo $pigno; ?>">
	 		</div>

	 		<div class="form-group">
	 			<label class="control-label">Peso Entrada</label>
	 			<input type="text" name="weight" class="form-control" value="<?php echo $weight; ?>">
	 		</div>
			 <div class="form-group">
	 			<label class="control-label">Peso Rutinario</label>
	 			<input type="text" name="peso2" class="form-control" value="<?php echo $peso2; ?>">
	 		</div>
			 <div class="form-group">
	 			<label class="control-label">Peso Final</label>
	 			<input type="text" name="peso3" class="form-control" value="<?php echo $peso3; ?>">
	 		</div>

	 		<div class="form-group date" data-provide="datepicker">
	 			<label class="control-label">Fecha de llegada</label>
	 			<input type="text" name="arrived" class="form-control" value="<?php echo $arr; ?>">
	 		</div>

	 		<div class="form-group">
	 			<label class="control-label">Estado</label>
				 <input type="text" readonly="on" class="form-control" value="<?php echo $health; ?>">
				 <label class="control-label">Cambiar Estado/Mantener Estado En</label>
				 <select name="status" class="form-control" required>
	 				<option value="active">Activo</option>
	 				<option value="Vendido">Vendido</option>
	 				<option value="Proceso De Cobro">Proceso De Cobro</option>
	 				<option value="Proceso De Pago">Proceso De Pago</option>
	 			</select>
	 			
	 		</div>

	 		<div class="form-group">
	 			<label class="control-label">Raza</label>
	 			<select name="breed" class="form-control">
	 				<option value="<?php echo $b_id; ?>" selected><?php echo $bname; ?></option>
	 				<?php
	                   $getBreed = $db->query("SELECT * FROM breed");
	                   $res = $getBreed->fetchAll(PDO::FETCH_OBJ);
	                   foreach($res as $r){ ?>
	                     <option value="<?php echo $r->id; ?>"><?php echo $r->name; ?></option>   
	                   <?php
	                   }
	 				?>
	 			</select>
	 		</div>

	 		<div class="form-group">
	 			<label class="control-label">Descripcion</label>
	 			<textarea class="form-control" name="remark"><?php echo $remark; ?></textarea>
	 		</div>
			 <div class="form-group">
	 			<label class="control-label">Precio</label>
	 			<input type="number" name="precio" class="form-control" value="<?php echo $precio; ?>">
	 		</div>
			 <div class="form-group">
	 			<label class="control-label">Edad</label>
	 			<input type="number" name="edad" class="form-control" value="<?php echo $edad; ?>">
	 		</div>

	 		<button name="submit" type="submit" name="submit" class="btn btn-sn btn-default">Actualizar</button>
	 	</form>
 </div>
 <div class="col-md-4 col-md-offset-2">
 	<h2>Foto de Bovino</h2>
 	<img src="<?php echo $img; ?>" width="130" height="120" class="thumbnail img img-responsive">
 	<p class="text-justify text-center">
 		<?php echo $remark; ?>
 	</p>
 	<a class="btn btn-danger btn-md" onclick="return confirm('Continue delete Bovino ?')" href="delete.php?id=<?php echo $id ?>"><i class="fa fa-trash"></i> Delete Bovino</a>
 </div>
</div>
</div>
</div>


<?php include 'theme/foot.php'; ?>