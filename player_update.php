<?php 
include "module/header.php";
include "module/message.php";
include "config/connect.php"; 

$stmt = $db->prepare('SELECT id, name, email, contact FROM players WHERE id = :id');
$stmt->execute(array(':id' => $_GET['id']));
$data = $stmt->fetch();
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
            <h1>Player Update</h1>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['update']))
{
	
	try {    
    	//insert into database
    	$stmt = $db->prepare('UPDATE players SET name = :name, email = :email, contact = :contact WHERE id = :id') ;
    	$stmt->execute(array(
    		':name' => $_POST['name'],
    		':email' => $_POST['email'],
    		':contact' => $_POST['contact'],
    		':id' => $_GET['id']
    	));
    	printMessage('update.success');
    
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

//Re-Load Data from DB
$stmt = $db->prepare('SELECT id, name, email, contact FROM players WHERE id = :id');
$stmt->execute(array(':id' => $_GET['id']));
$data = $stmt->fetch();
}
?>

	<div class="form-group">
  		<label class="control-label" for="name">Full Name</label>
  		<input type="text" class="form-control" name="name" id="name" value="<?php echo $data['name']; ?>" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="email">Email </label>
  		<input type="email" class="form-control" name="email" id="email" value="<?php echo $data['email']; ?>" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="hp">Contact Number</label>
  		<input type="text" class="form-control" name="contact" id="contact" value="<?php echo $data['contact']; ?>">
	</div>

	<div class="form-group">
	<input type="submit" value="Update" name="update" class="btn btn-primary">
	<a href="index.php" class="btn btn-danger">Back</a>
	</div>

	</form>
	</div>
</div>

</div>
<?php include "module/footer.php"; ?>
</body>
</html>