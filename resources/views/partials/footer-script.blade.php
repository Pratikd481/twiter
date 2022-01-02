<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    function deleteListItem(route) {
        $.ajax({
            url: route,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                "_method": 'delete',
            },
            contentType: 'application/json',
            dataType: 'JSON',
            success: function(result) {
                window.location.href = result.redirect_route;
            },
            error: function(result) {
                alert('Some thing went wrong.');
            }
        });
    }

    function updateListItem(route, description, element) {

        let data = {
            "_method": 'put',
            'description': description
        };
        $.ajax({
            url: route,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: JSON.stringify(data),
            contentType: 'application/json',
            dataType: 'JSON',
            success: function(result) {
                window.location.href = result.redirect_route;
            },
            error: function(xhr, status, error) {
                if (setValidationError && typeof setValidationError === 'function') {
                    setValidationError(JSON.parse(xhr.responseText), element);
                }
            }
        });
    }
    $('.post-action .edit').click(function() {
        var route = $(this).data('route');
        $('.posts').each(function(index, element) {
            $(element).find('.description-div').show();
            $(element).find('.update-div').hide();
        });
        $(this).parents('.posts').find('.description-div').hide();
        $(this).parents('.posts').find('.update-div').show();
    });

    $('.post-action .delete').click(function() {
        var route = $(this).data('route');
        deleteListItem(route);
    });



    $('.publish-twit .publish-btn ').click(function() {
        $(this).prop('disabled', true);
        $(this).html('Publishing..');
        $(this).parents('form').submit();
    });
</script>
