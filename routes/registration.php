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

        $object = ["Status" => 200, "Comment" => "user was created successfully"];
        return json_encode($object);
    } else {
        $object = ["Status" => 500, "Comment" => "too short data"];
        return json_encode($object);
    }

});

?>
