<?php
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: manage.php
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php $this->load->view('public/css_import');?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('application/ui/css/entry.css');?>">
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
            <div style="float:right;">
                <!-- Button to trigger modal -->
                <a href="#myModal" role="button" class="btn" data-toggle="modal">新建片段</a>

                <!-- Modal -->
                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 id="myModalLabel" style="text-align: left;">新建片段</h5>
                    </div>
                    <div class="modal-body">
                        <form class="form-inline">
                            <table>
                                <tr>
                                    <td><label>片段名称</label></td>
                                    <td><input type="text" name="snippet_name" id="text_snippet_name" class="input-block-level" placeholder="填写片段名称"></td>
                                </tr>
                                <tr>
                                    <td><label>编程语言</label></td>
                                    <td>
                                        <select name="lang" id="sel_lang">
                                            <option value="0">请选择</option>
                                            <option value="1">PHP</option>
                                            <option value="2">HTML</option>
                                            <option value="3">CSS</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>标签</label></td>
                                    <td><input type="text" name="tags" id="text_tags" class="input-block-level" placeholder="填写个性化标签，逗号分隔"></td>
                                </tr>
                                <tr>
                                    <td><label>片段</label></td>
                                    <td>
                                        <textarea name="contens" id="ta_contents" style="margin: 0px; height: 105px; width: 453px;"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                        <button class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-bordered" style="font-size: 12px;table-layout:fixed;">
                <caption style="font-weight:bold;margin-bottom: 20px;"><!--用于对表的描述或总结，对屏幕阅读器特别有用-->片段管理列表</caption>
                <thead>
                <tr style="font-weight:bold;">
                    <th style="width: 60px;">序号</th>
                    <th style="width: 90px;">编程语言</th>
                    <th style="width: 160px;">标签</th>
                    <th style="width: auto;">片段名称</th>
                    <th style="width: 60px;">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>PHP</td>
                    <td style="word-wrap:break-word;">Tag1,Tag2,Tag-Imp</td>
                    <td style="word-wrap:break-word;">ROW1</td>
                    <td><a href="#" style="margin-right: 10px;">编辑</a><a href="#">删除</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>HTML</td>
                    <td style="word-wrap:break-word;">Tag1,Tag2,Tag-Imp</td>
                    <td style="word-wrap:break-word;">ROW2</td>
                    <td><a href="#" style="margin-right: 10px;">编辑</a><a href="#">删除</a></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>CSS</td>
                    <td style="word-wrap:break-word;">Tag1,Tag2,Tag-Imp</td>
                    <td style="word-wrap:break-word;">ROW3</td>
                    <td><a href="#" style="margin-right: 10px;">编辑</a><a href="#">删除</a></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Java</td>
                    <td style="word-wrap:break-word;">Tag1,Tag2,Tag-Imp</td>
                    <td style="word-wrap:break-word;">ROW3</td>
                    <td><a href="#" style="margin-right: 10px;">编辑</a><a href="#">删除</a></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Python</td>
                    <td style="word-wrap:break-word;">Tag1,Tag2,Tag-Imp</td>
                    <td style="word-wrap:break-word;">ROW3</td>
                    <td><a href="#" style="margin-right: 10px;">编辑</a><a href="#">删除</a></td>
                </tr>
                </tbody>
            </table>
            <!--<div class="pagination">
                <ul>
                    <li><a href="#">Prev</a></li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>-->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Prev</a>
                </li>
                <li class="next">
                    <a href="#">Next &rarr;</a>
                </li>
            </ul>
        </div>
    </div>
    <?php //$this->load->view('footer/normal');?>
</div>
<?php $this->load->view('public/js_import');?>
<script src="<?php echo base_url('application/ui/javascript/manage.js');?>"></script>
</body>
</html>