$(document).ready(function () {
    // The path to action from CakePHP is in urlToLinkedListFilter 
    $('#province-id').on('change', function () {
        var provinceId = $(this).val();
        if (provinceId) {
            $.ajax({
                url: urlToLinkedListFilter,
                data: 'province_id=' + provinceId,
                success: function (cities) {
                    $select = $('#city-id');
                    $select.find('option').remove();
                    $.each(cities, function (key, value)
                    {
                        $.each(value, function (childKey, childValue) {
                            $select.append('<option value=' + childValue.id + '>' + childValue.name + '</option>');
                        });
                    });
                }
            });
        } else {
            $('#city-id').html('<option value="">Select Province first</option>');
        }
    });
});


