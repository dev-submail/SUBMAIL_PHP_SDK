<?PHP
    require 'voice.php';
    class VOICEMultiXsend{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        protected $Multi=array();
        
        protected $Project='';
        
        function __construct($configs){
            $this->appid=$configs['appid'];
            $this->appkey=$configs['appkey'];
            if(!empty($configs['sign_type'])){
                $this->sign_type=$configs['sign_type'];
            }
        }
        
        public function AddMulti($multi){
            array_push($this->Multi,$multi);
        }
        
        public function AddAddressbook($addressbook){
            array_push($this->Addressbook,$addressbook);
        }
        
        public function SetProject($project){
            $this->Project=$project;
        }
        
        public function buildRequest(){
            $request=array();
            $request['project']=$this->Project;
            if(!empty($this->Multi)){
                $request['multi']=json_encode($this->Multi);
            }
            return $request;
        }
        
        public function multixsend(){
            
            $voice_configs['appid']=$this->appid;
            $voice_configs['appkey']=$this->appkey;
            
            if($this->sign_type!=''){
                $voice_configs['sign_type']=$this->sign_type;
            }
            
            $voice=new voice($voice_configs);
            
            return $voice->multixsend($this->buildRequest());
        }
        
    }
