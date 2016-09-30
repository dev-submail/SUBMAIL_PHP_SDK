<?PHP
    require 'intersms.php';
    class INTERNATIONALSMSXsend{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        protected $To=array();
        
        protected $Addressbook=array();
        
        protected $Project='';
        
        protected $Vars=array();
        
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
        
        public function AddAddressbook($addressbook){
            array_push($this->Addressbook,$addressbook);
        }
        
        public function SetProject($project){
            $this->Project=$project;
        }
        
        public function AddVar($key,$val){
            $this->Vars[$key]=$val;
        }
        
        public function buildRequest(){
            $request=array();
            $request['to']=$this->To;
            if(!empty($this->Addressbook)){
                $request['addressbook']='';
                foreach($this->Addressbook as $tmp){
                    $request['addressbook'].=$tmp.',';
                }
                $request['addressbook'] = substr($request['addressbook'],0,count($request['addressbook'])-2);
            }
            
            $request['project']=$this->Project;
            if(!empty($this->Vars)){
                $request['vars']=json_encode($this->Vars);
            }
            return $request;
        }
        public function xsend(){
            $intersms_configs['appid']=$this->appid;
            $intersms_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $intersms_configs['sign_type']=$this->sign_type;
            }
            $intersms=new intersms($intersms_configs);
            return $intersms->xsend($this->buildRequest());
        }
        
    }