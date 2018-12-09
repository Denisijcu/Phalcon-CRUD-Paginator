<?php
use Phalcon\Mvc\Model;

class Users extends Model {
     
 public $id;
 public $name;
 public $email;



 /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("store");
        $this->setSource("users");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    
    public static function find($parameters = null)
    {
       
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null)
    {
       
        return parent::findFirst($parameters);
    }

}
?>