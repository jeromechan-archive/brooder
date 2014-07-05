<?php
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: login.php
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php $this->load->view('public/css_import');?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/ui/css/entry.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/ui/css/login.css');?>">
</head>
<body class="body">
<div>
    <?php //$this->load->view('header/normal');?>
    <?php //$this->load->view('navigator/topbar');?>
    <div id="div_content"  style="height: 473px;">
        <!--<div class="container content">
            <span>hello world</span>
            &lt;!&ndash;放置容器所需要呈现的页面代码&ndash;&gt;

        </div>-->
        <div class="container">
            <form class="form-signin" method="POST" action="login/check">
                <h2 class="form-signin-heading">您好，请登录</h2>
                <input type="text" name="username" class="input-block-level" placeholder="Username" data-provide="typeahead" data-items="4"
                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware"]'>
                <input type="password" class="input-block-level" placeholder="Password" name="password">
                <button class="btn btn-large btn-primary" type="submit">登录</button>
                <a href="#">还不是成员吗?</a>
            </form>
        </div>
    </div>
    <?php //$this->load->view('footer/normal');?>
</div>
<?php $this->load->view('public/js_import');?>
<script src="<?php echo base_url('application/ui/javascript/login.js');?>"></script>
</body>
</html>