<?PHP
    require 'voice.php';
    class voiceverify{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        protected $To='';
        
        
        protected $Code='';

        
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
        
        public function SetCode($code){
            $this->Code=$code;
        }
        
        public function buildRequest(){
            $request=array();
            $request['to']=$this->To;
            $request['code']=$this->Code;
            return $request;
        }
        public function verify(){
            $voice_configs['appid']=$this->appid;
            $voice_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $voice_configs['sign_type']=$this->sign_type;
            }
            $voice=new voice($voice_configs);
            return $voice->verify($this->buildRequest());
        }
        
    }