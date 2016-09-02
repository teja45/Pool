<?php 
include "module/header.php";
include "module/message.php";
include "config/connect.php"; 
function match_played($id) {
  global $db;
  $stmt = $db->prepare('SELECT count(*) as count from game where p1 = :p1 OR p2 = :p2');
  $stmt->execute(array(':p1' => $id, ':p2' => $id));
  $count =  $stmt->fetch();
  return $count['count'];
}
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
            <h1>Leader Boards</h1>
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
					<th>Match Played</th>
					<th>Winning</th>
					
				</tr>
			</thead>
			<tbody id="data">
			<?php
			try {

			$stmt = $db->query('SELECT p.name, p.email, p.contact, p.id, count(g.winner) as count from game g right join players p on p.id = g.winner group by winner order by count DESC');
			$no = 1;
			while($row = $stmt->fetch()){
				
				echo '<tr>';
				echo '<td align="center">' . $no . '</td>';
				echo '<td>' . $row['name'].'</td>';
				echo '<td>'. $row['email'].'</td>';
				echo '<td>'. $row['contact'].'</td>';
				echo '<td>'. match_played($row['id']) .'</td>';
				echo '<td>'. $row['count'].'</td>';
								
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
