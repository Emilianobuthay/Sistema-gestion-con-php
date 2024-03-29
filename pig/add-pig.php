<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Manejo de ganadero > Add</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>

 
 <div class="w3-container" style="padding-top:22px">
 <div class="w3-row">
 	<h2>Add New Bovino</h2>

 	<div class="col-md-6">
      
      <?php
      if(isset($_POST['submit']))
      {
      	if(isset($_FILES['pigphoto']['tmp_name'])){

	      	$n_pigno = $_POST['pigno'];
	      	$n_weight = $_POST['weight'];
	      	$n_arrived = $_POST['arrived'];
	      	$n_breed = $_POST['breed'];
	      	$n_remark = $_POST['remark'];
	      	$n_status = $_POST['status'];
	      	$n_gender = $_POST['gender'];
			  $n_precio = $_POST['precio'];
			  $n_edad = $_POST['edad'];
			  

		

      	
      		$res1_name = basename($_FILES['pigphoto']['name']);
			$tmp_name = $_FILES['pigphoto']['tmp_name'];
			$type = $_FILES['pigphoto']['type'];
			$max_size = 2097152;
			$size = $_FILES['pigphoto']['size'];

			if (isset($res1_name)) {
				$location = 'uploadfolder/';
				$move = move_uploaded_file($tmp_name, $location.$res1_name);
				$path1 = $location.$res1_name;

			
				if (!$move) {
					$fileerror = $_FILES['pigphoto']['error'];
					$message = $upload_errors[$fileerror];
					
				}
			}
		}
      	

   

    

      	$insert = $db->query("INSERT INTO pigs(pigno,weight,arrived,breed_id,remark,health_status,img,gender,precio,edad) VALUES('$n_pigno','$n_weight','$n_arrived','$n_breed','$n_remark','$n_status','$path1','$n_gender','$n_precio','$n_edad' ");

      	if($insert){?>
      	<div class="alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>bovino creado con éxito <i class="fa fa-check"></i></strong>
        </div>
       <?php
      	}else{ ?>
          <div class="alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <strong>Error al crear datos de bovino. Por favor, intente de nuevo <i class="fa fa-times"></i></strong>
        </div>
      	<?php
      }
      
      }

     ?>




 		<form method="post" autocomplete="off" enctype="multipart/form-data">
 			<div class="form-group">
	 			<label class="control-label">Bovino No.</label>
	 			<input type="text" name="pigno" class="form-control" placeHolder="Caravana" required>
	 		</div>

	 		<div class="form-group">
	 			<label class="control-label">Peso Entrada</label>
	 			<input type="text" name="weight" class="form-control" required>
	 		</div>

	 		<div class="form-group date" data-provide="datepicker">
	 			<label class="control-label">Arrival date</label>
	 			<input type="text" name="arrived" class="form-control" required>
	 		</div>

	 		<div class="form-group">
	 			<label class="control-label">Gender</label>
	 			<select name="gender" class="form-control" required>
	 				<option value="male">Male</option>
	 				<option value="female">Female</option>
	 			</select>
	 		</div>

	 		<div class="form-group">
	 			<label class="control-label">Status</label>
	 			<select name="status" class="form-control" required>
	 				<option value="active">Activo</option>
	 				<option value="Vendido">Vendido</option>
	 				<option value="Proceso De Cobro">Proceso De Cobro</option>
	 				<option value="Proceso De Pago">Proceso De Pago</option>
	 			</select>
	 		</div>

	 		<div class="form-group">
	 			<label class="control-label">Breed</label>
	 			<select name="breed" class="form-control" required>
	 				<option value=""></option>
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
	 			<label class="control-label">Description</label>
	 			<textarea class="form-control" name="remark" required></textarea>
	 		</div>
			 <div class="form-group">
	 			<label class="control-label">Precio</label>
	 			<input type="number" name="precio" class="form-control" placeHolder="Precio" >
	 		</div>
			 <div class="form-group">
	 			<label class="control-label">Edad</label>
	 			<input type="number" name="edad" class="form-control" placeHolder="Edad" required>
	 		</div>

	 		<div class="form-group">
	 			<label class="control-label">Bovino photo</label>
	 			<input type="file" name="pigphoto" class="form-control" >
	 		</div>

	 		<button name="submit" type="submit" name="submit" class="btn btn-sn btn-default">Update</button>
 		</form>
 	</div>
 </div>
</div>

</div>
<?php include 'theme/foot.php'; ?>