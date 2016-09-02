<?php
include "config/connect.php";
$stmt = $db->prepare('DELETE FROM t_member WHERE ID = :id');
$stmt->execute(array(':id' => $_GET['id']));
echo "<script language=javascript>parent.location.href='index.php';</script>";
?>