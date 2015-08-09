function mapit() {
	var locval;     // final returned value
	var th;		//uncleaned table header
	var row;	//selected row
	var column;	//selected column
	var end;  	//test to end function
	var dash; 	//fix for multi dashboard tables on same page
	$(".google-visualization-table-td").click(function (){
		row = this.parentNode.rowIndex;
        	column = this.cellIndex;
       		th = $('tr').first().find('td').eq(column).text();
		dash = $(this).parents("div")[3].id;
//check th value
	filter_th();
	if(end === true){
		end = null;
		return;	
	}
	
//column index array	
	var col_count=$('#'+dash).find("tr:first td").length;
	var col_index=new Array();
	var i=0
	while(i<col_count) {
		var loop_td = $('#'+dash).find("tr:first td").eq(i).text();
		var loop_td_clean = loop_td.replace(/\W/g,'');

		col_index[i] = loop_td_clean;
	i++;
	}	

	//output Array
//	console.log(col_index.toString());


	var cityIndex = col_index.indexOf('City');
	var cityval = $('#'+dash+' tr').eq(row).find('td').eq(cityIndex).html();
	var stateIndex = col_index.indexOf('State');
	var stateval = $('#'+dash+' tr').eq(row).find('td').eq(stateIndex).html();
	var countryIndex = col_index.indexOf('Country');
	var countryval = $('#'+dash+' tr').eq(row).find('td').eq(countryIndex).html();
	locval = cityval+", "+stateval+" "+countryval;
	var mapurl = "https://maps.google.com/maps?q="+ locval+"&output=embed";
	fancyopen(mapurl);

	}); 	//end click function


//test column name 
	function filter_th(){
		th_cleaned = th.replace(/\W/g, '');
		if(th_cleaned == "State"||th_cleaned == "City"||th_cleaned == "Country"){
//		        console.log(th_cleaned+" good. row "+ row +". column"+ column);
			
		}
		else{
			end = true;
		}
	}	//end filter_th
 
}	//end mapit




