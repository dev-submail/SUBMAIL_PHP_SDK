<?PHP
    require 'mobiledata.php';
    class mobiledatapackage{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        
        function __construct($configs){
            $this->appid=$configs['appid'];
            $this->appkey=$configs['appkey'];
            if(!empty($configs['sign_type'])){
                $this->sign_type=$configs['sign_type'];
            }
        }
        
        public function buildRequest(){
            $request=array();
            return $request;
        }
        public function package(){
            $mobiledata_configs['appid']=$this->appid;
            $mobiledata_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $mobiledata_configs['sign_type']=$this->sign_type;
            }
            $mobiledata=new mobiledata($mobiledata_configs);
            return $mobiledata->package($this->buildRequest());
        }
        
    }