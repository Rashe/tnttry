$(document).ready(function(){
    console.log('Main javascript OK');

    $('.loginWrapper form a.regLink').hover( function(){
        $(this).text('Да хочу! Отрегестрируй меня полностью.')
    }, function(){
        $(this).text($(this).attr('placeholder'));
    });
});