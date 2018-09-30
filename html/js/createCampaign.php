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
  $header = array('campaign_id',
                  'campaign_dm',
                  'campaign_name',
                  'campaign_creation',
                  'existed');
  $rows   = array();
  
  $sqlq   = "SELECT * FROM campaigns WHERE campaign_name = '" . $name . "' AND campaign_dm = '" . $dm . "'";
  $result = $mysqli->query($sqlq);
  $rows   = array();
  
  while ($r = $result->fetch_row()) {
    $rows[] = $r;
  }
  $existed = 1;
  if ($rows[0] === NULL) {
    $sqlq   = "INSERT INTO campaigns (campaign_dm, campaign_name, campaign_creation) VALUES ('" . $dm . "', '" . $name . "', NOW())";
    $input  = $mysqli->query($sqlq);
    $sqlq   = "SELECT * FROM campaigns WHERE campaign_name = '" . $name . "' AND campaign_dm = '" . $dm . "'";
    $result = $mysqli->query($sqlq);
    while ($r = $result->fetch_row()) {
      $rows[] = $r;
    }
    $existed = 0;
  }
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //-------------------------------------------------------------------------- 
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
                       $header[4]=>$existed);
    }
    $rows = $rows[0];
  }
  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($rows);
?>
