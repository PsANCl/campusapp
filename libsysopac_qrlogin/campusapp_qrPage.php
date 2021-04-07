<?php
$campusapp_host='https://wx.ccom.edu.cn'; // 萌校服务器地址
$apisource='ccom'; // 扫码登录所需渠道名称
// 以上两项请询问萌校部署人员

define('IN_ADMIN', 0);
include "../setting/setting.php";
if(empty($strSchoolName)) $strSchoolName='图书馆OPAC';

?>
<html>
<head>
<script type="text/javascript" src="/tpl/static/framework/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $campusapp_host;?>/js/mxqrcode.js"></script>
<script type="text/javascript" src="<?php echo $campusapp_host;?>/js/mxsocket.js"></script>
</head>
        <body>
<script type="text/javascript">
        new mxqrcode({
            debug: true,// 需要修改，是否开启debug
            host: "<?php echo $campusapp_host;?>",// 需要更改为真实的萌校域名
            channel: "normal",// 默认使用normal
            success: function(msg)//用户操作后所调用的函数
            {
                console.log(msg);
            },
            error: function(msg)//服务器发生异常时所调用的函数
            {
                console.log(msg);
            },
            ext: {
                "apiUrl":"<?php echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']; ?>/m/campusapp_getLogin.php?<?php echo $_SERVER['QUERY_STRING']; ?>",
                "apiKey":"<?php echo $apisource; ?>"
            },//业务所需要的参数
            div: "#qrcode",
            title: "登录<?php echo $strSchoolName; ?>",
            scanfinish: function(msg)// 用户扫描二维码后所调用的函数
            {
                console.log(msg);
            }
        });
    </script>
        <div id='qrcode' style="width:300px"/>
</body>
</html>
