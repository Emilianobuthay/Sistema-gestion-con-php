<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>



<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Gestión del Bovino</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>

 
 <div class="w3-container" style="padding-top:22px">
	 <div class="w3-row">
	 	<h2>Lista de Venta</h2>
	 	<div class="col-md-12">
	 		<a title="Check to delete from list" data-toggle="modal" data-target="#_remove" id="delete"  class="btn btn-danger"><i class="fa fa-trash"></i>
			</a>
	 		<form method="post" action="remove_quarantine.php">
	 		<table class="table table-hover" id="table">
	 			<thead>
	 				<tr>
	 			<th> </th>
<th> No Bovino </th>
<th> Fecha de Venta </th>
<th> Edad </th>
<th> Peso Entrada </th>
<th> Peso Final </th>
<th> Raza </th>
<th> Razón </th>
<th> Precio Venta </th>
	 				</tr>
	 			</thead>
	 			<tbody>
	 				<?php

	 				$get = $db->query("SELECT * FROM quarantine");
	 				$res = $get->fetchAll(PDO::FETCH_OBJ);
	 				foreach($res as $n){ ?>
                         <tr>
                         	<td>
                         		<input type="checkbox" name="selector[]" value="<?php echo $n->id ?>">
                         	</td>
                         	<td> <?php echo $n->pig_no; ?> </td>
                         	<td>  <?php echo $n->date_q; ?> </td>
							 <td> <?php echo $n->edad; ?> </td>
							 <td> <?php echo $n->weight; ?> </td>
							 <td> <?php echo $n->peso3; ?> </td>
                         	<td> <?php echo $n->breed; ?> </td>
                         	<td> <?php echo $n->reason; ?> </td>
							 <td> <?php echo $n->preciovent; ?> </td>
                         </tr> 
	 				<?php }

	 				?>
	 			</tbody>
	 		</table>

	 		<?php include('inc/modal-delete.php'); ?>
	 	</form>
	 	</div>
	 	 </div>
</div>

</div>

<?php include 'theme/foot.php'; ?>