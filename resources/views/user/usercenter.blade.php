
<!DOCTYPE html>
<html>
<head>
	<title>L53CMF-会员中心</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"></head>
<body>

	<div class="container">
		<h3 class="text-center">会员中心</h3>
		<table class="table table-striped">
			<tbody>
		        <tr>
		            <td width="80">用户名：</td>
		            <td>{{ $info->username }}</td>
		        </tr>
		        <tr>
		            <td>邮箱：</td>
		            <td>{{ $info->email }}</td>
		        </tr>
		        <tr>
		            <td>昵称：</td>
		            <td>{{ $info->nickname }}</td>
		        </tr>
		        <tr>
		            <td>电话：</td>
		            <td>{{ $info->phone }}</td>
		        </tr>
		        <tr>
		            <td>地址：</td>
		            <td>{{ $info->address }}</td>
		        </tr>
		        <tr>
		        	<td>操作：</td>
		        	<td><a href="/user/logout">退出登陆</a></td>
		        </tr>
	        </tbody>
		</table>
	</div>

</body>
</html>