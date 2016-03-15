<?PHP
    require 'message.php';
    class MESSAGETemplatePOST{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        protected $sms_title='';
        
        protected $sms_signature='';
        
        protected $sms_content='';
        
        function __construct($configs){
            $this->appid=$configs['appid'];
            $this->appkey=$configs['appkey'];
            if(!empty($configs['sign_type'])){
                $this->sign_type=$configs['sign_type'];
            }
        }
        
        public function SetTitle($sms_title){
            $this->sms_title=trim($sms_title);
        }
        
        public function SetSignature($sms_signature){
            $this->sms_signature=trim($sms_signature);
        }
        
        public function SetContent($sms_content){
            $this->sms_content=trim($sms_content);
        }
        
        public function buildRequest(){
            $request=array();
            if(!empty($this->sms_title)){
                $request['sms_title']=$this->sms_title;
            }
            
            $request['sms_signature']=$this->sms_signature;
            
            $request['sms_content']=$this->sms_content;
            
            return $request;
        }
        public function postTemplate(){
            $message_configs['appid']=$this->appid;
            $message_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $message_configs['sign_type']=$this->sign_type;
            }
            $message=new message($message_configs);
            return $message->postTemplate($this->buildRequest());
        }
        
    }