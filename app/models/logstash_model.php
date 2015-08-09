<?
class logstash_model extends CI_Model
        {
                function table2json($tablename,$wherearray=NULL)
                        {
				if ($tablename=="users"){
					$tablename="BADBOY";
				}
				if($wherearray){
				 $this->db->where($wherearray);
				}
                                
				$Query    = $this->db->get( $tablename );
//do the COLUMNS
				$fields = $fields = $this->db->field_data($tablename);
				$columns=array();
				foreach ($fields as $field) {
				$name=$field->name;
				$type=$field->type;
				$length=$field->max_length;
// match MYSQL types to GAPI types;
				if ($type =="varchar"){
					$type="string";
					if ($length==5){
						$type="boolean";
					}
				}
 				if ($type =="time"){
                                        $type="string";
                                }
 				if ($type =="int"){
                                        $type="number";
                                }
				if ($type =="bigint"){
                                        $type="number";
                                }
				 if ($type =="decimal"){
                                        $type="number";
                                }
                                if ($type =="datetime"){
                                }

					$column=array(
						'id'=>$name,
						'label'=>$name,
						'type'=>$type
					);
					array_push($columns, $column);
				}
		                  $cols     = array(
                                                 array(
                                                                 'cols' => array($columns) 
                                                ) 
                                );
//DO THE ROWS
				$rows=array();
                                foreach ( $Query->result() as $row )
                                        {	
					$values=array();
					foreach ($row as $value){
				$pattern = null;
//				$pattern="<div class='".$value."'>".$value."</div>";
//CHANGE DATES TO JS DATES
				if (preg_match("/^\d\d\d\d-(\d)?\d-(\d)?\d \d\d:\d\d:\d\d$/i", $value)) {
    						$value1= new DateTime( $value );

                                                $value1->modify( '-2 month' );
                                                $value = 'Date('. $value1->format( 'Y, m, d, H, i, s' ) .')';
                                                $value1->modify( '+1 month' );

						$pattern=$value1->format( 'm/d/Y - H:i:s' );

				}
// ADD link to IP addresses
				if ( $this->input->valid_ip($value)){
                                        $url='"/red5/display/all_sessions/ip/'.$value.'"';     
					   $pattern="<a class='fancybox' onclick='fancyopen(".$url.")' href='#' >".$value."</a>";
                                }

						if ($pattern){
						array_push($values,array( 'v'=>$value,'f'=>$pattern));
						}else{
						 array_push($values,array( 'v'=>$value));
						}

						}
						array_push( $rows, array(
                                                                 'c' => array( $values
                                                                ) 
                                                ) );
				}
//PUT IT ALL TOGETHER
				array_push( $cols, array(
                                                 'rows' => $rows 
                                ) );
                                $json   = trim( json_encode( $cols,JSON_NUMERIC_CHECK ), "[]" );
				$json   = str_replace( "[[", "[", $json );
				$json   = str_replace( "]]", "]", $json );
                                $json   = str_replace( '},{"rows"', ',"rows"', $json );
				$json   = str_replace('"FALSE"', "false", $json );
				$json   = str_replace('"TRUE"', "true", $json );
				$output = $json ;
                                return $output;
                        }
        }
?>

