
<?php 
/** 
 * Copyright 2007.  Paul Aitken <http://justletitflow.com> 
 * Licensed under The GNU General Public License (GPL) Version 2 or greater 
 * http://www.opensource.org/licenses/gpl-license.html 
 */ 
class ServerStatus 
{ 
    /** 
     * An multidimensional array, containing the ip, port, service name, type of connection, and status. 
     * 
     * @var array 
     */ 
    var $services = array(); 

    /** 
     * The timeout for the socket, when checking services. 
     * 
     * @var int 
     */ 
    var $timeout = 30; 

    /** 
     * The types of protocols currently available to php. 
     * 
     * @var array 
     */ 
    var $types = array('tcp', 'udp'); 

    /** 
     * Adds an array to the ServerStatus::services variable. 
     * 
     * @param string $name 
     * @param string $ip 
     * @param int $port 
     * @param string $type 
     * @param bool $status 
     * @param int $errno 
     * @param string $errstr 
     */ 
    function add($name, $ip, $port, $type = 'tcp', $status = false, $errno = '', $errstr = '') 
    { 
        $this->services[$name] = array( 
                                    'ip'         => $ip, 
                                    'port'         => $port, 
                                    'type'         => $type, 
                                    'status'     => $status, 
                                    'errno'        => $errno, 
                                    'errstr'    => $errstr 
                                ); 
    } 

    /** 
     * Sets the status of the provided service in ServerStatus::services 
     * 
     * @param string $name 
     * @param bool $status 
     * @return bool 
     */ 
    function set_status($name, $status = false) 
    { 
        return $this->services[$name]['status'] = $status; 
    } 

    /** 
     * Gets single service based on the name passed, that is in the ServerStatus::services array 
     * 
     * @param string $name 
     * @return bool 
     */ 
    function get($name) 
    { 
        if(in_array($this->services[$name]['type'], $this->types)) 
        { 
            //die($str); 
            $fp = @fsockopen( 
                            "{$this->services[$name]['type']}://{$this->services[$name]['ip']}", 
                            $this->services[$name]['port'], 
                            $this->services[$name]['errno'], 
                            $this->services[$name]['errstr'], 
                            $this->timeout 
                    ); 
            if($fp) 
            { 
                $this->set_status($name, true); 
            } 
            else 
            { 
                $this->set_status($name); 
            } 
            return $this->services[$name]['status']; 
        } 
    } 

    /** 
     * Scans all the services 
     * 
     */ 
    function check() 
    { 
        foreach($this->services as $service => $value) 
        { 
            $this->get($service); 
        } 
    } 

    /** 
     *Returns a service's status 
     * 
     * @param string $name 
     * @return bool 
     */ 
    function status($name) 
    { 
        return $this->services[$name]['status']; 
    } 

    /** 
     * Outputs 'pretty' print_r like information 
     * 
     * @param mixed $var 
     */ 
    function debug($var) 
    { 
        echo '<pre>'; 
        print_r($var); 
        echo '</pre>'; 
    } 

    /** 
     * Returns the number of total services 
     * 
     * @return int 
     */ 
    function total_services() 
    { 
        return count($this->services); 
    } 

    /** 
     * Returns the given service's array 
     * 
     * @param string $name 
     * @return array 
     */ 
    function service($name) 
    { 
        return $this->services[$name]; 
    } 
} 
?>
