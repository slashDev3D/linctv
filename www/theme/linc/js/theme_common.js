// 전체 선택, 개별 선택 체크박스 이미지와 실제 체크박스 체크되도록
$(document).ready(function(){
    $(".all_chk label").click(function(){
        $(this).toggleClass("click_on");

        if($(this).hasClass("click_on")) {
            $(".li_chk input[type=checkbox]").prop('checked', true);
            $(".li_chk label").addClass("click_on");
        } else {
            $(".li_chk input[type=checkbox]").prop('checked', false);
            $(".li_chk label").removeClass("click_on");
        }
    });
    $(".li_chk label").click(function(){
        $(this).toggleClass("click_on");

        var is_all = 1;
        $(".li_chk label").each(function(){
            if(!$(this).hasClass("click_on")) {
                is_all = 0;
            }
        });

        if(is_all) {
            $(".all_chk label").addClass("click_on");
        } else {
            $(".all_chk label").removeClass("click_on");
        }
    });
});



$(function(){
settings = {

    objModalPopupBtn: ".modalButton",
    objModalCloseBtn: ".overlay, .closeBtn",
    objModalDataAttr: "data-popup"
}  
  $(settings.objModalPopupBtn).bind("click", function () {
        if ($(this).attr(settings.objModalDataAttr)) {
            var strDataPopupName = $(this).attr(settings.objModalDataAttr);

            $(".overlay, #" + strDataPopupName).fadeIn();
        }
    });


    $(settings.objModalCloseBtn).bind("click", function () {
        $(".modal").fadeOut();
    });
});

$(function(){
var schtabBtn = $("#sch-tab-btn > ul > li"); 
var schtabCont = $("#sch-tab-cont > div"); 


schtabCont.hide().eq(0).show();

schtabBtn.click(function(){
  var target = $(this);
  var index = target.index(); 
  schtabBtn.removeClass("active");
  target.addClass("active");
  schtabCont.css("display","none");
  schtabCont.eq(index).css("display", "block");
});
});





$(document).ready(function(){

$('.tv-keyword-dropdown').click(function () {
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.tv-keyword-dropdown-menu').slideToggle(300);
    });
    $('.tv-keyword-dropdown').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.tv-keyword-dropdown-menu').slideUp(300);
    });
    $('.tv-keyword-dropdown .tv-keyword-dropdown-menu li').click(function () {
        $(this).parents('.tv-keyword-dropdown').find('input').attr('value', $(this).attr('id'));
    });


$('.tv-keyword-dropdown-menu li').click(function () {
  var input = '' + $(this).parents('.tv-keyword-dropdown').find('input').val() + '';
  document.querySelector('.tvsch').value = input;
});
});




$(document).ready(function(){

$('.cont-keyword-dropdown').click(function () {
        $(this).attr('tabindex', 1).focus();
        $(this).toggleClass('active');
        $(this).find('.cont-keyword-dropdown-menu').slideToggle(300);
    });
    $('.cont-keyword-dropdown').focusout(function () {
        $(this).removeClass('active');
        $(this).find('.cont-keyword-dropdown-menu').slideUp(300);
    });
    $('.cont-keyword-dropdown .cont-keyword-dropdown-menu li').click(function () {
        //$(this).parents('.keyword-dropdown').find('span').text($(this).text());
        $(this).parents('.cont-keyword-dropdown').find('input').attr('value', $(this).attr('id'));
    });


$('.cont-keyword-dropdown-menu li').click(function () {
  var input = '' + $(this).parents('.cont-keyword-dropdown').find('input').val() + '';
  var schinput = document.getElementById("sch_stx");
  document.querySelector('.contsch').value = input;
});
});




$(document).ready(function(){

var schcontMenu = (function() {
 
    var $contitems = $( '#sch-contmenu > ul > li' ),
        $menuItems = $contitems.children( 'a' ),
        $body = $( 'body' ),
        current = -1;
 
    function init() {
        $menuItems.on( 'click', open );
        $contitems.on( 'click', function( event ) { event.stopPropagation(); } );
    }
 
    function open( event ) {
 
        if( current !== -1 ) {
            $contitems.eq( current ).removeClass( 'sch-contopen' );
        }
 
        var $item = $( event.currentTarget ).parent( 'li' ),
            idx = $item.index();
 
        if( current === idx ) {
            $item.removeClass( 'sch-contopen' );
            current = -1;
        }
        else {
            $item.addClass( 'sch-contopen' );
            current = idx;
            $body.off( 'click' ).on( 'click', close );
        }
 
        return false;
 
    }
 
    function close( event ) {
        $contitems.eq( current ).removeClass( 'sch-contopen' );
        current = -1;
    }
 
    return { init : init };
 
})();

$(function() {
       schcontMenu.init();
});
});



$(function(){
	$(".linc-video-button").modalVideo({
				youtube:{
					controls:1,
					autoplay:1,
					nocookie: true
				}
	});
});


$(function(){
	$(".linc-new-video-button").modalVideo({
				youtube:{
					controls:1,
					autoplay:1,
					nocookie: true
				}
	});
});




$(function() { // Dropdown toggle

	$('.dropdown-toggle-linc').click(function() { 
		$(this).next('.dropdown-linc').slideToggle();
	});

	$(document).click(function(e) 
	{ 
		var target = e.target; 
		if (!$(target).is('.dropdown-toggle-linc') && !$(target).parents().is('.dropdown-toggle-linc')) 
		//{ $('.dropdown').hide(); }
		  { $('.dropdown-linc').slideUp(); }
	});
});