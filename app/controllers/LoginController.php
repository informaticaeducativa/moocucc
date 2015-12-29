<?php

class LoginController extends BaseController 
{



/**
 * Login user with facebook
 *
 * @return void
 */
public function loginWithFacebook() {

    // get data from input
    $code = Input::get( 'code' );

    // get fb service
    $fb = OAuth::consumer( 'Facebook' );

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from facebook, get the token
        $token = $fb->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $fb->request( '/me' ), true );

        $message = 'Tu ID de usuario de facebook es: ' . $result['id'] . ' y tu nombre es ' . $result['name'];
        echo $message. "<br/>";

		$count = Usuario::where('id_social', '=', $result['id'])->where('red_social', '=', 'Facebook')->count();
		if ($count == 0){
			$respuestas = Usuario::create(array('nombre' => $result['name'], 'id_social' => $result["id"], 'red_social' => 'Facebook',
			'tipo_usuario' => 'Estudiante', 'fecha' => date('Y-m-d H:i:s')
			));
		}
		
        $user = Usuario::where('id_social', '=', $result['id'])->first();
			Session::put('user_id', $user->id);
			Session::put('user', $user->nombre);
			Session::put('inteligencia', $user->tipo_inteligencia);
			
		if($user->tipo_usuario == "Administrador")
			return Redirect::to("administrador");
		else if($user->tipo_usuario == "Profesor Basico")
			return Redirect::to( "profesor-base-cursos" );
		else
			return Redirect::to( "index" );
    }
    // if not ask for permission first
    else {
        // get fb authorization
        $url = $fb->getAuthorizationUri();

        // return to facebook login url
         return Redirect::to( (string)$url );
    }

}


public function loginWithGoogle() {

    // get data from input
    $code = Input::get( 'code' );

    // get google service
    $googleService = OAuth::consumer( 'Google' );

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from google, get the token
        $token = $googleService->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

        $message = 'Tu ID de Google es: ' . $result['id'] . ' y tu nombre es ' . $result['name'];
        echo $message. "<br/>";
		
		$count = Usuario::where('id_social', '=', $result['id'])->where('red_social', '=', 'Google')->count();
		if ($count == 0){
			$respuestas = Usuario::create(array('nombre' => $result['name'], 'id_social' => $result["id"],  'red_social' => 'Google',
			'foto' => $result["picture"], 'tipo_usuario' => 'Estudiante', 'fecha' => date('Y-m-d H:i:s')
			));
		}
		
		$user = Usuario::where('id_social', '=', $result['id'])->first();
			Session::put('user_id', $user->id);
			Session::put('user', $user->nombre);
			Session::put('inteligencia', $user->tipo_inteligencia);
			
		if($user->tipo_usuario == "Administrador")
			return Redirect::to("administrador");
		else if($user->tipo_usuario == "Profesor Basico")
			return Redirect::to( "profesor-base-cursos" );
		else
			return Redirect::to( "index" );
    }
    // if not ask for permission first
    else {
        // get googleService authorization
        $url = $googleService->getAuthorizationUri();

        // return to google login url
        return Redirect::to( (string)$url );
    }
}



public function loginWithTwitter() {

    // get data from input
    $token = Input::get( 'oauth_token' );
    $verify = Input::get( 'oauth_verifier' );

    // get twitter service
    $tw = OAuth::consumer( 'Twitter' );

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $token ) && !empty( $verify ) ) {

        // This was a callback request from twitter, get the token
        $token = $tw->requestAccessToken( $token, $verify );

        // Send a request with it
        $result = json_decode( $tw->request( 'account/verify_credentials.json' ), true );

        $message = 'Tu ID de Twitter es: ' . $result['id'] . ' y tu nombre es ' . $result['name'];
        echo $message. "<br/>";

		
        $count = Usuario::where('id_social', '=', $result['id'])->where('red_social', '=', 'Twitter')->count();
		if ($count == 0){
			$respuestas = Usuario::create(array('nombre' => $result['name'], 'id_social' => $result["id"],  'red_social' => 'Twitter',
			'foto' => str_replace("_normal", "", $result["profile_image_url"]) ,'tipo_usuario' => 'Estudiante', 'fecha' => date('Y-m-d H:i:s')
			));
		}
        
        $user = Usuario::where('id_social', '=', $result['id'])->first();
			Session::put('user_id', $user->id);
			Session::put('user', $user->nombre);
			Session::put('inteligencia', $user->tipo_inteligencia);
			
		if($user->tipo_usuario == "Administrador")
			return Redirect::to("administrador");
		else if($user->tipo_usuario == "Profesor Basico")
			return Redirect::to( "profesor-base-cursos" );
		else
			return Redirect::to( "index" );

    }
    // if not ask for permission first
    else {
        // get request token
        $reqToken = $tw->requestRequestToken();

        // get Authorization Uri sending the request token
        $url = $tw->getAuthorizationUri(array('oauth_token' => $reqToken->getRequestToken()));

        // return to twitter login url
        return Redirect::to( (string)$url );
    }
}


}
