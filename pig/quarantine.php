<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<?php 
 if(!$_GET['id'] OR empty($_GET['id']) OR $_GET['id'] == '')
 {
 	header('location: manage-pig.php');

 }else{
 	
 	$pigno = $bname = $b_id = $preciovent = $edad = $weight = $peso3 = $health = "";
 	$id = (int)$_GET['id'];
 	$query = $db->query("SELECT * FROM pigs WHERE id = '$id' ");
 	$fetchObj = $query->fetchAll(PDO::FETCH_OBJ);

 	foreach($fetchObj as $obj){
       $pigno = $obj->pigno;
	   $b_id = $obj->breed_id;
	   $health = $obj->health_status;
	   $preciovent = $obj->preciovent;
	   $edad = $obj->edad;
	   $weight = $obj->weight;
	   $peso3 = $obj->peso3;

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
    <h5><b><i class="fa fa-dashboard"></i>Gestión del Bovino</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>

 
 <div class="w3-container" style="padding-top:22px">
	 <div class="w3-row">
	 	<h2>Lista de cuarentena</h2>
	 	<div class="col-md-6">
	 		<table class="table table-hover" id="table">
	 			<thead>
	 				<tr>
	 					<th>No Bovino</th>
	 				<th> Fecha de venta </th>
					 <th> Edad </th>
					 <th> Peso Entrada </th>
					 <th> Peso Final </th>
	 				<th> Raza </th>
	 				<th> Razón </th>
					 <th> Precio de venta </th>
	 				</tr>
	 			</thead>
	 			<tbody>
	 				<?php

	 				$get = $db->query("SELECT * FROM quarantine");
	 				$res = $get->fetchAll(PDO::FETCH_OBJ);
	 				foreach($res as $n){ ?>
                         <tr>
                         	<td> <?php echo $n->pig_no; ?> </td>
                         	<td>  <?php echo $n->date_q; ?> </td>
							 <td>  <?php echo $n->edad; ?> </td>
							 <td>  <?php echo $n->weight; ?> </td>
							 <td>  <?php echo $n->peso3; ?> </td>
                         	<td><?php echo $n->breed; ?> </td>
                         	<td> <?php echo $n->reason; ?> </td>
							 <td><?php echo $n->preciovent; ?> </td>
                         </tr> 
	 				<?php }

	 				?>
	 			</tbody>
	 		</table>
	 	</div>

	 	<div class="col-md-6">

     <?php
      if(isset($_POST['submit']))
      {
      	$n_pigno = $_POST['pigno'];
     
      	$n_breed = $_POST['breed'];
      	$n_remark = $_POST['reason'];
		$n_preciovent = $_POST['preciovent'];
		$n_edad = $_POST['edad'];
		$n_edad = $_POST['weight'];
		$n_edad = $_POST['peso3'];
      	$now = date('Y-m-d');
  

      	$n_id = $_GET['id'];

      	$insert_query = $db->query("INSERT INTO quarantine(pig_no,breed,reason,date_q,preciovent,edad,weight,peso3)VALUES('$n_pigno','$n_breed','$n_remark','$now','$n_preciovent','$n_edad','$n_weight','$n_peso3') ");

      	if($insert_query){?>
      	<div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Bovino exitosamente puesto en venta<i class="fa fa-check"></i></strong>
        </div>
       <?php
         header('refresh: 5');
      	}else{ ?>
          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Error al insertar datos de Bovino Inténtalo de nuevo<i class="fa fa-times"></i></strong>
        </div>
      	<?php
      }

      }

     ?>


	 		<form role='form' method="post">
	 			<div class="form-group">
	 				<label class="control-label">No Bovino</label>
	 				<input type="text" name="pigno" readonly="on" class="form-control" value="<?php echo $pigno; ?>">
	 			</div>

	 			<div class="form-group">
	 				<label class="control-label">Raza</label>
	 				<input type="text" name="breed" readonly="on" class="form-control" value="<?php echo $bname; ?>">
	 			</div>
				 <div class="form-group">
	 				<label class="control-label">Edad</label>
	 				<input type="number" name="edad" placeholder="Edad" class="form-control" value="<?php echo $edad; ?>">
	 			</div>
				 <div class="form-group">
	 				<label class="control-label">Peso Entrada</label>
	 				<input type="text" name="weight" placeholder="Peso entrada" class="form-control" value="<?php echo $weight; ?>">
	 			</div>
				 <div class="form-group">
	 				<label class="control-label">Peso Final</label>
	 				<input type="number" name="peso3" placeholder="Peso Final" class="form-control" value="<?php echo $peso3; ?>">
	 			</div>
				 <div class="form-group">
	 				<label class="control-label">Precio</label>
	 				<input type="number" name="preciovent" placeholder="Precio Venta" class="form-control" value="<?php echo $preciovent; ?>">
	 			</div>

	 			<div class="form-group">
	 				<label class="control-label">Razón</label>
	 				<textarea name="reason" placeholder="Enter reason for quarantine" class="form-control" value=""></textarea>
	 			</div>

	 			<button name="submit" type="submit" class="btn btn-sm  btn-default">Agregar a la lista</button>
	 		</form>
	 	</div>
	 </div>
</div>

</div>

<?php include 'theme/foot.php'; ?>