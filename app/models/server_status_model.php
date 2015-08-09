
<?
class server_status_model extends CI_Model
{
        function getload(){
                        $load1 = sys_getloadavg();
			$loadoutput=array();
			$loadoutput['Metric']="Value";
			$loadoutput='{"cols":[{"id":"Load","label":"Load","type":"string"},{"id":"value","label":"Value","type":"number"}],"rows":[{"c":[{"v":"Now"},{"v":'.$load1[0].'}]},{"c":[{"v":"15min"},{"v":'.$load1[1].'}]},{"c":[{"v":"30mins"},{"v":'.$load1[2].'}]}]}';
		return $loadoutput;
                }

	function getdf($disk){
			$dspace=array();
                        $dspace['free'] = disk_free_space($disk)/1024000;
			$dspace['total']=disk_total_space($disk)/1024000;
			$dspace['used']=disk_total_space($disk)/1024000 - disk_free_space($disk)/1024000;
			$dspaceoutput='{"cols":[{"id":"Metric","label":"Metric","type":"string"},{"id":"value","label":"Value","type":"number"}],"rows":[{"c":[{"v":"Disk Free"},{"v":'.$dspace['free'].'}]},{"c":[{"v":"Disk Used"},{"v":'.$dspace['used'].'}]},{"c":[{"v":"Total Disk"},{"v":'.$dspace['total'].'}]}]}';

		return   $dspaceoutput;
                }

	function getcpu(){
			$stat1 = file('/proc/stat');
			sleep(1);
			$stat2 = file('/proc/stat');
			$info1 = explode(" ", preg_replace("!cpu +!", "", $stat1[0]));
			$info2 = explode(" ", preg_replace("!cpu +!", "", $stat2[0]));
			$dif = array();
			$dif['user'] = $info2[0] - $info1[0];
			$dif['nice'] = $info2[1] - $info1[1];
			$dif['sys'] = $info2[2] - $info1[2];
			$dif['idle'] = $info2[3] - $info1[3];
			$total = array_sum($dif);
			$cpu = array();
			foreach($dif as $x=>$y) $cpu[$x] = round($y / $total * 100, 1);
			$cpuoutput=json_encode($cpu);
		return $cpuoutput;
		}

	function getram(){
    			$data = explode("\n",rtrim( file_get_contents("/proc/meminfo")));
    			$meminfo = array();
    			foreach ($data as $line) {
    				list($key, $val) = explode(":", $line);
    				$meminfo[$key] = trim($val);
    				}
			$memoutput=array();
			$memoutput['Free']=rtrim($meminfo['MemFree'], " kB")+0;
			$memoutput['Total']=rtrim($meminfo['MemTotal'], " kB")+0;
			$memoutput['used']=$memoutput['Total']-$memoutput['Free'];
			$meminfojson=json_encode($memoutput);
    		return $meminfojson;
		}
}
?>
