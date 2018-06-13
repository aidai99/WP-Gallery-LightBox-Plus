<?php

class WP_GalleryLightBox_Admin{

    function __construct(){
        //创建菜单
        add_action("admin_menu",array($this,"init"));
    }

    function getOption(){
        //获取配置
        $options = get_option('wp_gallerylightbox_config');
        //判断
        if(!is_array($options))
        {
            $options['customCss'] = '';
            $options['isJQuery'] = false;
            update_option('wp_gallerylightbox_config', $options);
        }
        return $options;
    }

    function init(){
        $options = $this->getOption();
        //添加子菜单页面
        add_options_page("WP-Gallery-LightBox","WP-Gallery-LightBox","manage_options","wp_gallerylightbox_setting",array($this,"optionPage"));
        
        if(isset($_POST['wp_gallerylightbox_save'])) {
            $options['customCss'] = stripslashes($_POST['customCss']);
            if ($_POST['isJQuery']) { $options['isJQuery'] = (bool)true; } else { $options['isJQuery'] = (bool)false; }
            update_option('wp_gallerylightbox_config', $options);
            echo "<div id='message' class='updated fade'><p><strong>数据已更新</strong></p></div>";
        
        }else if(isset($_POST["wp_gallerylightbox_clear"]))
        {
            $options['customCss'] = "";
            $options["isJQuery"] = false;
            update_option('wp_gallerylightbox_config', $options);
            echo "<div id='message' class='error fade'><p><strong>数据已清除</strong></p></div>";
        }

    }

    function optionPage(){

		$options = $this->getOption();

        ?>


        <style type="text/css">

        #pure_form{font-family:"Century Gothic", "Segoe UI", Arial, "Microsoft YaHei",Sans-Serif;}
        .wrap{padding:10px; font-size:12px; line-height:24px;color:#383838;}
        .otakutable td{vertical-align:top;text-align: left;border:none ;font-size:12px; }
        .top td{vertical-align: middle;text-align: left; border:none;font-size:12px;}
        table{border:none;font-size:12px;}
        pre{white-space: pre;overflow: auto;padding:0px;line-height:19px;font-size:12px;color:#898989;}
        strong{ color:#666}
        .none{display:none;}
        fieldset{ width: 800px;margin: 5px 0 10px;
        padding: 10px 10px 20px 10px;
        -moz-border-radius: 5px;
        -khtml-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        border: 3px solid #ff8c83;}
        fieldset:hover{border-color:#bbb;}
        fieldset legend{color: #777;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        display: block;
        text-shadow: 1px 1px 1px #fff;
        min-width: 90px;
        padding: 0 3px 0 3px;
        border: 1px solid #fea3b2;
        text-align: center;
        line-height: 30px;}
        fieldset .line{border-bottom:1px solid #e5e5e5;padding-bottom:15px;}
        
        </style>


        <script type="text/javascript">


        jQuery(document).ready(function($){


        $(".toggle").click(function(){$(this).next().slideToggle('normal')});


        });


        </script>


        <form action="#" method="post" enctype="multipart/form-data" name="pure_form" id="pure_form" />


        <div class="wrap">


        <div id="icon-options-general" class="icon32"><br></div>


        <h2>WP-Gallery-LightBox设置页面</h2><br>


        <fieldset>

        <legend class="toggle">WP相册使用说明</legend>
            <div>
            <p>
            1.编辑文章或页面时选择左上角<strong>添加媒体</strong>-><strong>创建相册</strong>。<br>
            2.选择你喜欢的图像(多选)，后点击左下角<strong>创建新相册</strong>，进入相册设置页面。<br>
            3.在右上角设置相册尺寸，排序，并将<strong>链接到</strong>选项修改为<strong>媒体文件</strong>。<br>
            4.点击插入相册，即可在文章中加入相册短代码。<br>
            </p>
            </div>
        </fieldset>
        <fieldset>
        <legend class="toggle">设置</legend>


            <div>


                <table width="800" border="1" class="otakutable">

                <tr>
                    自定义相册缩略图CSS(不懂请留空)：
                    <textarea name ="customCss" style="width:100%;height:200px"><?php echo($options['customCss']); ?></textarea>
                </tr>
               
                <tr>
                    <td>是否由本插件引入JQuery库?(若点击缩略图无弹出框，请勾选) &nbsp;&nbsp;&nbsp;<label><input name="isJQuery" type="checkbox" value="checkbox" <?php if($options['isJQuery']) echo "checked='checked'"; ?> /> 我需要</label></td>
                </tr>


                

                </table>
                <input type="submit" name="wp_gallerylightbox_save" value="保存信息"  style="background:#ff8c83;color:#fff;border:none;cursor:pointer"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="wp_gallerylightbox_clear" value="清空记录"  style="background:#ff8c83;color:#fff;border:none;cursor:pointer"/>
            </div>
        </fieldset>
        </div>
        </form>
        <?php

        }
    

}

new WP_GalleryLightBox_Admin();
?>
