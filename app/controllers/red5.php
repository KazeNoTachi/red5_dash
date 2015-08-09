<?
class Red5 extends CI_Controller
{
                function __construct()
                {
                                parent::__construct();
 				$this->load->library('session');

                                $this->load->library('ion_auth');
                                $this->load->library('template');
                                $this->load->model('logstash_model');
                                $this->load->model('server_status_model');

				$this->template->add_css('css/reset.css');
				$this->template->add_css('css/default.css');
				$this->template->add_css('css/style1.css');
 				$this->template->add_css('css/fancybox.css');

				$this->load->library('ServerStatus');


				$this->session->set_userdata('backURL', str_replace("index.php", "",$_SERVER['REQUEST_URI']));

                }

                function display()
                {
                                $table="all_streams";
                                $wherearray=$this->uri->uri_to_assoc(3);
                                $dataurl="/red5/data/".$this->uri->assoc_to_uri($wherearray);
                                if (!$this->ion_auth->logged_in())
                                        {
                                                redirect('auth/login');
                                        } //!$this->ion_auth->logged_in()
                                $data             = array();
                                $data['dashboards']['dash1']['dataurl']=$dataurl;
                                $data['viewname'] = ucwords(str_replace('_', ' ',$this->uri->segment(3,0)));
                                switch ($this->uri->segment(3,0)) {
 					case "all_clients":
						$data['dashboards']['dash1']['Filters']['control1']['column'] = "City";
						$data['dashboards']['dash1']['Filters']['control1']['type'] = "StringFilter";
						$data['dashboards']['dash1']['Filters']['control1']['container'] = "control1";
						$data['dashboards']['dash1']['Filters']['control1']['jsobject'] = "City";
						$data['dashboards']['dash2']['Filters']['control1']['column'] = "City";
						$data['dashboards']['dash2']['Filters']['control1']['type'] = "StringFilter";
						$data['dashboards']['dash2']['Filters']['control1']['container'] = "control";
						$data['dashboards']['dash2']['Filters']['control1']['jsobject'] = "City";
						$data['dashboards']['dash1']['Charts']['chart1']['jsobject'] = "table";
						$data['dashboards']['dash1']['Charts']['chart1']['container'] = "table2";
						$data['dashboards']['dash1']['Charts']['chart1']['type'] = "Table";
                                                $data['dashboards']['dash2']['Charts']['chart1']['jsobject'] = "table";
                                                $data['dashboards']['dash2']['Charts']['chart1']['container'] = "table";
                                                $data['dashboards']['dash2']['Charts']['chart1']['type'] = "Table";
						$data['dashboards']['dash2']['Binds']['bind2']['controlled']="table";
						$data['dashboards']['dash2']['Binds']['bind2']['control']="City";
						$data['dashboards']['dash1']['Binds']['bind1']['controlled']="table";
						$data['dashboards']['dash1']['Binds']['bind1']['control']="City";
						$data['dashboards']['dash1']['Charts']['chart1']['options']= array('showRowNumber'=> true,'page' => '"enable"','pageSize' => 25, 'pagingButtonsConfiguration'=>"'auto'");
						$data['dashboards']['dash2']['Charts']['chart1']['options']= array();
		                                $data['dashboards']['dash2']['dataurl']="/red5/data/active_clients";

						break;
 					case "active_clients":
						$data['dashboards']['dash1']['Filters']['control1']['column'] = "City";
                                                $data['dashboards']['dash1']['Filters']['control1']['type'] = "StringFilter";
                                                $data['dashboards']['dash1']['Filters']['control1']['container'] = "control1";
                                                $data['dashboards']['dash1']['Filters']['control1']['jsobject'] = "cityfilter";
	        				$data['dashboards']['dash1']['Charts']['chart1']['jsobject'] = "table";
                                                $data['dashboards']['dash1']['Charts']['chart1']['container'] = "table";
                                                $data['dashboards']['dash1']['Charts']['chart1']['type'] = "Table";
						$data['dashboards']['dash1']['Binds']['bind1']['control']="cityfilter";
						$data['dashboards']['dash1']['Binds']['bind1']['controlled']="table";
						$data['dashboards']['dash1']['Charts']['chart1']['options']= array('showRowNumber'=> true,'page' => '"enable"','pageSize' => 25, 'pagingButtonsConfiguration'=>"'auto'");

						break;
    					case "all_sessions":
						$data['dashboards']['dash1']['Filters']['control1']['column'] = "IP";
                                                $data['dashboards']['dash1']['Filters']['control1']['type'] = "StringFilter";
                                                $data['dashboards']['dash1']['Filters']['control1']['container'] = "control1";
                                                $data['dashboards']['dash1']['Filters']['control1']['jsobject'] = "IPFilter";
						$data['dashboards']['dash1']['Charts']['chart1']['options']= array();
	        				$data['dashboards']['dash1']['Charts']['chart1']['jsobject'] = "table";
                                                $data['dashboards']['dash1']['Charts']['chart1']['container'] = "table";
                                                $data['dashboards']['dash1']['Charts']['chart1']['type'] = "Table";
						$data['dashboards']['dash1']['Charts']['chart1']['options']= array('showRowNumber'=> true,'page' => '"enable"','pageSize' => 25, 'pagingButtonsConfiguration'=>"'auto'");
						$data['dashboards']['dash1']['Binds']['bind1']['control']="IPFilter";
						$data['dashboards']['dash1']['Binds']['bind1']['controlled']="table";
        					break;
                                        case "all_streams":
                                                $data['dashboards']['dash1']['Filters']['control1']['column'] = "ID";
                                                $data['dashboards']['dash1']['Filters']['control1']['type'] = "StringFilter";
                                                $data['dashboards']['dash1']['Filters']['control1']['container'] = "control1";
                                                $data['dashboards']['dash1']['Filters']['control1']['jsobject'] = "IDFilter";
                                                $data['dashboards']['dash1']['Charts']['chart1']['jsobject'] = "table";
                                                $data['dashboards']['dash1']['Charts']['chart1']['container'] = "table";
                                                $data['dashboards']['dash1']['Charts']['chart1']['type'] = "Table";
						$data['dashboards']['dash1']['Charts']['chart1']['options']= array('showRowNumber'=> true,'page' => '"enable"','pageSize' => 25, 'pagingButtonsConfiguration'=>"'auto'");
						$data['dashboards']['dash1']['Binds']['bind1']['control']="IDFilter";
                                                $data['dashboards']['dash1']['Binds']['bind1']['controlled']="table";
                                                break;
    					default:
						//dash1
						$data['dashboards']['dash1']['dataurl']="/red5/data/load";
                                                $data['dashboards']['dash1']['Filters']['control1']['column'] = "Load";
                                                $data['dashboards']['dash1']['Filters']['control1']['type'] = "CategoryFilter";
                                                $data['dashboards']['dash1']['Filters']['control1']['container'] = "control1";
                                                $data['dashboards']['dash1']['Filters']['control1']['jsobject'] = "catFilter";
						$data['dashboards']['dash1']['Binds']['bind1']['control']="catFilter";
                                                $data['dashboards']['dash1']['Binds']['bind1']['controlled']="loadgauge";


	        				$data['dashboards']['dash1']['Charts']['chart1']['jsobject'] = "loadgauge";
                                                $data['dashboards']['dash1']['Charts']['chart1']['container'] = "loadgauge";
                                                $data['dashboards']['dash1']['Charts']['chart1']['type'] = "Gauge";
						$data['dashboards']['dash1']['Charts']['chart1']['options']= array();
						//dash1
						$data['dashboards']['dash2']['dataurl']="/red5/data/disk";
                                                $data['dashboards']['dash2']['Filters']['control1']['column'] = "Metric";
                                                $data['dashboards']['dash2']['Filters']['control1']['type'] = "CategoryFilter";
                                                $data['dashboards']['dash2']['Filters']['control1']['container'] = "control2";
                                                $data['dashboards']['dash2']['Filters']['control1']['jsobject'] = "catdiskFilter";
						$data['dashboards']['dash2']['Binds']['bind1']['control']="catdiskFilter";
                                                $data['dashboards']['dash2']['Binds']['bind1']['controlled']="diskgauge";

	        				$data['dashboards']['dash2']['Charts']['chart1']['jsobject'] = "diskgauge";
                                                $data['dashboards']['dash2']['Charts']['chart1']['container'] = "diskgauge";
                                                $data['dashboards']['dash2']['Charts']['chart1']['type'] = "Gauge";
						$data['dashboards']['dash2']['Charts']['chart1']['options']= array('max'=>5500,'title'=>'"Disk space"');

						break;

					}
				if (!$this->uri->segment(4,0)) 
                                        {
                                                $this->template->write_view('menu', 'modules/menu');

                                        }else{

                                                $data['viewname'] = "<b>".$this->uri->segment(5,0)."</b> Details";
                                                $this->template->set_template('embed');

                                        }        
                                                $this->template->write_view('content', 'content', $data);
                                                $this->template->write_view('contentheader', 'contentheader');
                                                $this->template->write_view('options', 'options');
                                                $this->template->write_view('footer', 'footer.php');
                                                $this->template->write_view('header', 'header.dash.php', $data);

                                $this->template->render();
                }


                function index()
                {
                                if (!$this->ion_auth->logged_in())
                                {
                                                redirect('auth/login');
                                } //!$this->ion_auth->logged_in()
                                //$this->load->view('index');
					$data['viewname']="RED5 Statistics Dashboard";
				$ram=$this->server_status_model->getram();
				$df=$this->server_status_model->getdf("/");
				$load=$this->server_status_model->getload();
				$cpu=$this->server_status_model->getcpu();
                                $this->template->write_view('menu', 'modules/menu');
                                $this->template->write_view('header', 'headerajax.php',$data);
                                $this->template->write_view('content', 'content');
                                $this->template->write_view('footer', 'footer.php');
                                $this->template->write('content', $ram."<br>");
                                $this->template->write('content', $df."<br>");
                                $this->template->write('content', $cpu."<br>");
                                $this->template->write('content', $load."<br>");



                                $this->template->render();
                }

//DATA FUNCTIONS BELOW

                function data()
                {
			function array_clean_key( &$array )
			{
				$return=array();
    				foreach ( $array as $k => $v )
        				$return[urldecode($k)] = $v;
    				return ( array ) $return;
			}

                        $table = $this->uri->segment(3, 0);

			

			$wherearray = $this->uri->uri_to_assoc(4);
			array_walk($wherearray, function(&$n){ $n=urldecode($n);});   
			$wherearrayclean=array_clean_key($wherearray);
			 if (!$this->ion_auth->logged_in())
                                {
                                                redirect('auth/login');
                                } //!$this->ion_auth->logged_in()
			$data             = array();
	switch ($table) {
		case "load":
			$data['output']=$this->server_status_model->getload();
			break;
		case "disk":
			$data['output']=$this->server_status_model->getdf("/");
			break;
		default:
			$data['output']   = $this->logstash_model->table2json($table,$wherearrayclean);
	}
			$this->load->view('data', $data);
                }





}
?>
