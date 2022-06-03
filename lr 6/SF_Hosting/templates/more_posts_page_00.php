<?php
/* @var array $params */
foreach ($params as $post) {
    ?>
<div data-id="<?=$post['id_post']?>" class="services_card">
    <h2><?=$post['name']?></h2>
    <p><?=$post['date_added']?></p>
    <div class="services_btn">
        <button data-id="<?=$post['id_post']?>"  class="detail_page_button">
            Показать
        </button>
    </div>
</div>
<?php
}
?>
<script>
    $('.detail_page_button').click(function () {
        let id_post = ($(this).attr('data-id'));
        let url = 'detail_page?id_post=' + (String)(id_post);
        $.ajax({
            url: 'detail_page',
            type: 'GET',
            data: {
                id_post: id_post
            },
            success(data) {
                location.href = url;
            }
        })
    });
</script>
