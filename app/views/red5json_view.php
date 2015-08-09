<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
	<script type="text/javascript" src="http://www.google.com/jsapi"> </script>
	<link rel="stylesheet" href="http://www.jacklmoore.com/colorbox/example1/colorbox.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="http://red5.reachbig.com/colorbox/jquery.colorbox.js"> </script>

	<script>
		$(document).ready(function(){
			$(".iframe").colorbox({iframe:true, width:"80%", height:"80%",onComplete:function(){$().drawTable();}});
		});
	</script>

	<script type="text/javascript">
		google.load('visualization', '1.1', {packages: ['table','geomap','controls']});
	</script>


	<script type="text/javascript">
		var data = new google.visualization.DataTable();
		var options = {'showRowNumber': true};
		var table;




<?php if (isset($countries)){ ?>

function drawVisualization() {

var mapasjson=<?php echo $countries;?>

      var mapdata = new google.visualization.DataTable(mapasjson);

   var mapoptions = {};       
  mapoptions['region'] = 'US';    

      var geomap = new google.visualization.GeoMap(
          document.getElementById('map'));
      geomap.draw(mapdata, mapoptions);
    }
    

    google.setOnLoadCallback(drawVisualization);
<?php }?>


		function drawTable() {
			options = options || {};

			var dataAsJson =<?php echo $output;?>

			
			data = new google.visualization.DataTable(dataAsJson);
			  options['page'] = 'enable';
			  options['pageSize'] = 25;
			  options['pagingSymbols'] = {prev: 'prev', next: 'next'};
			  options['pagingButtonsConfiguration'] = 'auto';
			options['allowHtml']=true;
			table = new google.visualization.Table(document.getElementById('table_div'));
  var formatter = new google.visualization.TablePatternFormat('<a href="http://red5.reachbig.com/red5/clientdetails/{0}">{0}</a>');
  formatter.format(data, [0, 1]); // Apply formatter and set the formatted value of the first column.

			draw();
		}

		function draw(){
			table.draw(data, options);
		//	google.visualization.events.addListener(table, 'select', selectHandler);

		}

function selectHandler() {
	var selection = table.getSelection();
var message = '';
  for (var i = 0; i < selection.length; i++) {
    var item = selection[i];
    if (item.row != null && item.column != null) {
      var str = data.getFormattedValue(item.row, item.column);
      window.open("http://red5.reachbig.com/red5/clientdetails/"+ str)
    } else if (item.row != null) {
      var str = data.getFormattedValue(item.row, 0);
window.open("http://red5.reachbig.com/red5/clientdetails/"+ str) 

    } else if (item.column != null) {
      var str = data.getFormattedValue(0, item.column);
window.open("http://red5.reachbig.com/red5/clientdetails/"+ str) 

    }
  }
  if (message == '') {
    message = 'nothing';
  }
}
		google.setOnLoadCallback(drawTable);

		function setDimension(dimension, value) {
     	 		if (value) {
		 	  	options[dimension] = value;
		     	} else {
		       		options[dimension] = null;
      			}
			draw();
    		}

// sets the number of pages according to the user selection.
    		function setNumberOfPages(value) {
      			if (value) {
        			options['pageSize'] = parseInt(value, 10);
			        options['page'] = 'enable';
		      	} else {
			      	options['pageSize'] = null;
			      	options['page'] = null;
		      	}
		      	draw();
    		}

// Sets custom paging symbols "Prev"/"Next"
    		function setCustomPagingButtons(toSet) {
		      	options['pagingSymbols'] = toSet ? {next: 'next', prev: 'prev'} : null;
      			draw();
    		}

    		function setPagingButtonsConfiguration(value) {
      			options['pagingButtonsConfiguration'] = value;
      			draw();
    		}

</script>





  </head>

  <body class="docs framebox_body">
<a href="http://red5.reachbig.com/">BACK TO MENU</a>
    <div id="wrapper" style="width:90%;margin:auto;">
      <center><h1><?php echo $viewname;?></H1></CENTER>
	<div style="margin-bottom: 10px; padding: 5px; border: 1px solid gray; background-color: buttonface;">
      	  <form action="">
       	    <span style="font-size: 12px;">Number of rows:</span>
            <select style="font-size: 12px" onchange="setNumberOfPages(this.value)">
        	<option value="">No paging</option>
          	<option value="10">10</option>
          	<option selected="selected" value="25">25</option>
          	<option value="50">50</option>
          	<option value="100">100</option>
       	    </select>
	  </form>
      	</div>
	<div id="table_div"></div>
<div id="map"></div>
    </div>
  </body>
</html>
