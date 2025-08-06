$('select.dropdown').dropdown();
$('select.dropdown1').dropdown();
$('select.dropdown2').dropdown();
$('select.dropdown3').dropdown();
$('select.dropdown4').dropdown();
$('select.dropdown5').dropdown();
$('select.dropdown_category').dropdown();

$(document).ready(function () {
    $("#giveDate").datepicker(
        {
            dateFormat: "mm/dd/yy"
        }
    );
    $("#start_date").datepicker(
        {
            dateFormat: "mm/dd/yy"
        }
    );
    $("#end_date").datepicker(
        {
            dateFormat: "mm/dd/yy"
        }
    );
    $("#date").datepicker(
        {
            dateFormat: "mm/dd/yy"
        }
    );

    $('form').submit(function () {
        var submitButton = $('button[type="submit"]');
        submitButton.prop('disabled', true);
        submitButton.addClass('loading');

        setTimeout(function () {
            submitButton.prop('disabled', false);
            submitButton.removeClass('loading');
        }, 3000);
    });
});

for(var itemCount=1; itemCount<=50; itemCount++){
    $('#category_' + itemCount).dropdown();
    $('#equipment_type_' + itemCount).dropdown();
}
