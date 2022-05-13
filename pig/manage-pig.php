<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Gestión del Ganadero</b></h5>
  </header>
 
 <?php include 'inc/data.php'; ?>

 
 <div class="w3-container" style="padding-top:22px">
 <div class="w3-row">
 	<h2>Administrar Bovino</h2>
  <a href="add-pig.php" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i>Agregar nuevo Bovino</a><br><br>
 <div class="table-responsive">
 	<table class="table table-hover table-striped" id="table">
 		<thead>
 	
<tr>
 <th> S / N </th>
        <th> Foto </th>
 <th> No. Bovino</th>
 <th> Raza </th>
 <th> Peso Entrada</th>
 <th> Peso Rutinario </th>
 <th> Peso Final </th>
 <th> Estado </th>
 <th> Género </th>
 <th> Llegó </th>
 <th> Desc. </th>
 <th> Precio </th>
 <th> Edad </th>
        <th> </th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php
       $all_pig = $db->query("SELECT * FROM pigs ORDER BY id DESC");
       $fetch = $all_pig->fetchAll(PDO::FETCH_OBJ);
       foreach($fetch as $data){ 
          $get_breed = $db->query("SELECT * FROM breed WHERE id = '$data->breed_id'");
          $breed_result = $get_breed->fetchAll(PDO::FETCH_OBJ);
          foreach($breed_result as $breed){
        ?>
          <tr>
            <td><?php echo $data->id ?></td>
            <td>
              <img width="70" height="70" src="<?php echo $data->img; ?>" class="img img-responsive thumbnail">
            </td>
            <td><?php echo $data->pigno ?></td>
            <td><?php echo $breed->name ?></td>
            <td><?php echo $data->weight ?></td>
            <td><?php echo $data->peso2 ?></td>
            <td><?php echo $data->peso3 ?></td>
            <td><?php echo $data->health_status ?></td>
            <td><?php echo $data->gender ?></td>
            <td><?php echo $data->arrived ?></td>
            <td><?php echo wordwrap($data->remark,300,'<br>'); ?></td>
            <td><?php echo $data->precio ?></td>
            <td><?php echo $data->edad ?></td>
            <td>
               <div class="dropdown">
                  <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i> Opción
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="edit-pig.php?id=<?php echo $data->id ?>"><i class="fa fa-edit"></i> Editar</a></li>
                    <li><a onclick="return confirm('Continue delete Bovino ?')" href="delete.php?id=<?php echo $data->id ?>"><i class="fa fa-trash"></i> Borrar</a></li>
                    <li><a onclick="return confirm('Continue Venta Bovino ?')" href="quarantine.php?id=<?php echo $data->id; ?>"><i class="fa fa-paper-plane"></i> Bovino VENTA</a></li>
                  </ul>
                </div> 
            </td>
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