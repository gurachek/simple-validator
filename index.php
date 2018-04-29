<?php

session_start();

require_once 'validator/Validator.php';
require_once 'validator/ValidatorErrors.php';

use validator\Validator;

$errors = null;

if (@$_POST['submit'] !== null) {
	
	$validator = new Validator();

	$name = stripcslashes($_POST['name']);
	$age = stripcslashes($_POST['age']);

	$_SESSION['name'] = $name;
	$_SESSION['age'] = $age;

	$validator->validate($name, ['field' => 'name', 'method' => 'required']);
	$validator->validate($age, ['field' => 'age', 'method' => 'integer']);

	if (!$validator->isValidationErrors()) {
		
		echo '<b>Success!</b> <br>';
	
	} else {
		$errors = $validator->getErrors();
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Validator</title>
</head>
<body>
	<div style="">
	</div>
	<form action="" method="POST">
		<input type="text" name="name" placeholder="Enter your name.." value="<?= @$_SESSION['name'] ?>" />
		<br>
		<?= @$errors['name'] ?>
		<br>
		<input type="text" name="age" placeholder="Enter your age.." value="<?= @$_SESSION['age'] ?>" />
		<br>
		<?= @$errors['age'] ?>
		<br>
		<input type="submit" name="submit" value="Submit" />
	</form>
</body>
</html>