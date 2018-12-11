/*function getAccounts() {
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

 Function takes a jquery form
 and converts it to a JSON dictionary 
function convertFormToJSON(form) {
    var array = $(form).serializeArray();
    var json = {};

    $.each(array, function () {
        json[this.name] = this.value || '';
    });

    return json;
}


 $('#accountAddForm').submit(function (e) {
 e.preventDefault();
 var data = convertFormToJSON($(this));
 alert(data);
 console.log(data);
 });
 

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
/*function editAccount(id) {
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
}*/

var app = angular.module('app',[]);
 app.controller('AccountsController', ['$scope','AccountService', function ($scope,AccountService) {
	  
    $scope.updateAccount = function () {
        AccountService.updateAccount($scope.account.id, $scope.account.name, $scope.account.description)
          .then(function success(response){
              $scope.message = 'Account data updated!';
              $scope.errorMessage = '';
              $scope.getAllAccounts();
          },
          function error(response){
              $scope.errorMessage = 'Error updating account!';
              $scope.message = '';
          });
    }
    
    $scope.getAccount = function () {
        var id = $scope.account.id;
        AccountService.getAccount($scope.account.id)
          .then(function success(response){
              $scope.account = response.data.data;
              $scope.account.id = id;
              $scope.message='';
              $scope.errorMessage = '';
          },
          function error (response ){
              $scope.message = '';
              if (response.status === 404){
                  $scope.errorMessage = 'Account not found!';
              }
              else {
                  $scope.errorMessage = "Error getting account!";
              }
          });
    }
    
    $scope.addAccount = function () {
        if ($scope.account != null && $scope.account.name) {
            AccountService.addAccount($scope.account.name,$scope.account.description)
              .then (function success(response){
                  $scope.message = 'Account added!';
                  $scope.errorMessage = '';
              },
              function error(response){
                  $scope.errorMessage = 'Error adding account!';
                  $scope.message = '';
            });
        }
        else {
            $scope.errorMessage = 'Please enter a name!';
            $scope.message = '';
        }
    }
    
    $scope.deleteAccount = function () {
        AccountService.deleteAccount($scope.account.id)
          .then (function success(response){
              $scope.message = 'Account deleted!';
              $scope.account = null;
              $scope.errorMessage='';
          },
          function error(response){
              $scope.errorMessage = 'Error deleting account!';
              $scope.message='';
          })
    }
    
    $scope.getAllAccounts = function () {
        AccountService.getAllAccounts()
          .then(function success(response){
              $scope.accounts = response.data.data;
             // $scope.message='';
              $scope.errorMessage = '';
          },
          function error (response ){
              $scope.message='';
              $scope.errorMessage = 'Error getting accounts!';
          });
    }
 }]);
 app.service('AccountService',['$http', function ($http) {
	
    this.getAccount = function getAccount(accountId){
        return $http({
          method: 'GET',
          url: 'api/accounts/'+accountId,
          headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}
        });
	}
	
    this.addAccount = function addAccount(name, description){
        return $http({
          method: 'POST',
          url: 'api/accounts',
          data: {name:name, description:description},
          headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}
        });
    }
	
    this.deleteAccount = function deleteAccount(id){
        return $http({
          method: 'DELETE',
          url: 'api/accounts/'+id,
          headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}
        })
    }
	
    this.updateAccount = function updateAccount(id,name,description){
        return $http({
          method: 'PUT',
          url: 'api/accounts/'+id,
          data: {name:name, description:description},
          headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}

        })
    }
	
    this.getAllAccounts = function getAllAccounts(){
        return $http({
          method: 'GET',
          url: 'api/accounts',
          headers: { 'X-Requested-With' : 'XMLHttpRequest', 'Accept' : 'application/json'}
        });
    }
 }]); 