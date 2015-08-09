<script type="text/javascript">
      google.load('visualization', '1.1', {packages: ['controls']});
    </script>
<script type="text/javascript">
//loop thru dashboards
<? foreach ($dashboards as $dashname => $dashinfo){ ?>
	var <? print $dashname;?>AsJson
	var <? print $dashname;?>visualization
	var <? print $dashname;?>data

	function draw<? print $dashname;?>() {
		//pull data from URL for this dashboard
		<? print $dashname;?>AsJson = $.ajax({
			url: "<? echo $dashinfo['dataurl'];?>",
			dataType:"json",
			async: false
			}).responseText;
		<? print $dashname;?>data = new google.visualization.DataTable(<? print $dashname;?>AsJson);
		//write opening of dashboard div to content
		<?php $this->template->write('content', "<div id='".$dashname."'>"); ?>
		//loop thru filters
		<?php foreach ($dashboards[$dashname]['Filters'] as $key => $value) { ?>
			var <?php print $dashboards[$dashname]['Filters'][$key]["jsobject"]; ?> = new google.visualization.ControlWrapper({
				'controlType': '<?php print $dashboards[$dashname]['Filters'][$key]["type"]; ?>',
				'containerId': '<?php print $dashboards[$dashname]['Filters'][$key]["container"]; ?>',
				'options': {
					'filterColumnLabel': '<?php print $dashboards[$dashname]['Filters'][$key]["column"]; ?>',
					}
  				});
			//write filter div to content
			<?php $this->template->write('content', "<div id='".$dashboards[$dashname]['Filters'][$key]['container']."'></div>"); ?>
		<?php } ?>
		//loop thru charts
		<?php foreach ($dashboards[$dashname]['Charts'] as $key => $value) { ?>
			var <?php print $dashboards[$dashname]['Charts'][$key]["jsobject"]; ?> = new google.visualization.ChartWrapper({
				'chartType': '<?php print $dashboards[$dashname]['Charts'][$key]["type"]; ?>',
    				'containerId': '<?php print $dashboards[$dashname]['Charts'][$key]["container"]; ?>',
    				'options': {'allowHtml': true<?php foreach($dashboards[$dashname]['Charts'][$key]['options'] as $opt => $optval){ print ",'".$opt."': ".$optval;} ?>}
		  	});
			//write chart div to content
			<?php $this->template->write('content', "<div id='".$dashboards[$dashname]['Charts'][$key]["container"]."'></div>"); ?>
		<?php } ?>
		//close dashboard div
		<?php $this->template->write('content', "</div>"); ?>
		//generate and bind dashboard
		<? print $dashname;?>visualization = new google.visualization.Dashboard(document.getElementById('<? print $dashname;?>'));
		<?php foreach ($dashboards[$dashname]['Binds'] as $key => $value) { print $dashname."visualization.bind(".$dashboards[$dashname]['Binds'][$key]['control'].",".$dashboards[$dashname]['Binds'][$key]['controlled'].");";} ?> 
		//load mapit function once dashboard is ready
		google.visualization.events.addListener(<? print $dashname;?>visualization, 'ready',mapit);
		//draw the dashboard
		<? print $dashname;?>visualization.draw(<? print $dashname;?>data);
//end of function   
	}

	google.setOnLoadCallback(draw<? print $dashname;?>);
//end of dashboard
<? } ?>
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


<script type='text/javascript' src='/js/mapit.js'></script>
