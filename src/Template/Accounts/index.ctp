<?php
$urlToRestApi = $this->Url->build('/api/accounts', true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->scriptBlock('var csrfToken = '.json_encode($this->request->getParam('_csrfToken')).';', ['block' => true]);
?>
<script
    src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js">
</script>
<?php $this->Html->script('Accounts/index', ['block' => 'scriptBottom']); ?>

<div ng-app="app" ng-controller="AccountsController">
			<table>
				<tr>
					<td width="100">ID:</td>
					<td><input type="text" id="id" ng-model="account.id" /></td>
				</tr>
				<tr>
					<td width="100">Name:</td>
					<td><input type="text" id="name" ng-model="account.name" /></td>
				</tr>
                <tr>
					<td width="100">Description:</td>
					<td><input type="text" id="description" ng-model="account.description" /></td>
				</tr>
			</table>
			<br /> <br /> 
			<a ng-click="getAccount(account.id)">Get Account</a> 
			<a ng-click="updateAccount(account.id,account.name,account.description)">Update Account</a> 
			<a ng-click="addAccount(account.id,account.name,account.description)">Add Account</a> 
			<a ng-click="deleteAccount(account.id)">Delete Account</a>
 		<br /> <br />
		<p style="color: green">{{message}}</p>
		<p style="color: red">{{errorMessage}}</p>
 		<br />
		<br /> 
		<a ng-click="getAllAccounts()">Get all Accounts</a><br /> 
		<br /> <br />
		<div ng-repeat="account in accounts">
			{{account.name}} {{account.description}}
		</div>
</div>










