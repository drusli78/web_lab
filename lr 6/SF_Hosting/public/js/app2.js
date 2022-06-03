//Modal3

function check_end_point(min)
{
    let overviews_list_items = document.querySelectorAll('.services1_card')
    min = (Number)(overviews_list_items[0].dataset.id);
    for (let i = 1, len = overviews_list_items.length; i < len; i++) {
        if ((Number)(overviews_list_items[i].dataset.id) < (Number)(min))
            min = (Number)(overviews_list_items[i].dataset.id);
    }
    return min;
}


$('.btn-services1').click(function (){
    let endpoint = 0;
    endpoint = check_end_point(endpoint);
    $.ajax({
        url: 'authorised_show_more',
        type: 'GET',
        dataType: 'html',
        data: {
            endpoint: endpoint
        },
        success: function (data) {
            $('#second_wrapper').append(data);
        }
    })
})

$('#exit_account_button').click(function (){
    $.ajax({
        url: 'exitUser',
        dataType: 'json',
        success: function (data) {
            if (data['status'] == null) {
                location.href = '/';
            }
        }
    });
});

$('.detail_page_button').click(function (){

    let id_post = ($(this).attr('data-id'));
    let url = 'detail_page?id_post=' + (String)(id_post);
    $.ajax({
        url: 'detail_page',
        type: 'GET',
        data:{
            id_post: id_post
        },
        success(data){
            location.href = url;
        }
    })
});

$('.main-btn1').click(function (){
    let url = ($(this).attr('data-url'));
    window.location.href = url;
})

