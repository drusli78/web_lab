$(document).ready(() => {
// проверка, что пользователь вошел в лк

    $('.btn-services').click(function (){
        let endpoint = 0;
        endpoint = check_end_point(endpoint);
        $.ajax({
            url: 'not_authorised_show_more',
            type: 'GET',
            dataType: 'html',
            data: {
                endpoint: endpoint
            },
            success: function (data) {
                $('#first_wrapper').append(data);
            }
        })
    })

    function check_end_point(min)
    {
        let overviews_list_items = document.querySelectorAll('.services_card')
        min = (Number)(overviews_list_items[0].dataset.id);
        for (let i = 1, len = overviews_list_items.length; i < len; i++) {
            if ((Number)(overviews_list_items[i].dataset.id) < (Number)(min))
                min = (Number)(overviews_list_items[i].dataset.id);
        }
        return min;
    }

//авторизация
    let btn = document.getElementById('modal-input-submit');

    $('#modal-input-submit-auth').click(function () {
        let tel = $('input[name="tel_auth"]').val().trim(),
            password_auth = $('input[name="password_auth"]').val().trim();
        let formData = new FormData();
        formData.append('tel_auth', tel);
        formData.append('password_auth', password_auth);
        $.ajax({
            url: 'authorisation',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success(data) {
                if (data['status']) {
                    window.location.href = '/authorised';
                } else {
                    $('#info-error2').text(data['message']);
                }
            }
        });
    })

    $('#modal-input-submit').click(function () {
        let name_reg = $('input[name="name_reg"]').val().trim(),
            email_reg = $('input[name="email_reg"]').val().trim(),
            tel_reg = $('input[name="tel_reg"]').val().trim(),
            password_reg = $('input[name="password_reg"]').val().trim(),
            password_confirm_reg = $('input[name="password_confirm_reg"]').val().trim(),
            flag = true;
        if (name_reg === '') {
            flag = false;
            $('#info-error').text('Введите имя');
        } else if (email_reg === '') {
            flag = false;
            $('#info-error').text('Введите email');
        } else if (tel_reg === '') {
            flag = false;
            $('#info-error').text('Введите телефон');
        } else if (password_reg === '') {
            flag = false;
            $('#info-error').text('Введите пароль');
        } else if (password_confirm_reg === '') {
            flag = false;
            $('#info-error').text('Подтвердите пароль');
        } else if (password_reg !== password_confirm_reg) {
            flag = false;
            $('#info-error').text('Пароли не совпадают');
        }
        if (flag === true) {
            let formData = new FormData();
            formData.append('name', name_reg);
            formData.append('email_reg', email_reg);
            formData.append('tel', tel_reg);
            formData.append('password_reg', password_reg);
            formData.append('password_confirm', password_confirm_reg);
            $.ajax({
                url: 'registration',
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success(data) {
                    if (data['status']) {
                        location.href = '/authorised';
                    } else {
                        $('#info-error').text(data['message']);
                    }
                }
            });
        }
    });

    const menu = document.querySelector('#mobile-menu');
    const menuLinks = document.querySelector('.nav-menu');


    menu.addEventListener('click', function () {
        menu.classList.toggle('is-active');
        menuLinks.classList.toggle('active');
    })

//Modal
    const modal = document.getElementById('email-modal');
    const openBtn = document.querySelector('.nav-links-btn');
    const openBtn1 = document.querySelector('.main-btn');
    const closeBtn = document.querySelector('.close-btn');

//Click events
    openBtn.addEventListener('click', () => {
        modal.style.display = 'block';
    });
    openBtn1.addEventListener('click', () => {
        modal.style.display = 'block';
    });
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });


    $("#password-confirm").on("keyup", function () { // Выполняем скрипт при изменении содержимого 2-го поля

        var valueX = $("#password").val();
        var valueY = $("#password-confirm").val();

        if (valueX != valueY) { // Условие, если поля не совпадают


            $("#passwordConfirmError1").html("Пароли не совпадают!"); // Выводим сообщение
            $("#modal-input-submit").attr("disabled", "disabled"); // Запрещаем отправку формы

        } else { // Условие, если поля совпадают

            $("#modal-input-submit").removeAttr("disabled");  // Разрешаем отправку формы
            $("#passwordConfirmError1").html(""); // Скрываем сообщение

        }

    });

//Modal
    const modal1 = document.getElementById('email-modal1');
    const openBtn4 = document.querySelector('.nav-links-btn2');
    const openBtn5 = document.querySelector('.modal-input-login');
    const closeBtn1 = document.querySelector('.close-btn1');

//Click events
    openBtn4.addEventListener('click', () => {
        modal1.style.display = 'block';
    });
    openBtn5.addEventListener('click', () => {
        modal1.style.display = 'block';
    });
    closeBtn1.addEventListener('click', () => {
        modal1.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal1) {
            modal1.style.display = 'none';
        }
    });


//Modal3
    const modal11 = document.getElementById('4email-modal');
    const openBtn11 = document.querySelector('.btn-services2');
    const closeBtn3 = document.querySelector('.close-btn3');

//Click events
    /*openBtn11.addEventListener('click',() => {
        modal11.style.display = 'block';
    });*/
    closeBtn3.addEventListener('click', () => {
        modal11.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal11) {
            modal11.style.display = 'none';
        }
    })


//form validation//
    const form = $('#new-form');
    const name = $('#name');
    const email = $('#email');
    const tel = $('#tel');
    const password = $('#password');
    const passwordConfirm = $('#password-confirm');

//show error message//
    function showError(input, message) {
        const formValidation = input.parentElement;
        formValidation.className = 'form-validation error';

        const errorMessage = formValidation.querySelector('p');
        errorMessage.innerText = message;
    }

//show valid message//
    function showValid(input) {
        const formValidation = input.parentElement;
        formValidation.className = 'form-validation valid';
    }


//check password//
    function passwordMatch(input1, input2) {
        if (input1.value !== input2.value) {
            showError(input2, 'Пароли не совпадают')
        }
    }

//get fieldname//
    function getFieldName(input) {
        return input.name.charAt(0).toUpperCase() + input.name.slice(1);
    }

//event Listener//
    form.submit(function (e) {
        e.preventDefault();
        passwordMatch(password, passwordConfirm);
    });


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
});







