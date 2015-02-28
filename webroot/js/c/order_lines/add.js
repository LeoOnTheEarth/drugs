$(function () {
    $('input#OrderLineNote').autocomplete({
        source: baseUrl + 'api/drugs/auto',
        select: function (event, ui) {
            event.preventDefault();
            $(this).val(ui.item.name);
            $('input#OrderLineModel').val('Drug');
            $('input#OrderLineForeignKey').val(ui.item.value);
        }
    });
});