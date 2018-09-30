<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------

  include '/var/mySQL/myDB.php';
  
  $tableName = "campaigns";
  $dm = $_POST['dm'];
  $name = $_POST['name'];
  
  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  $mysqli = new mysqli('127.0.0.1', $user, $pass, $databaseName);
  $sqlq   = "SELECT * FROM campaigns WHERE campaign_name = '" . $name . "' AND campaign_dm = '" . $dm . "'";
  $result = $mysqli->query($sqlq);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //-------------------------------------------------------------------------- 
  $header = array('campaign_id',
                  'campaign_dm',
                  'campaign_name',
                  'campaign_creation',
                  'existed');
  $rows   = array();
  while ($r = $result->fetch_row()) {
    $rows[] = $r;
  }
  if ($rows[0] === NULL) {
    $rows = array('campaign_id'=>"null",
                  'campaign_dm'=>"null",
                  'campaign_name'=>"null",
                  'campaign_creation'=>"null",
                  'existed'=>0);
  }
  else {
    foreach ($rows as &$element) {
      $element = array($header[0]=>$element[0],
                       $header[1]=>$element[1],
                       $header[2]=>$element[2],
                       $header[3]=>$element[3],
                       $header[4]=>1);
    }
    $rows = $rows[0];
  }

  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($rows);
?>
