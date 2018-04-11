/**
 * Created by lucace.w on 2017/5/25.
 */
jQuery(document).ready(function () {
    // 点击显示／隐藏     查看流程
    $("#btn_hide_flow").click(function () {
        $("#flow").fadeOut();
        return false;
    });
    $("#btn_show_flow").click(function () {
        $("#flow").fadeIn();
        return false;
    });
    $("#btn_show_flow2").click(function () {
        $("#flow").fadeIn();
        return false;
    });

    // 点击显示／隐藏     使用说明
    $("#btn_hide_desc").click(function () {
        $("#main_describe").fadeOut();
        return false;
    });
    $("#use_describe").click(function () {
        $("#main_describe").fadeIn();
        return false;
    });
    // 点击显示／隐藏     裸聊表格
    $(".vip_content2").click(function () {
       $(".plug-luoliao").fadeIn();
       return false;
    });
    $(".plug-luoliao").click(function () {
        $(".plug-luoliao").fadeOut();
    });

    // 点击查看／隐藏      联系客服
    $("#btn_cs").click(function () {
        $("#content_cs").fadeIn();
        return false;
    });
    $("#btn_hide_cs").click(function () {
        $("#content_cs").fadeOut();
        return false;
    });
    // 点击滚动到注册表单
    $("#btnRegister").click(function () {
        $(document.body).animate({scrollTop:$(".register_box").offset().top},1000);
        return false;
    });
    $("#btn_banner").click(function () {
        $(document.body).animate({scrollTop:$(".register_box").offset().top},1000);
        return false;
    });

    // 如果滚动条到顶部的垂直高度大于0，元素显示
    $(window).scroll(function(){
        if ($(window).scrollTop() > 0) {
            $(".top_bar").fadeIn();
        } else {
            $(".top_bar").fadeOut();
        }
    });
});

