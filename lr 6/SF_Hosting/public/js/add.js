$(document).ready(() => {

    let file = null;

    $('#add_form').submit(function (e){
        e.preventDefault();
        if(file != null) {
            let name = $('#name_add').val();
            let desc = $('#text_add').val();
            let formData = new FormData();
            formData.append('file', file);
            formData.append('name', name);
            formData.append('description', desc);
            $.ajax({
                url: 'user_add_post',
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success(data) {
                    if (data['status']) {
                        location.href = '/';
                    }
                }
            });
        }
    })

    $('#file_add').change(function (e) {
        file = e.target.files[0];
    })
});