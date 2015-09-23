<?PHP
    require 'message.php';
    class ADDRESSBOOKMessage{

        protected $appid='';

        protected $appkey='';

        protected $sign_type='';

        protected $Address='';

        protected $Target='';

        function __construct($configs){
            $this->appid=$configs['appid'];
            $this->appkey=$configs['appkey'];
            if(!empty($configs['sign_type'])){
                $this->sign_type=$configs['sign_type'];
            }
        }
        
        public function setAddress($address){
            $this->Address=$address;
        }
        
        public function setAddressbook($target){
            $this->Target=$target;
        }

        protected function buildRequest(){
            $request=array();
            $request['address']=$this->Address;
            if($this->Target!=''){
                $request['target']=$this->Target;
            }
            return $request;
            
        }
        public function subscribe(){
            $message_configs['appid']=$this->appid;
            $message_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $message_configs['sign_type']=$this->sign_type;
            }
            $addressbook=new message($message_configs);
            return $addressbook->subscribe($this->buildRequest());
        }
        public function unsubscribe(){
            $message_configs['appid']=$this->appid;
            $message_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $message_configs['sign_type']=$this->sign_type;
            }
            $addressbook=new message($message_configs);
            return $addressbook->unsubscribe($this->buildRequest());
        }
        
    }