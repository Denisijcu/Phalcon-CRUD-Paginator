<?php

class ProductsController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }
    
    
    /** * Execute the "search" based on the criteria sent from the "index" * Returning a paginator for the results */
   
    public function searchAction() 
    {
        $products = Products::find("email = 'dslij@hotmail.com'"); 
        echo "There are ", count($products), "\n";

    }

    /** * Shows the view to create a "new" product */ 

    public function newAction() 
    {

    }
   
    /** * Shows the view to "edit" an existing product */ 

    public function editAction(){

    }

    /** * Creates a product based on the data entered in the "new" action */ 
    public function createAction()
     { 

     }
     /** * Updates a product based on the data entered in the "edit" action */ 
     public function saveAction() 
     { 

     }

     /** * Deletes an existing product */
      public function deleteAction($id) 
      { 

       }




}

