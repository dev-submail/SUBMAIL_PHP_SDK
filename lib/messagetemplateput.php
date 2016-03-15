<?PHP
    require 'message.php';
    class MESSAGETemplatePUT{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        protected $template_id='';
        
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
        
        public function SetTemplate($template_id){
            $this->template_id=trim($template_id);
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
            
            $request['template_id']=$this->template_id;
            
            if(!empty($this->sms_title)){
                $request['sms_title']=$this->sms_title;
            }
            
            $request['sms_signature']=$this->sms_signature;
            
            $request['sms_content']=$this->sms_content;
            
            return $request;
        }
        public function putTemplate(){
            $message_configs['appid']=$this->appid;
            $message_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $message_configs['sign_type']=$this->sign_type;
            }
            $message=new message($message_configs);
            return $message->putTemplate($this->buildRequest());
        }
        
    }