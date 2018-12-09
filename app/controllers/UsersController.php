<?php

use Phalcon\Paginator\Adapter\Model as PaginatorModel; 
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray; 
use Phalcon\Paginator\Adapter\QueryBuilder as PaginatorQueryBuilder;

class UsersController extends \Phalcon\Mvc\Controller
{

    
    public function indexAction($page=0)
    {
        $users = Users::find();
        // Create a Model paginator, show 10 rows by page starting from 
        $currentPage = $page;
        $paginator = new PaginatorModel( [ "data" => $users, "limit" => 10, "page" => $currentPage, ] );
       // Get the paginated results 
        $page = $paginator->getPaginate();
        $page->total_pages = count($users);
        $this->view->page = $page;
    }

    public function pagesAction($page=0){
        $users = Users::find();
        // Create a Model paginator, show 10 rows by page starting from 
        $currentPage = $page;
        $paginator = new PaginatorModel( [ "data" => $users, "limit" => 10, "page" => $currentPage, ] );
       // Get the paginated results 
        $page = $paginator->getPaginate();
        $page->total_pages = count($users);
        $this->view->page = $page;
    }
    
    
    /** * Execute the "search" based on the criteria sent from the "index" * Returning a paginator for the results */
   
    public function searchAction() 
    {


        # $users = Users::find("email = '$e'"); 
        
        /*
        $users = Users::findFirst();


        if (count($users)>0){
            echo "There are ", count($users), "\n";
            echo "<br/>";
            foreach($users as $user){
                echo "Name:", $user->name, "\n";
                echo "<br/>";
                echo "Name:", $user->email, "\n";

            }
           
        }else{
            echo "There are not user with this email ", "\n";
        }
     */
        
       
    }

    /** * Shows the view to create a "new" product */ 

    public function newAction() 
    {

    }
   
    /** * Shows the view to "edit" an existing product */ 

       
    /**
     * Edits a blog
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $user = Users::findFirstById($id);
            if (!$user) {
                $this->flash->error("User was not found");

                $this->dispatcher->forward([
                    'controller' => "users",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("name", $user->name);
            $this->tag->setDefault("email", $user->email);
            
        }
    }

    /**
     * Saves a blog edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $user = Users::findFirst($id);

        if (!$user) {
            $this->flash->error("User does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);

            return;
        }

        $user->name = $this->request->getPost("name");
        $user->email = $this->request->getPost("email");
       
        

        if (!$user->save()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'edit',
                'params' => [$user->id]
            ]);

            return;
        }

        $this->flash->success("user was updated successfully");

        $this->dispatcher->forward([
            'controller' => "users",
            'action' => 'index'
        ]);
    }



    /** * Creates a product based on the data entered in the "new" action */ 
    public function createAction()
     { 

     }
    
     /** * Deletes an existing product */
     /**
     * Deletes a blog
     *
     * @param string $BlogID
     */
    public function deleteAction($id)
    {
        $user = Users::findFirst($id);

        if (!$user) {
            $this->flash->error("user was not found");

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'index'
            ]);

            return;
        }
       
        if (!$user->delete()) {

            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("user was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "users",
            'action' => "index"
        ]);
    }




}

