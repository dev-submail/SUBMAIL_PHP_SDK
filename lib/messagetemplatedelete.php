<?PHP
    require 'message.php';
    class MESSAGETemplateDELETE{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        protected $template_id='';
        
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
        
        public function buildRequest(){
            $request=array();
            
            $request['template_id']=$this->template_id;

            return $request;
        }
        public function deleteTemplate(){
            $message_configs['appid']=$this->appid;
            $message_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $message_configs['sign_type']=$this->sign_type;
            }
            $message=new message($message_configs);
            return $message->deleteTemplate($this->buildRequest());
        }
        
    }