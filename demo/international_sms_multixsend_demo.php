<?PHP
    /*
     | Submail internationalsms/multixsend API demo
     | SUBMAIL SDK Version 2.5 --PHP
     | copyright 2011 - 2016 SUBMAIL
     |--------------------------------------------------------------------------
     */
    
    /*
     |载入 app_config 文件
     |--------------------------------------------------------------------------
     */
    require '../app_config.php';
    
    /*
     |载入 SUBMAILAutoload 文件
     |--------------------------------------------------------------------------
     */
    
    require_once('../SUBMAILAutoload.php');
    
    /*
     |初始化 INTERNATIONALSMSMultiXsend 类
     |--------------------------------------------------------------------------
     */
    
    $submail=new INTERNATIONALSMSMultiXsend($intersms_configs);
    
    
    /*
     |multi 参数示例一
     |无文本变量
     |设置短信接收的国际手机号码，使用标准的 E164 格式，e.g. +1778889901，仅支持单个手机号码，不支持 +86 国内手机号码
     |--------------------------------------------------------------------------
     */
    
    $contacts=array("18*********","15*********");
    
    foreach($contacts as $contact){
        $multi=new Multi();
        /*
         |setTo 设置短信接收的国际手机号码，使用标准的 E164 格式，e.g. +1778889901，不支持 +86 国内手机号码
         |--------------------------------------------------------------------------
         */
        $multi->setTo($contact);
        $submail->addMulti($multi->build());
    }
    
    
    
    /*
     |multi 参数示例二
     |随机文本变量（以下示例为模板中包含@var(code)文本变量）
     |--------------------------------------------------------------------------
     */
    
    $contacts=array("+18*********","+5*********");
    
    foreach($contacts as $contact){
        $multi=new Multi();
        $multi->setTo($contact);
        $multi->addVar("code",rand(000000,999999));
        $submail->addMulti($multi->build());
    }
    
    
    /*
     |multi 参数示例三
     |多文本变量示例（以下示例为模板中包含@var(name)，@var(code1),@var(code2)分别对应联系人的三个文本变量）
     |--------------------------------------------------------------------------
     */
    
    $contacts=array(
                    array(
                          "to"=>"+8*********",
                          "vars"=>array(
                                        "name"=>"jack",
                                        "code1"=>"FAD62979791",
                                        "code2"=>"FAD62979792",
                                        )
                          
                          ),
                    array(
                          "to"=>"+5*********",
                          "vars"=>array(
                                        "name"=>"tom",
                                        "code1"=>"FAD62979793",
                                        "code2"=>"FAD62979794",
                                        )
                          )
                    );
    
    foreach($contacts as $contact){
        $multi=new Multi();
        $multi->setTo($contact['to']);
        
        foreach($contact['vars'] as $key=>$value){
            $multi->addVar($key,$value);
        }
        
        $submail->addMulti($multi->build());
    }
    
    /*
     |必选参数
     |--------------------------------------------------------------------------
     |设置短信模板ID
     |--------------------------------------------------------------------------
     */
    
    $submail->SetProject('2glEg1');
    
    
    /*
     |调用 multixsend 方法发送短信
     |--------------------------------------------------------------------------
     */
    
    $xsend=$submail->multixsend();
    
    /*
     |打印服务器返回值
     |--------------------------------------------------------------------------
     */
    
    print_r($xsend);
