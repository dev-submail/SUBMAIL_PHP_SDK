<?PHP
    /*
     | Submail voice/multixsend API demo
     | SUBMAIL SDK Version 2.6 --PHP
     | copyright 2011 - 2017 SUBMAIL
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
     |初始化 MESSAGEMultiXsend 类
     |--------------------------------------------------------------------------
     */
    
    $submail=new VOICEMultiXsend($voice_configs);
    
    
    /*
     |multi 参数示例一
     |无文本变量
     |--------------------------------------------------------------------------
     */
    
    $contacts=array("18*********","15*********");
    
    foreach($contacts as $contact){
        $multi=new Multi();
        $multi->setTo($contact);
        $submail->addMulti($multi->build());
    }
    
    
    
    /*
     |multi 参数示例二
     |随机文本变量（以下示例为模板中包含@var(code)文本变量）
     |--------------------------------------------------------------------------
     */
    
    $contacts=array("18*********","15*********");
    
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
                          "to"=>"18*********",
                          "vars"=>array(
                                        "name"=>"jack",
                                        "code1"=>"FAD62979791",
                                        "code1"=>"FAD62979792",
                                        )
                          
                          ),
                    array(
                          "to"=>"15*********",
                          "vars"=>array(
                                        "name"=>"tom",
                                        "code1"=>"FAD62979793",
                                        "code1"=>"FAD62979794",
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
     |设置语音通知模板ID
     |--------------------------------------------------------------------------
     */
    
    $submail->SetProject('2glEg1');
    
    
    /*
     |调用 multixsend 方法发送语音通知
     |--------------------------------------------------------------------------
     */
    
    $xsend=$submail->multixsend();
    
    /*
     |打印服务器返回值
     |--------------------------------------------------------------------------
     */
    
    print_r($xsend);
