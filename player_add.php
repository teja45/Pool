<?php 
include "module/header.php";
include "module/message.php";
include "config/connect.php"; 
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
            <h1>Create new player</h1>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-6">
	<form id="form_input" method="POST">	

<?php  
if(isset($_POST['create']))
{
    try {    
    	//insert into database
    	$stmt = $db->prepare('INSERT INTO players (name, email, contact) VALUES (:name, :email, :contact)') ;
    	$stmt->execute(array(
    		':name' => $_POST['name'],
    		':email' => $_POST['email'],
    		':contact' => $_POST['contact']
    	));
    	printMessage('create.success');
    
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}
?>

	<div class="form-group">
  		<label class="control-label" for="name">Full Name</label>
  		<input type="text" class="form-control" name="name" id="name" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="email">Email </label>
  		<input type="email" class="form-control" name="email" id="email" required>
	</div>

	<div class="form-group">
  		<label class="control-label" for="contact">Contact Number</label>
  		<input type="text" class="form-control" name="contact" id="contact">
	</div>

	<div class="form-group">
	<input type="submit" value="Create" name="create" class="btn btn-primary">
	<input type="reset" value="Reset" class="btn btn-danger">
	</div>

	</form>
	</div>
</div>

</div>
<?php include "module/footer.php"; ?>
</body>
</html>