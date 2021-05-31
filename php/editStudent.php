<?php

  session_start();

  include('sqlConnect.php');

  // Retrieve entered student information.
  $id       = $_POST['id'];
  $fName    = $_POST['fName'];
  $lName    = $_POST['lName'];
  // Birthday may be empty if student has not yet logged in, or teacher wishes to reset it.
  $birthday = empty($_POST['birthday']) ? NULL : $_POST['birthday'];
  
  $classID = $_SESSION['classID'];

  // Verify student is in current class. 
  if (!include('verifyStudent.php'))
  {
    // Student is not in current class, throw error and stop edit process.
    $msg = "Student is not in this class.";
    echo json_encode(array(
      "success"=>false,
      "msg"=>$msg
    ));
    $conn->close();
    exit;
  }

  // Edit student information in database.
  $sql = $conn->prepare("
    UPDATE
      students
    SET
      FName=?, LName=?, Birthday=?
    WHERE
      ID=?
  ");
  $sql->bind_param("sssi", $fName, $lName, $birthday, $id);
  $sql->execute();

  $conn->close();

  // Student information has been successfully edited.
  echo json_encode(array(
    "success"=>true
  ));
  exit;

?>