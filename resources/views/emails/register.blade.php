<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<link
		href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
		rel="stylesheet">
	<title>Islamic Online Learning Centre</title>
</head>

<body style="padding: 0px; margin: 0px;font-family: 'Poppins', sans-serif; background-color:#eeeeee;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 50px 0px; ">
		<tbody>
			<tr>
				<td align="center">
					<table width="800" border="0" cellspacing="0" cellpadding="0" bgcolor="#eef8f7" style="box-shadow: 1px 1px 2px -1px; border-radius: 10px;">
						<tbody>
							<tr>
								<td align="center" bgcolor="#fff" style="">
									<table width="700" border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td width="700" valign=""></td>

											</tr>
										</tbody>
									</table>
								</td>
							</tr>

							<tr>
								<td>
									<table width="800" border="0" cellspacing="0" cellpadding="0" bgcolor="#0096FF" >
										<tbody>
											<tr>
												<td width="50"></td>
												<td width="600" align="left">
													<h2 data-edit="text" style="color: #fff; padding: 30px 0px 30px 0px; font-weight: 400; font-size: 35px; margin: 0; text-transform: capitalize; font-family: 'Poppins', sans-serif; line-height: 51px;">
														Welcome to Islamic Online Learning Centre</h2>
												</td>
												<td width="50"></td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>

							<tr>
								<td align="center" bgcolor="#fff">
									<table width="700" border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td width="700" valign="">
													<p style="font-size: 18px;color: #585858; padding-top:30px; font-weight: 300; font-family: 'Poppins', sans-serif;">
														Hi {{$user['name'] ?? ""}},</p>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center" bgcolor="#fff">
									<table width="700" border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td width="700" valign="">
													<p style="font-size: 18px;color: #585858; font-weight: 300; font-family: 'Poppins', sans-serif;">
														Thanks for creating an account on Islamic Online Learning Centre. Your Name is <strong>{{$user['name'] ?? ""}}.</strong> and email is {{ $user['email'] ?? ""}}You can access your account area to view orders, change your password, and more at:<a href="{{URL::to('/student/update_profile')}}" style="color:#0096FF">Change Profile</a>
													</p>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td align="center" bgcolor="#fff">
									<table width="700" border="0" cellspacing="0" cellpadding="0">
										<tbody>
											<tr>
												<td width="700" valign="">
													<p style="font-size: 18px;color: #585858; padding-bottom:30px;font-weight: 300; font-family: 'Poppins', sans-serif;">
														We look forward to seeing you soon.
													</p>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center">
					<table width="700" border="0" cellspacing="0" cellpadding="0">
						<tbody>
							<tr>
								<td width="700" align="center">
									<p style="font-size: 18px;color: #585858; margin-top:50px; font-weight: 300; font-family: 'Poppins', sans-serif;">
										Islamic Online Learning Centre<a href="#" style="color:#996699"></a> 
									</p>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>

</html>