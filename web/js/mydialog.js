$(function(){
        
    $(document.body).on("click",'.mydialog-trigger',function(){
        var dwin=$($(this).attr("data-mydialog-target"));
        var css={
            cursor:"default",
            border:"0px solid #fff",
            width:dwin.outerWidth(),
            height:dwin.outerHeight(),
            top:'50%',
            left:'50%',
            "margin-top":dwin.outerHeight()/-2,
            "margin-left":dwin.outerWidth()/-2
        };
        var overLayCss={
            'opacity':0.1
        };
        $.blockUI({
            message:dwin,
            css:css,
            overlayCSS:overLayCss
        });
    });
    
    $(document.body).on("click",'.unblockui-trigger,.mydialog-close',function(){
        $.unblockUI();
    });
    
});