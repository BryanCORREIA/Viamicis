$('.btn-switch').click(function() {
    const btn       = $(this);
    const box       = $('.box');
    const boxForm   = $('.box-form-security');
    const boxLogin  = $('.form-login');
    const boxSignin = $('.form-signin');

    if (boxLogin.hasClass('open')) {
        boxLogin.removeClass('open');
        boxForm.delay(100).queue(function(){
            $(this).removeClass('animated-expand-reverse').dequeue();
            $(this).addClass('expand').dequeue();
            box.addClass('box-large').dequeue();
        });
        btn.html('Se connecter');
        boxSignin.delay(500).queue(function(){
            $(this).addClass("open").dequeue();
        });
    }
    else if (boxSignin.hasClass('open')) {
        boxSignin.removeClass('open');
        boxForm.delay(100).queue(function(){
            $(this).removeClass('expand').dequeue();
            $(this).addClass('animated-expand-reverse').dequeue();
            box.removeClass('box-large').dequeue();
        });
        btn.html('S\'enregistrer');
        boxLogin.delay(500).queue(function(){
            $(this).addClass("open").dequeue();
        });
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const cleave_phone = new Cleave('.input-phone', {
        phone: true,
        phoneRegionCode: 'fr'
    });

    const cleave_date = new Cleave('.input-date-naiss', {
        date: true,
        delimiter: ' / ',
        datePattern: ['d', 'm', 'Y']
    });

    const cleave_cp = new Cleave('.input-cp', {
        blocks: [2, 3],
        numericOnly: true
    });
});
