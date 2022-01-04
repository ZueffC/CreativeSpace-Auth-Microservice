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
			$object = ["Status" => 200, "Comment" => "user exist", "Id" => $user->id, "Nick" => $user->nick];
			return json_encode($object);
		} else {
			$object = ["Status" => 403, "Comment" => "user not exist"];
			return json_encode($object);
		}
	} else {
		$object = ["Status" => 500, "Comment" => "user not exist"];
		return json_encode($object);
	}
});

?>
