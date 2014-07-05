<?php
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: topbar.php
 */
?>
<div id="div_navbar">
    <div class="container">
        <div class="masthead">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="container">
                        <ul class="nav">
                            <li class="active" id="li_home"><a href="entry"><i class="icon-home"></i>首页</a></li>
                            <!--<li id="li_cspt_entry"><a href="#">CSPT</a></li>
                            <li id="li_cspt_manage"><a href="#">ManageList</a></li>-->

                            <li class="dropdown" id="li_cspt">
                                <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">CSPT系统<b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                                    <li role="presentation" id="li_cspt_entry" style="text-align: left;"><a role="menuitem" tabindex="-1" href="login">登录</a></li>
                                    <?php if($level==1){?>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation" id="li_cspt_manage" style="text-align: left;"><a role="menuitem" tabindex="-1" href="manage">片段管理列表</a></li>
                                    <?php }?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>