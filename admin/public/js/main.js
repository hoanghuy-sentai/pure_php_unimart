$(document).ready(function () {

    /*update status order */
    $("#status_selection").change(function(){
    var status_selection=$(this).val();
    var url=$(this).attr('data-url');
    var id_cus_order=$(this).attr('data-id');

    var data = {status_selection:status_selection, url: url,id_cus_order:id_cus_order};
    $.ajax({
        url: url,
        method: 'GET',
        data: data,
        dataType: 'text',
        success: function (data) {
           
            // $("#sub_total_of_"+data.id).text(data.sub_total);
            // $("#total").text(data.total);
            alert(data);
            window.location.href = "?mod=home&controller=index&action=loginSuccess";
        }
    })
})
/* */
    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

//  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });
});