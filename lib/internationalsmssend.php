<?PHP
    require 'intersms.php';
    class INTERNATIONALSMSsend{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        protected $To=array();
        
        protected $Content='';
        
        
        function __construct($configs){
            $this->appid=$configs['appid'];
            $this->appkey=$configs['appkey'];
            if(!empty($configs['sign_type'])){
                $this->sign_type=$configs['sign_type'];
            }
        }
        
        public function SetTo($address){
            $this->To=trim($address);
        }
        
        
        public function SetContent($content){
            $this->Content=$content;
        }
        
        public function AddVar($key,$val){
            $this->Vars[$key]=$val;
        }
        
        public function buildRequest(){
            $request=array();
            $request['to']=$this->To;
            $request['content']=$this->Content;
            return $request;
        }
        public function send(){
            $intersms_configs['appid']=$this->appid;
            $intersms_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $intersms_configs['sign_type']=$this->sign_type;
            }
            $intersms=new intersms($intersms_configs);
            return $intersms->send($this->buildRequest());
        }
        
    }