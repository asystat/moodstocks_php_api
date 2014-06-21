<?php 

class MoodstocksManager{
    
    private static $instance;
    private $API_BASE_URL = 'http://api.moodstocks.com/v2/';
    private $API_KEY      = 'Your api key';
    private $API_SECRET   = 'your api secret';
    private $CURL_OPTS;    

    
    private function __construct(){ 
        
        if (!function_exists('curl_init')) {
          throw new Exception('You need to install the CURL PHP extension.');
        }

        $this->CURL_OPTS    = array(
        	CURLOPT_RETURNTRANSFER => true,
        	CURLOPT_HTTPAUTH       => CURLAUTH_DIGEST,
        	CURLOPT_USERPWD        => $this->API_KEY . ':' . $this->API_SECRET
        );
    } 
    
      // getInstance method 
      public static function getInstance() { 
    
        if(!self::$instance) { 
          self::$instance = new self(); 
        } 
        return self::$instance; 
    
      } 


    
    public function ms_echo(){
        $opts = $this->CURL_OPTS;
        $opts[CURLOPT_URL] = $this->API_BASE_URL . "echo?foo=bar&caca=chunky";
        
        $ch = curl_init(); 
        curl_setopt_array($ch, $opts);
        $raw_resp = curl_exec($ch); 
        
        echo "Echo: " . $raw_resp . "\n";
          
        curl_close($ch);
    }
    
    function ms_addimage($file, $hash_id){
        
        $opts = $this->CURL_OPTS;
        $opts[CURLOPT_URL] = $this->API_BASE_URL . "ref/".$hash_id;
        $opts[CURLOPT_POST] =true;
        $opts[CURLOPT_POSTFIELDS] = array("image_file" => "@".realpath($file));
        $opts[CURLOPT_CUSTOMREQUEST]="PUT";
        $ch = curl_init(); 
        curl_setopt_array($ch, $opts);
        
        $raw_resp = curl_exec($ch);
        
        echo "Response: " . $raw_resp . "\n";
        
          
        curl_close($ch);
    }
    
    function ms_enableoffline($hash_id){
        
        $opts = $this->CURL_OPTS;
        $opts[CURLOPT_URL] = $this->API_BASE_URL . "ref/".$hash_id."/offline";
        $opts[CURLOPT_POST] =true;
        $ch = curl_init(); 
        curl_setopt_array($ch, $opts);
        
        $raw_resp = curl_exec($ch);
        
        echo "Response: " . $raw_resp . "\n";
        
          
        curl_close($ch);
    }
    
    function ms_disableoffline($hash_id){
        
        $opts = $this->CURL_OPTS;
        $opts[CURLOPT_URL] = $this->API_BASE_URL . "ref/".$hash_id."/offline";
        $opts[CURLOPT_CUSTOMREQUEST]="DELETE";
        $ch = curl_init(); 
        curl_setopt_array($ch, $opts);
        
        $raw_resp = curl_exec($ch);
        
        echo "Response: " . $raw_resp . "\n";

        curl_close($ch);
    }
    
}

?>