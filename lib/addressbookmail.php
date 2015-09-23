<?PHP
    require 'mail.php';
    class ADDRESSBOOKMail{

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
        
        public function setAddress($address,$name=''){
            $this->Address=$name.'<'.$address.'>';
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
            $mail_configs['appid']=$this->appid;
            $mail_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $mail_configs['sign_type']=$this->sign_type;
            }
            $addressbook=new mail($mail_configs);
            return $addressbook->subscribe($this->buildRequest());
        }
        public function unsubscribe(){
            $mail_configs['appid']=$this->appid;
            $mail_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $mail_configs['sign_type']=$this->sign_type;
            }
            $addressbook=new mail($mail_configs);
            return $addressbook->unsubscribe($this->buildRequest());
        }
        
    }