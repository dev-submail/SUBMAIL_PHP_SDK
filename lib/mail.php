<?PHP
    class mail{
        
        protected $base_url='http://api.mysubmail.com/';
        //protected $base_url='http://api.submail.cn/';
        
        var $mail_configs;
        var $signType='normal';

        function __construct($mail_config){
            $this->mail_configs=$mail_config;
        }

        protected function createSignature($request){
            $r="";
            switch($this->signType){
                case 'normal':
                    $r=$this->mail_configs['appkey'];
                    break;
                case 'md5':
                    $r=$this->buildSignature($this->argSort($request));
                    break;
                case 'sha1':
                    $r=$this->buildSignature($this->argSort($request));
                    break;
            }
            return $r;
        }

        protected function buildSignature($request){
            $arg="";
            $app=$this->mail_configs['appid'];
            $appkey=$this->mail_configs['appkey'];
            while (list ($key, $val) = each ($request)) {
                if (strpos($key,"attachments")===false){
                    $arg.=$key."=".$val."&";
                }
            }
            $arg = substr($arg,0,count($arg)-2);
            if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
            if($this->signType=='sha1'){
                $r=sha1($app.$appkey.$arg.$app.$appkey);
            }else{
                $r=md5($app.$appkey.$arg.$app.$appkey);
            }
            return $r;
        }

        protected function argSort($request) {
            ksort($request);
            reset($request);
            return $request;
        }

        public function getTimestamp(){
            $api=$this->base_url.'service/timestamp.json';
            $ch = curl_init($api) ;
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
            $output = curl_exec($ch) ;
            $timestamp=json_decode($output,true);
            
            return $timestamp['timestamp'];
        }

        protected function APIHttpRequestCURL($api,$post_data){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $output = curl_exec($ch);
            curl_close($ch);
            $output = trim($output, "\xEF\xBB\xBF");
            return json_decode($output,true);
        }

        
        public function send($request){
            $api=$this->base_url.'mail/send.json';
            $request['appid']=$this->mail_configs['appid'];
            $request['timestamp']=$this->getTimestamp();
            if(empty($this->mail_configs['sign_type'])
               && $this->mail_configs['sign_type']==""
               && $this->mail_configs['sign_type']!="normal"
               && $this->mail_configs['sign_type']!="md5"
               && $this->mail_configs['sign_type']!="sha1"){
                $this->signType='normal';
            }else{
                $this->signType=$this->mail_configs['sign_type'];
                $request['sign_type']=$this->mail_configs['sign_type'];
            }
            $request['signature']=$this->createSignature($request);
            $send=$this->APIHttpRequestCURL($api,$request);

            return $send;
        }
        
        public function xsend($request){
            $api=$this->base_url.'mail/xsend.json';
            $request['appid']=$this->mail_configs['appid'];
            $request['timestamp']=$this->getTimestamp();
            if(empty($this->mail_configs['sign_type'])
               && $this->mail_configs['sign_type']==""
               && $this->mail_configs['sign_type']!="normal"
               && $this->mail_configs['sign_type']!="md5"
               && $this->mail_configs['sign_type']!="sha1"){
                $this->signType='normal';
            }else{
                $this->signType=$this->mail_configs['sign_type'];
                $request['sign_type']=$this->mail_configs['sign_type'];
            }
            $request['signature']=$this->createSignature($request);
            $xsend=$this->APIHttpRequestCURL($api,$request);
            return $xsend;
        }
        
        public function subscribe($request){
            $api=$this->base_url.'addressbook/mail/subscribe.json';
            $request['appid']=$this->mail_configs['appid'];
            $request['timestamp']=$this->getTimestamp();
            if(empty($this->mail_configs['sign_type'])
               && $this->mail_configs['sign_type']==""
               && $this->mail_configs['sign_type']!="normal"
               && $this->mail_configs['sign_type']!="md5"
               && $this->mail_configs['sign_type']!="sha1"){
                $this->signType='normal';
            }else{
                $this->signType=$this->mail_configs['sign_type'];
                $request['sign_type']=$this->mail_configs['sign_type'];
            }
            $request['signature']=$this->createSignature($request);
            $subscribe=$this->APIHttpRequestCURL($api,$request);
            return $subscribe;
        }

        public function unsubscribe($request){
            $api=$this->base_url.'addressbook/mail/unsubscribe.json';
            $request['appid']=$this->mail_configs['appid'];
            $request['timestamp']=$this->getTimestamp();
            if(empty($this->mail_configs['sign_type'])
               && $this->mail_configs['sign_type']==""
               && $this->mail_configs['sign_type']!="normal"
               && $this->mail_configs['sign_type']!="md5"
               && $this->mail_configs['sign_type']!="sha1"){
                $this->signType='normal';
            }else{
                $this->signType=$this->mail_configs['sign_type'];
                $request['sign_type']=$this->mail_configs['sign_type'];
            }
            $request['signature']=$this->createSignature($request);
            $unsubscribe=$this->APIHttpRequestCURL($api,$request);
            return $unsubscribe;
        }
    }
