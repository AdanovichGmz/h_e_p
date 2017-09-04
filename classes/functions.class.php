<?php
class Functions {
    
    private $log_file, $fp;
    
    public function lfile() {
        $this->log_file = 'logs/mylog.txt';
    }
    
    public function lwrite($message,$file) {
        
        $this->log_file = 'logs/'.$file.'.txt';
        if (!is_resource($this->fp)) {
            $this->lopen();
        }
        
        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
      
        $time = @date('[d/M/Y:H:i:s]');
        
        if (is_array($message)) {
          
          foreach($message as $key => $value)
          {
              $arrmessage= $key." : ".$value."\n";
              fwrite($this->fp, "$time ($script_name) $arrmessage" . PHP_EOL);
          }
                    
          

          
        }else{
          fwrite($this->fp, "$time ($script_name) $message" . PHP_EOL);
        }
        
    }
   
    public function lclose() {
        fclose($this->fp);
    }
    
    private function lopen() {
            $log_file_default = 'logs/mylog.txt';
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }
}