<?php

$app->post('/api/v1/registration', function ($request, $response, $args){
    $params = $request->getParsedBody();

	$nick = $params['nick'];
	$email = $params['email'];
	$password = $params['password'];

    if(strlen($nick) > 2 && strlen($email) > 5 && strlen($password) == 64){
        $newUser = R::dispense('users');

        $newUser->nick = $nick;
        $newUser->email = $email;
        $newUser->password = $password;
        $newUser->is_admin = 0;

        R::store($newUser);

        return json_encode(["Status" => 200, "Comment" => "user was created successfully"]);
    } else {
        return json_encode("too short data");
    }

});

?>
