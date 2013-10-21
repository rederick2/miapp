<?php
/**
 * class FacebookController
 * @author Igor Ivanović
 * Used to controll facebook login system 
 */
class FacebookController extends Controller
{

    /**
     * This method authenticate logged in facebook user 
     * @param type $id string(int)
     * @param type $name string
     * @param type $surname string
     * @param type $username string
     * @param type $email string
     * @param type $session string
     */
    public function actionLogin( $id = null , $name = null , $surname = null,$username = null, $email = 'rederick2@hotmail.com', $session = null, $token = null )
    {
        if( !Yii::app()->request->isAjaxRequest )
        {
            echo json_encode(array('error'=>'this is not ajax request'));
            die();
        } 
        else 
        {
            if( empty($email) )
            {
                echo json_encode(array('error'=>'email is not provided'));
                die();
            }
            if( $session == Yii::app()->session->sessionID )
            {
            
                $user = User::prepareUserForAuthorisation( $email );

                $fb=Yii::app()->facebook;
                //$token=$fb->getAccessToken();
                $fb->setAccessToken($token);

                $picture = $fb->getProfilePicture('large');
                
                if( $user === null ) 
                {
                    $user                   = new User();
                    $user->e_mail           = $email;    
                    $user->first_name       = $name;
                    $user->last_name        = $surname;
                    $user->username         = $username;
                    $user->password         = $user->createRandomUsername();
                    $user->facebook_account   = 1;
                    $user->token            = $token;
                    $user->picture          = $picture;
                    $user->insert();
                }else{
                    $user->token            = $token;
                    //$user->picture          = $picture;
                    $user->update();
                }
                
                $identity = new UserIdentity( $user->e_mail , '' );
                $identity->authenticate();

               

                /*$fql_obj = $fb->api('/me?fields=id,name,friends');
                    
                print_r($fql_obj);*/

  
                if($identity->errorCode === UserIdentity::ERROR_NONE) 
                {
                       Yii::app()->user->login($identity, NULL);
                       echo json_encode( array( 'error'=>0, 'redirect'=> $this->createUrl('./') ) );
                } 
                else 
                {
                       echo json_encode(array('error'=>'user not logged in'));
                       die();
                }
            }
            else
            {
                echo json_encode(array('error'=>'session id is not the same'));
                die();
            }
        }
    }
    
    
   
 
}