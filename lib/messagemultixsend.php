<?PHP
    require 'message.php';
    class MESSAGEMultiXsend{

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

            $message_configs['appid']=$this->appid;
            $message_configs['appkey']=$this->appkey;
            
            if($this->sign_type!=''){
                $message_configs['sign_type']=$this->sign_type;
            }
            
            $message=new message($message_configs);
            
            return $message->multixsend($this->buildRequest());
        }
        
    }