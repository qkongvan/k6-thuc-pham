/* placeholder */
$.fn.placeholder=function(){function a(a){return $(a).val()==$(a).attr("placeholder")}return this.each(function(){$(this).find(":input").each(function(){if($(this).attr("type")=="password"){var b=$('<input type="text">');b.attr("rel",$(this).attr("id"));b.attr("value",$(this).attr("placeholder"));$(this).parent().append(b);b.hide();function c(b){if($(b).val()==""||a(b)){$(b).hide();$("input[rel="+$(b).attr("id")+"]").show()}}b.focus(function(){$(this).hide();$("input#"+$(this).attr("rel")).show().focus()});$(this).blur(function(){c(this,false)});c(this)}else{function d(b,c){if($(b).val()==""||c&&a(b)){$(b).val($(b).attr("placeholder"))}}$(this).focus(function(){if($(this).val()==$(this).attr("placeholder")){$(this).val("")}});$(this).blur(function(){d($(this),false)});d(this,true)}});$(this).submit(function(){$(this).find(":input").each(function(){if($(this).val()==$(this).attr("placeholder")){$(this).val("")}})})})};

/* equalHeights */
$.fn.equalHeights=function(){tallest=0;$(this).css('height', 'auto').each(function(){thisHeight=$(this).height();if(thisHeight>tallest){tallest=thisHeight}});$(this).height(tallest)};

/* simpleImgSlider */
$.fn.simpleImgSlider = function(){
    var control = '<div class="control"><span rel="prev">&lt;</span><span rel="next">&gt;</span></div>';
    $(this).each(function(){
        var allImg = $(this).children('img');
        allImg.hide();
        if (allImg.length > 1){
            $(this).append(control);
        }
        $(this).find('img:first').show();
        var next = $(this).find('span[rel="next"]');
        var prev = $(this).find('span[rel="prev"]');
        var index = 1;
        next.parent().attr('data-imageslider-index', index);
        next.bind('click', function(){
            index = $(this).parent().attr('data-imageslider-index');
            if (index < allImg.length){
                index = parseInt(index) + 1;
                $(this).parent().attr('data-imageslider-index', index);
                slider(index);
            }
        });
        prev.bind('click', function(){
            index = $(this).parent().attr('data-imageslider-index');
            if (index > 1){
                index = parseInt(index) - 1;
                $(this).parent().attr('data-imageslider-index', index);
                slider(index);
            }
        });
        function slider(index){
            allImg.hide().each(function(e){
                if (e + 1 == index){
                    $(this).fadeIn();
                }
            });
        }
    });
};