<?php

  session_start();

  include("sqlConnect.php");

  // Retrieve students' information from database.
  // Order alphabetically by last name.
  $sql = $conn->prepare("
    SELECT
      *
    FROM
      students
    WHERE
      ClassID=?
    ORDER BY
      LName
  ");
  $sql->bind_param("i", $_SESSION['classID']);
  $sql->execute();
  $results = $sql->get_result();

  $conn->close();

  $studentsRows = '';
  $studentsBtns  = '';

  // "No students found." message for "Manage Students" table.
  $studentsRows .= '
    <tr
      class="none"
      style="display:'.($results->num_rows == 0 ? 'table-row' : 'none').'"
    >
      <td colspan="3">
        No students found.
      </td>
    </tr>
  ';

  // Cumulative option for "Levels Progression" selection buttons.
  $studentsBtns .= '
    <button onclick="getStudentProgress(0, \'Cumulative\')">Cumulative</button>
  ';

  // Format retrieved data into table rows and buttons.
  while ($row = $results->fetch_assoc())
  {
    // Format birthday, either "MMM. DD, YYYY" or "Set on Login" if null.
    if (isset($row['Birthday']))
      $birthday = date_format( date_create($row['Birthday']) , 'M. j, Y' );
    else
      $birthday = '<span>Set on Login</span>';
    
    // Format data as row for "Manage Students" table.
    $studentsRows .= '
      <tr>
        <td>'.$row['LName'].', '.$row['FName'].'</td>
        <td>'.$birthday.'</td>
        <td>
          <button
            class="orangeBtn"
            onclick="displayEditStudent(
              '.$row['ID'].',
              &apos;'.$row['FName'].'&apos;,
              &apos;'.$row['LName'].'&apos;,
              &apos;'.$row['Birthday'].'&apos;
            )"
          >
            Edit <i class="fas fa-user-edit"></i>
          </button>
          <button
            class="orangeBtn"
            onclick="displayDelStudent(
              '.$row['ID'].',
              &apos;'.$row['FName'].' '.$row['LName'].'&apos;
            )"
          >
            Delete <i class="fas fa-trash-alt"></i>
          </button>
        </td>
      </tr>
    ';

    // Format data as button for "Levels Progression" student selection.
    $studentsBtns .= '
      <button onclick="getStudentProgress('.$row['ID'].', \''.$row['FName'].' '.$row['LName'][0].'.\')">'.$row['LName'].', '.$row['FName'].'</button>
    ';
  }

  echo json_encode(array(
    "rows"=>$studentsRows,
    "btns"=>$studentsBtns
  ));

?>