$(function(){

    //theme
    var myBody = $('body');
    var currentTheme = myBody.attr('data-theme');
    if (currentTheme != 'none'){
        myBody.addClass(currentTheme);
    } else {
		myBody.addClass('green');
	}
    /*$('#nav').find('a').each(function(){
        var newTheme = $(this).attr('data-theme');
        $(this).hover(
            function(){ myBody.removeClass(currentTheme).addClass(newTheme); },
            function(){ myBody.removeClass(newTheme).addClass(currentTheme); }
        );
    });*/
    myBody.removeClass(currentTheme).addClass( $('#nav').find('ul li.current a').attr('data-theme') );

    //placeholder
    myBody.placeholder();

    //sections
    $('#sections').find('section').equalHeights();
    $(window).resize(function(){
        $('#sections').find('section').equalHeights();
    });

    //today's selection
    $('.todays-selection').find('li:even').addClass('even');

    //image-slider
    $('.image-slider').simpleImgSlider();

});