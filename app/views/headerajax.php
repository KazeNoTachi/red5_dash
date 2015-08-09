<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1', {
        packages: ['table']
    });
</script>
<script type="text/javascript">
var options = {'showRowNumber': true};
var dataAsJson
var visualization
function drawTable() {
	options['page'] = 'enable';
	options['allowHtml'] = 'true';
	options['pageSize'] = 10;
	options['pagingSymbols'] = {prev: 'prev', next: 'next'};
  	options['pagingButtonsConfiguration'] = 'auto';
	options['width']='99%';
	visualization = new google.visualization.Table(document.getElementById('table_div'));

draw();
    }


    

function draw() {

 var dataAsJson = $.ajax({
          url: "<? echo $dataurl;?>",
          dataType:"json",
          async: false
          }).responseText;
	
	data = new google.visualization.DataTable(dataAsJson);


google.visualization.events.addListener(visualization, 'ready', function () {

        // set the width of the column with the title "Name" to 100px
        var title = 'Count';
        var width = '1%';
        $('.google-visualization-table-th:contains(' + title + ')').css('width', width);
  var title1 = 'Country';
        var width1 = '100px';
        $('.google-visualization-table-th:contains(' + title1 + ')').css('width', width1);
 var title2 = 'State';
        var width2 = '1%';
        $('.google-visualization-table-th:contains(' + title2 + ')').css('width', width2);         
    });

	visualization.draw(data, options);


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


google.setOnLoadCallback(drawTable);
</script>

<script type="text/javascript">

function fancyopen(url){
                                $.fancybox.open([{
                                        href : url,
                                        type : 'iframe',
                                        padding : 5



                                }],{

helpers : {
        overlay : {
            css : {
                'background' : 'rgba( 0, 0, 0, 0.80)'
            }
        }
    }
}
);


}
</script>
