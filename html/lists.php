<?php 
$page_title = "Mailing Lists";
include_once("header.php");
include_once("sidebar.php");
?>


<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="app-content-body ">
      

<div class="bg-light lter b-b wrapper-md">
  <h1 class="m-n font-thin h3">Mailing Lists</h1>      
  <button class="btn btn-sm btn-primary pull-right"><b>Create List</b></button>
  <p>Create or Manage existing mailing lists</p>

</div>

<div class="wrapper-md">
  <div class="row">
    <div class="col-sm-12 connected">
      <div class="panel panel-default">
        <div class="panel-heading">                    
          <span id="lists_count" class="label bg-dark">02</span> Lists&nbsp;&nbsp;&nbsp;
          <div class="btn-group dropdown pull-right">
          <button class="btn btn-default" data-toggle="dropdown" aria-expanded="false">Sort by <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href>Action</a></li>
            <li><a href>Another action</a></li>
            <li><a href>Something else here</a></li>
            <li class="divider"></li>
            <li><a href>Separated link</a></li>
          </ul>
        </div>
            <br><br>
        </div>
        <div id="lists_detail_body" class="panel-body">

        <hr/>
        

          
          <div class="line pull-in"></div>
        </div>
      </div>
    </div>

  </div>
</div>


    </div>
  </div>
  <!-- / content -->

<?php 

include_once('footer.php');
?>


<script>

  function viewMailingListReport(list) {
      console.log("list : " + list);  //receiver list collection name - process it further from here
      return;
  }


  $( document ).ready(function() {


    $.ajax( {
      url: "test_data/mailing_lists_json.php",
      success: function(result) {
        console.log(result);
        var mailingListsDetailJson = JSON.parse(result);

        var mailing_lists_count = mailingListsDetailJson.count;
        var mailingListsDetailArray = mailingListsDetailJson.mailing_lists;

        $("#lists_count").text(mailing_lists_count);

        for (var i = 0; i < mailing_lists_count; i++) {

          var functionCall = 'viewMailingListReport("' + mailingListsDetailArray[i].mailing_list_collection_name + '")';
          console.log(functionCall);

            var preparedHtml =  "<div class='row'>" + 
                        "<div class='col-sm-1'>" +
                        "<div class='checkbox'>" + 
                        "<label class='i-checks i-checks-lg'>" + 
                        "<input type='checkbox'>" + 
                        "<i></i>" +
                        "</label>" +
                        "</div>" + 
                        "</div>" +
                        "<div class='col-sm-6'>" +
                        mailingListsDetailArray[i].list_name + 
                        "<p>" + 
                        mailingListsDetailArray[i].description + "<br>" + 
                        "Processed on " + mailingListsDetailArray[i].creation_date + 
                        "</p>" + 
                        "</div>" + 
                        "<div class='col-sm-2'>" + 
                        mailingListsDetailArray[i].subscribers + " subscriber" + 
                        "</div>" + 
                        "<div class='col-sm-3'>" +
                        "<a class='btn m-b-xs btn-sm btn-info btn-addon' onClick='" + functionCall + ";' href='#'><i class='fa fa-plus'></i>View Details</a>" + 
                        "</div>" + 
                        "</div>" + 
                        "<hr>"; 

            $("#lists_detail_body").append(preparedHtml);
        };                 

       }

    }); //end ajax  

  });

</script>

<?php
include_once('footer_closing.php');
?>
