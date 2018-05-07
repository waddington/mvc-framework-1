<?php
// My model for posts pages
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 14:19
 */
class PostsModel
{
    // Storing whether there were any errors
    private $getPostError;

    public function __construct()
    {
        $this->getPostError = false;
    }

    // Function to get a single specific post
    public function getPost($id) {
        $sql = "SELECT * FROM posts JOIN users ON posts.u_id = users.u_id JOIN categories ON posts.p_category = categories.c_id WHERE p_id = ?";
        $sqlData = array($id);

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql, $sqlData);

        if ($statement->rowCount() == 1) {
            $postData = $statement->fetch();
            return $postData;
        } else {
            $this->getPostError = true;
            return null;
        }
    }
}