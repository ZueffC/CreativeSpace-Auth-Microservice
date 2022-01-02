<?php

$app->post('/api/v1/login', function ($request, $response, $args) { //POST example
	$params = $request->getParsedBody();

	$nick = $params['nick'];
	$email = $params['email'];
	$password = $params['password'];

	if(strlen($nick) > 2 && strlen($email) > 5 && strlen($password) == 64){
		$user  = R::findOne('users', 'nick = ? AND email  = ? AND password = ?', [
			$nick, 
			[$email, PDO::PARAM_STR],
			[$password, PDO::PARAM_STR]
		]);

		if ($user){
			return json_encode($user);
		} else {
			return json_encode("404 User not found :(");
		}
	} else {
		return json_encode("too short data");
	}
});

?>
