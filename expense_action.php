<?php

  include "connection.php";

  session_start();

  $output = '';

  if(isset($_POST["action"])){

    // Fetch expense
    if($_POST["action"] == "expense_fetch"){

      // Read value
      $draw = $_POST['draw'];
      $row = $_POST['start'];
      $rowperpage = $_POST['length'];
      $columnIndex = $_POST['order'][0]['column'];
      $columnName = $_POST['columns'][$columnIndex]['data'];
      $columnSortOrder = $_POST['order'][0]['dir'];
      $searchValue = $_POST['search']['value'];

      // Search
      $searchQuery = " ";
      if($searchValue != ''){
        $searchQuery = " and (id LIKE '%".$searchValue."%' OR
              description LIKE '%".$searchValue."%' OR
              amount LIKE '%".$searchValue."%' OR
              date LIKE '%".$searchValue."%' ) ";
      }

      // Total number of records without filtering
      $sel = mysqli_query($conn,"SELECT count(*) AS allcount FROM tbl_expense");
      $records = mysqli_fetch_assoc($sel);
      $totalRecords = $records['allcount'];

      // Total number of records with filtering
      $sel = mysqli_query($conn,"SELECT count(*) AS allcount FROM tbl_expense WHERE 1 ".$searchQuery);
      $records = mysqli_fetch_assoc($sel);
      $totalRecordwithFilter = $records['allcount'];

      // Fetch records
      $empQuery = "SELECT * FROM tbl_expense WHERE 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT ".$row.",".$rowperpage;
      $empRecords = mysqli_query($conn, $empQuery);
      $data = array();


      $total_amount = 0;

      while ($row = mysqli_fetch_assoc($empRecords)) {

        $data[] = array(
          "id"              =>$row['id'],
          "description"     =>$row['description'],
          "amount"          =>$row['amount'],
          "date"            =>$row['date'],
          "action"       =>
          '<button type="button" class="btn btn-primary edit_expense" data-toggle="modal" data-target="#editModal" id="'.$row['id'].'">Update</button>
          <button type="button" class="btn btn-danger delete_expense" id="'.$row['id'].'">Delete</button>
          '
        );

        $total_amount = $total_amount + floatval($row["amount"]);

      }

      $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data,
        "total" => number_format($total_amount, 2)
      );

      echo json_encode($response);

    }

    // Add Expense
    if($_POST["action"] == "Add"){

      $description = $_POST['description'];
      $amount = $_POST['amount'];
      $date = $_POST['date'];

      $sql = "INSERT INTO tbl_expense (description, amount, date) VALUES('$description', '$amount', '$date')";

      if(mysqli_query($conn, $sql)){
        $output = array(
          'status'        => 'success',
          'alert'         => 'New expense has been successfully added.'
        );
      }else{
        $output = array(
          'status'        => 'error'
        );
      }

      echo json_encode($output);

    }

    // Update Expense
    if($_POST["action"] == "Edit"){

      $expense_id = $_POST['expense_id'];
      $description = $_POST['description'];
      $amount = $_POST['amount'];
      $date = $_POST['date'];

      $sql = "UPDATE tbl_expense SET description = '$description',
                                  amount = '$amount',
                                  date = '$date'
                                  WHERE id = '$expense_id'";

      $result = mysqli_query($conn, $sql);

      $output = array(
        'status'        => 'success',
        'alert'         => 'Expense has been successfully updated.'
      );

        echo json_encode($output);
    }

    // Single edit fetch
    if($_POST["action"] == "edit_fetch"){

      $expense_id = $_POST['expense_id'];

      $sql = "SELECT id, description, amount, date FROM tbl_expense WHERE id = '$expense_id'";

      $result = mysqli_query($conn, $sql);

      $row = mysqli_fetch_row($result);

      $output = array(
        "id"		            =>	$row[0],
        "description"		    =>	$row[1],
        "amount"		        => 	$row[2],
        "date"	            =>	$row[3]
      );

      echo json_encode($output);

    }

    // Delete Expense
    if($_POST["action"] == "delete"){

      $expense_id = $_POST['expense_id'];

      $sql = "DELETE FROM tbl_expense WHERE id='$expense_id'";

      $result = mysqli_query($conn, $sql);

      $output = array(
          'status'        => 'success'
      );

      echo json_encode($output);

    }

  }

?>