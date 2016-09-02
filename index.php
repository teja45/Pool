<?php 
include "module/header.php";
include "module/message.php";
include "config/connect.php"; 

?>
<!DOCTYPE html>
<html lang="en">
</head>

<body>
<div class="container">
<?php include "module/nav.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Players List(Read, Update, Delete)</h1>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
	<p>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="5%"><center>NO</center></th>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>CONTACT</th>
					<th width="15%"><center>OPERATION</center></th>
				</tr>
			</thead>
			<tbody id="data">
			<?php
			try {

			$stmt = $db->query('SELECT id, name, email, contact FROM players ORDER BY ID DESC');
			$no = 1;
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td align="center">' . $no . '</td>';
				echo '<td>' . $row['name'].'</td>';
				echo '<td>'. $row['email'].'</td>';
				echo '<td>'. $row['contact'].'</td>';
				echo '<td align="center">
					<a href="player_update.php?id=' . $row['id'].'">Update</a>
					| 
					<a href="player_delete.php?id='. $row['id'].'" onclick ="if (!confirm(\'Apakah Anda yakin akan menghapus data ini?\')) return false;">Delete</a>
					</td>';
				echo '</tr>';				
				$no++;
			}

		} catch(PDOException $e) {
		    echo $e->getMessage();
		}
			
		?>	
			
			
			</tbody>
		</table>
	</p>	
	</div>
</div>	

</div>
<?php include "module/footer.php"; ?>
</body>
</html>
