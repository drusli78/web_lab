let ta = document.querySelector('textarea') // textarea
ta.addEventListener('input', onInput)
function onInput(evt) {
    let length = evt.target.value.length;
    document.getElementById("countSymbol").innerHTML = '('+ length + '/255 символов)';
}

let HeaderAdd = document.querySelector('.HeaderAdd') // textarea
HeaderAdd.addEventListener('input', onInputHeaderAdd)
function onInputHeaderAdd(evt) {
    let length = evt.target.value.length;
    document.getElementById("countSymbolHeader").innerHTML = '('+ length + '/70 символов)';
}
$('#post_photo').change(function () {
    var input = $(this)[0];
    if (input.files && input.files[0]) {
        if (input.files[0].type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            console.log('ошибка, не изображение');
        }
    } else {
        console.log('Возникли проблемы');
    }
});

$('#reset-img-preview').click(function () {
    $('#post_photo').val('');
    $('#img-preview').attr('src', 'default-preview.jpg');
});

$('#form').bind('reset', function () {
    $('#img-preview').attr('src', 'default-preview.jpg');
});