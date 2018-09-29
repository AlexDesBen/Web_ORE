var $TABLE         = $('#table');
var $EXPORT        = $('#export');
var $STARTBTN      = $('#start-btn');
var $LOADBTN       = $('#load-btn');
var $CREATEBTN     = $('#create-btn');
var $CAMPAIGNDATA  = $('#campaign-json');
var $DM            = $('campaign_dm');
var $NAME          = $('campaign_name');
var $UUID          = $('campaign_id');

// A few jQuery helpers for exporting only
jQuery.fn.pop = [].pop;
jQuery.fn.shift = [].shift;
$CAMPAIGNDATA = 0;

$LOADBTN.click(function () {
  var $rows = $TABLE.find('tr:not(:hidden)');
  var headers = ["dm","campaign"];
  var data = [];
  
  // Get the headers (add special header logic here)
  $($rows.shift()).find('th:not(:empty)').each(function () {
    //headers.push($(this).text());
  });
  
  // Turn all existing rows into a loopable array
  $rows.each(function () {
    var $td = $(this).find('td');
    var h = {};
    
    // Use the headers from earlier to name our hash keys
    headers.forEach(function (header, i) {
      h[header] = $td.eq(i).text();
    });
    
    data.push(h);
  });
  data = data[0];
  // Output the result
  $DM     = data.dm;
  $NAME   = data.campaign;

  $(function () {
    $.ajax({
      type: "POST",
      url: 'js/getCampaigns.php',
      async: 'false',
      data: {dm:$DM,name:$NAME},
      success: function(output)
      {
        $('#export').html(output);
        var obj = JSON.parse(output)
        $UUID = obj.campaign_id;
        $CAMPAIGNDATA = obj;
        //$('#export').html(JSON.stringify($CAMPAIGNDATA));
        if (obj.existed == 1) {
          $('#export').html("Messages : Campaign loaded");
        }
        else {
          $('#export').html("Messages : Campaign not found. Please create campaign");
        }
      }
    });
  });
});

$CREATEBTN.click(function () {
  var $rows = $TABLE.find('tr:not(:hidden)');
  var headers = ["dm","campaign"];
  var data = [];
  
  // Get the headers (add special header logic here)
  $($rows.shift()).find('th:not(:empty)').each(function () {
    //headers.push($(this).text());
  });
  
  // Turn all existing rows into a loopable array
  $rows.each(function () {
    var $td = $(this).find('td');
    var h = {};
    
    // Use the headers from earlier to name our hash keys
    headers.forEach(function (header, i) {
      h[header] = $td.eq(i).text();
    });
    
    data.push(h);
  });
  data = data[0];
  // Output the result
  $DM     = data.dm;
  $NAME   = data.campaign;

  $(function () {
    $.ajax({
      type: "POST",
      url: 'js/createCampaign.php',
      async: 'false',
      data: {dm:$DM,name:$NAME},
      success: function(output)
      {
        $('#export').html(output);
        var obj = JSON.parse(output)
        $UUID = obj.campaign_id;
        $CAMPAIGNDATA = obj;
        if (obj.existed == 0) {
          $('#export').html("Message : Campaign created");
        }
        else {
          $('#export').html("Messages : Campaign already existed, campaing loaded.");
        }
      }
    });
  });
});

$STARTBTN.click(function () {
  if ($CAMPAIGNDATA == 0) {
    $('#export').html("Empty campaign data"+JSON.stringify($CAMPAIGNDATA));
  }
  else {
    $('#export').html("Not empty campaign data"+JSON.stringify($CAMPAIGNDATA));
    //window.location = "./SetUp?campaign_data:"+JSON.stringify($CAMPAIGNDATA);
    window.location = "./SetUp?campaign_id:"+JSON.stringify($UUID);
    //window.open("./SetUp", "_self", "campaign_data" + JSON.stringify($CAMPAIGNDATA));

  }
});

