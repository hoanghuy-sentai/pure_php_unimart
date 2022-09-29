$(document).ready(function () {

 /*validate action of user when using searching box*/
 $("#sm-s").click(function () {
    var s = $("#s").val();
    if (s.length <= 3) {
        // alert("Ok");
        $("#sm-s").attr("type", "button");
        $("#sm-s").removeAttr("typle", "submit");
    }
    else {
        $("#sm-s").attr("type", "submit");
    }
})
var el = document.getElementById("s");
    el.addEventListener("keypress", function (event) {
        if (event.key === "Enter") {
            // alert(event.key  + " " + event.which);
            // event.preventDefault();
            var s = $("#s").val();
            if (s.length <= 3) {
                // alert("Ok");
                $("#sm-s").attr("type", "button");
                $("#sm-s").removeAttr("typle", "submit");
                event.preventDefault();
            }
            else {
                $("#sm-s").attr("type", "submit");
            }
        }
    });
 /**/
 /*stop */
 $("#filter").click(function(){
    $name=$("select").val();
    if($name==0)
    {
        return false;//stop
    }
 })
 
 /**/   
/*update cart section */
$(".num-order").change(function(){
    var qty = $(this).val();
    var price=$(this).attr("data-price");
    var id=$(this).attr("data-id");//từ trong đối tượng $(this) lấy ra thuộc tính của nó
    var url = $(this).attr("data-url");
    var data = {  qty: qty, url: url,id:id,price:price};
    $.ajax({
        url: url,
        method: 'GET',
        data: data,
        dataType: 'json',
        success: function (data) {
            // $("#result").html("<strong>Năm nay bạn "+data+" tuổi.</strong>");
            // console.log(data);
            // $(".num-order").text(data.qty);
            // $("#" + data.id).html(data.subtotal + "đ");
            // $(".total").html(data.total + " Đ");
            // alert(data['id']);
            $("#sub_total_of_"+data.id).text(data.sub_total);
            $("#total").text(data.total);
        }
    })
})
/* */
/* qty in detail section */
$("#num-order-wp").click(function () {
    // alert(id);
    var qty = $("#num-order").attr('value');;
    var url = $("#num-order").attr("data_url");
    var data = {  qty: qty, url: url};
    $.ajax({
        url: url,
        method: 'GET',
        data: data,
        dataType: 'text',
        success: function (data) {
            // $("#result").html("<strong>Năm nay bạn "+data+" tuổi.</strong>");
            // console.log(data);
            // $(".num-order").text(data.qty);
            // $("#" + data.id).html(data.subtotal + "đ");
            // $(".total").html(data.total + " Đ");
            // alert(data);
        }
    })
})
/**/
//  SLIDER
    var slider = $('#slider-wp .section-detail');
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

//  ZOOM PRODUCT DETAIL
    $("#zoom").elevateZoom({gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});

//  LIST THUMB
    var list_thumb = $('#list-thumb');
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

//  FEATURE PRODUCT
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

//  SAME CATEGORY
    var same_category = $('#same-category-wp .list-item');
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

//  SCROLL TOP
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#btn-top').stop().fadeIn(150);
        } else {
            $('#btn-top').stop().fadeOut(150);
        }
    });
    $('#btn-top').click(function () {
        $('body,html').stop().animate({scrollTop: 0}, 800);
    });

// CHOOSE NUMBER ORDER
    var value = parseInt($('#num-order').attr('value'));
    $('#plus').click(function () {
        if(value>9)
        {
            alert("Tối đa 10 sản phẩm");
        }
        else{
            value++;
            $('#num-order').attr('value', value);
            update_href(value);
        }
    });
    $('#minus').click(function () {
        if (value > 1) {
            value--;
            $('#num-order').attr('value', value);
        }
        update_href(value);
    });

//  MAIN MENU
    // $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');
    $('#category-product-wp .list-item>.sub-menu > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');
    $('#category-product-wp .list-item>.sub-menu > li').find('.sub-menu:empty').next("i").remove();
    $('#category-product-wp .list-item>.sub-menu > li').find('.sub-menu:empty').remove();
//  TAB
    tab();

    //  EVEN MENU RESPON
    $('html').on('click', function (event) {
        var target = $(event.target);
        var site = $('#site');

        if (target.is('#btn-respon i')) {
            if (!site.hasClass('show-respon-menu')) {
                site.addClass('show-respon-menu');
            } else {
                site.removeClass('show-respon-menu');
            }
        } else {
            $('#container').click(function () {
                if (site.hasClass('show-respon-menu')) {
                    site.removeClass('show-respon-menu');
                    return false;
                }
            });
        }
    });

//  MENU RESPON
    $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
    $('#main-menu-respon li .arrow').click(function () {
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        } else {

//            $('.sub-menu').slideUp();
//            $('#main-menu-respon li').removeClass('open');
            $(this).parent('li').addClass('open');
//            $(this).parent('li').find('.sub-menu').slideDown();
        }
    });
});

function tab() {
    var tab_menu = $('#tab-menu li');
    tab_menu.stop().click(function () {
        $('#tab-menu li').removeClass('show');
        $(this).addClass('show');
        var id = $(this).find('a').attr('href');
        $('.tabItem').hide();
        $(id).show();
        return false;
    });
    $('#tab-menu li:first-child').addClass('show');
    $('.tabItem:first-child').show();
    /*section-detail*/
    var middle_outer_width_product_content = $(".product-content").outerWidth() / 2;
    var middle_outer_width_extend_content = $(".extend-content").outerWidth() / 2;
    var position_left = middle_outer_width_product_content - middle_outer_width_extend_content;
    $("a.extend-content").css('left', position_left);
    $("a.collapse-content").css('left', position_left);
    $('a.extend-content').click(function () {
        $(".product-content").addClass('max-height-none');
        $(".opacity").hide();
        $('a.extend-content').hide();
        $('a.collapse-content').show();
        return false;
    })
    $('a.collapse-content').click(function () {
        $(".product-content").removeClass('max-height-none');
        $(".opacity").show();
        $('a.extend-content').show();
        $('a.collapse-content').hide();
        return false;

    })
    /**/

    /*back button on browser*/
    window.addEventListener( "pageshow", function ( event ) {
        var historyTraversal = event.persisted || 
                               ( typeof window.performance != "undefined" && 
                                    window.performance.navigation.type === 2 );
        if ( historyTraversal ) {
          // Handle page restore.
        //   window.location.reload();
            // this.alert("OK");
            if($("#main-content-wp").hasClass("sig"))
            {
                window.location.href="?mod=client&controller=index&action=index";
            }
            if($("#card").hasClass("card"))
            {
                $("#card").remove();
                window.location.href="?mod=client&controller=index&action=index";
            }
            
        }
      });
    /**/
}
