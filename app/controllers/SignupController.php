<?php

class SignupController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
       echo '<p> Signup </p>';
     #  exit;
    }
    public function registerAction() 
    { $user = new Users();
        // Stocke et vérifie les erreurs 
        $success = $user->save( $this->request->getPost(), [ "name", "email", ] );

        if ($success) 
        { 
            echo "Thanks for registering!"; 
        } 
          else 
           { echo "Sorry, the following problems were generated: ";

           $messages = $user->getMessages();
            foreach ($messages as $message) 
            
               { echo $message->getMessage(), "<br/>";
         }
        
        }
        
        $this->view->disable();
        }
        

}

