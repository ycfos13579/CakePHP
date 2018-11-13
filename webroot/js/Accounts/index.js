function getAccounts() {
    $.ajax({
        type: 'GET',
        url: urlToRestApi,
        dataType: "json",
        success:
                function (accounts) {
                    var accountTable = $('#accountData');
                    accountTable.empty();
                    var count = 1;
                    $.each(accounts.data, function (key, value)
                    {
                        var editDeleteButtons = '</td><td>' +
                                '<a href="javascript:void(0);" class="glyphicon glyphicon-edit" onclick="editAccount(' + value.id + ')"></a>' +
                                '<a href="javascript:void(0);" class="glyphicon glyphicon-trash" onclick="return confirm(\'Are you sure to delete data?\') ? accountAction(\'delete\', ' + value.id + ') : false;"></a>' +
                                '</td></tr>';
                        accountTable.append('<tr><td>' + count + '</td><td>' + value.name + '</td><td>' + value.description + editDeleteButtons);
                        count++;
                    });

                }
    });
}

/* Function takes a jquery form
 and converts it to a JSON dictionary */
function convertFormToJSON(form) {
    var array = $(form).serializeArray();
    var json = {};

    $.each(array, function () {
        json[this.name] = this.value || '';
    });

    return json;
}

/*
 $('#accountAddForm').submit(function (e) {
 e.preventDefault();
 var data = convertFormToJSON($(this));
 alert(data);
 console.log(data);
 });
 */

function accountAction(type, id) {
    id = (typeof id == "undefined") ? '' : id;
    var statusArr = {add: "added", edit: "updated", delete: "deleted"};
    var requestType = '';
    var accountData = '';
    var ajaxUrl = urlToRestApi;
    if (type == 'add') {
        requestType = 'POST';
        accountData = convertFormToJSON($("#addForm").find('.form'));
    } else if (type == 'edit') {
        requestType = 'PUT';
        accountData = convertFormToJSON($("#editForm").find('.form'));
        ajaxUrl = ajaxUrl + "/" + $('#idEdit').val();
    } else {
        requestType = 'DELETE';
        ajaxUrl = ajaxUrl + "/" + id;
    }
    $.ajax({
        type: requestType,
        url: ajaxUrl,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify(accountData),
        success: function (msg) {
            if (msg) {
                alert('Account data has been ' + statusArr[type] + ' successfully.');
                getAccounts();
                $('.form')[0].reset();
                $('.formData').slideUp();
            } else {
                alert('Some problem occurred, please try again.');
            }
        }
    });
}

/*** à déboguer ... ***/
function editAccount(id) {
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: urlToRestApi+ "/" + id,
        success: function (data) {
            $('#idEdit').val(data.data.id);
            $('#nameEdit').val(data.data.name);
            $('#descriptionEdit').val(data.data.description);
            $('#editForm').slideDown();
        }
    });
}