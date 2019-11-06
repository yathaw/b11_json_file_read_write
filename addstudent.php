<?php 
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		$name = $_POST['name'];
    	$email = $_POST['email'];
    	$gender = $_POST['gender'];
    	$address = $_POST['address'];
    	$profile = $_FILES['profile'];

    	// upload file
    	$basepath = 'photo/';
    	$fullpath = $basepath.$profile['name'];
    	move_uploaded_file($profile['tmp_name'], $fullpath);

    	// Create array
    	$student = array(
    		"name"	=>	$name,
    		"email"	=>  $email,
    		"gender" => $gender,
    		"address" => $address,
    		"profile" => $fullpath
    	);

    	// get jsonData from json file
    	$jsonData = file_get_contents('studentlist.json');

    	if (!$jsonData) 
    	{
    		$jsonData= '[]';
    	}

    	// convert into array from json
    	$data_arr = json_decode($jsonData);

    	array_push($data_arr, $student);

    	$jsonData = json_encode($data_arr, JSON_PRETTY_PRINT);

    	file_put_contents('studentlist.json', $jsonData);

    	header("location:index.php");







	}
?>