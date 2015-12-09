<?PHP
    require 'voice.php';
    class mobiledatacharge{
        
        protected $appid='';
        
        protected $appkey='';
        
        protected $sign_type='';
        
        protected $To=array();
        
        protected $Addressbook=array();
        
        protected $cm='';
        
        protected $cu='';
        
        protected $ct='';
        
        function __construct($configs){
            $this->appid=$configs['appid'];
            $this->appkey=$configs['appkey'];
            if(!empty($configs['sign_type'])){
                $this->sign_type=$configs['sign_type'];
            }
        }
        
        public function AddTo($address){
            array_push($this->To,trim($address));
        }
    
        public function AddAddressbook($addressbook){
            array_push($this->Addressbook,$addressbook);
        }
        
        public function SetCM($cm){
            $this->cm=$cm;
        }
        
        public function SetCU($cu){
            $this->cu=$cu;
        }
        
        public function SetCT($ct){
            $this->ct=$ct;
        }
        
        public function buildRequest(){
            $request=array();
            if(!empty($this->To)){
                $request['to']='';
                foreach($this->To as $tmp){
                    $request['to'].=$tmp.',';
                }
                $request['to'] = substr($request['to'],0,count($request['to'])-2);
            }
            if($this->cm !=''){
                $request['cm']=$this->cm;
            }
            if($this->cu !=''){
                $request['cu']=$this->cu;
            }
            if($this->ct !=''){
                $request['ct']=$this->ct;
            }
            if(!empty($this->Addressbook)){
                $request['addressbook']='';
                foreach($this->Addressbook as $tmp){
                    $request['addressbook'].=$tmp.',';
                }
                $request['addressbook'] = substr($request['addressbook'],0,count($request['addressbook'])-2);
            }
            return $request;
        }
        public function charge(){
            $mobiledata_configs['appid']=$this->appid;
            $mobiledata_configs['appkey']=$this->appkey;
            if($this->sign_type!=''){
                $mobiledata_configs['sign_type']=$this->sign_type;
            }
            $mobiledata=new mobiledata($mobiledata_configs);
            return $mobiledata->charge($this->buildRequest());
        }
        
    }