<?php 
include "module/header.php";
include "module/message.php";
include "config/connect.php"; 
$stmt = $db->query('SELECT id, name FROM players ORDER BY name ASC');
$options = '';
while($row = $stmt->fetch()){
  $options .= '<option value="'. $row['id'] .'">'. $row['name'] .'</option>';
}

?>
<!doctype html>
<html lang="en">
</head>
<body>

<div class="container">
<?php include "module/nav.php"; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>Game Management</h1>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['submit']))
{
    if($_POST['player1'] != $_POST['player2'] && ($_POST['winner'] == $_POST['player1'] || $_POST['winner'] == $_POST['player2'])) {
	  try {  
    	$stmt = $db->prepare('INSERT INTO game (p1, p2, winner) VALUES (:p1, :p2, :winner)') ;
    	$stmt->execute(array(
    		':p1' => $_POST['player1'],
    		':p2' => $_POST['player2'],
    		':winner' => $_POST['winner']
    	));
    	printMessage('create.success');
    
      } catch(PDOException $e) {
          echo $e->getMessage();
      }
	  
	}else {
	  printMessage('create.error');
	}
	
}
?>

	<div class="form-group">
  		<label class="control-label" for="nama">Choose first player</label>
		<select class="selectpicker" name="player1"><?php print $options;?></select>
	</div>
	<div class="form-group">
  		<label class="control-label" for="nama">Choose second Player </label>
		<select class="selectpicker" name="player2"><?php print $options;?></select>
	</div>
	<div class="form-group">
  		<label class="control-label" for="nama">Choose Winner </label>
		<select class="selectpicker" name="winner"><?php print $options;?></select>
	</div>

	<div class="form-group">
	<input type="submit" value="Submit" name="submit" class="btn btn-primary">
	</div>

	</form>
	</div>
</div>

</div>
<?php include "module/footer.php"; ?>
</body>
</html>