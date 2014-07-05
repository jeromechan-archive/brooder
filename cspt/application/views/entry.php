<?php
/**
 * Copyright © 2013 NEILSEN·CHAN. All rights reserved.
 * 
 * @date: 6/12/13
 * @description: index.php
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
        <div class="container content">
            <div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active" style="height: 445px;">
                        <img src="http://www.bootcss.com/assets/img/bootstrap-mdo-sfmoma-01.jpg" alt="">
                        <div class="carousel-caption">
                            <h4>First Thumbnail label</h4>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                    <div class="item" style="height: 445px;">
                        <img src="http://www.bootcss.com/assets/img/bootstrap-mdo-sfmoma-02.jpg" alt="">
                        <div class="carousel-caption">
                            <h4>Second Thumbnail label</h4>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                    <div class="item" style="height: 445px;">
                        <img src="http://www.bootcss.com/assets/img/bootstrap-mdo-sfmoma-03.jpg" alt="">
                        <div class="carousel-caption">
                            <h4>Third Thumbnail label</h4>
                            <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        </div>
                    </div>
                </div>
                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">></a>
            </div>
            <!--<div id="myCarousel" class="carousel slide">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                &lt;!&ndash; Carousel items &ndash;&gt;
                <div class="carousel-inner">
                    <div class="active item">…</div>
                    <div class="item">…</div>
                    <div class="item">…</div>
                </div>
                &lt;!&ndash; Carousel nav &ndash;&gt;
                <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
            </div>-->
        </div>
    </div>
    <?php //$this->load->view('footer/normal');?>
</div>
<?php $this->load->view('public/js_import');?>
<script src="<?php echo base_url('application/ui/javascript/entry.js');?>"></script>
</body>
</html>