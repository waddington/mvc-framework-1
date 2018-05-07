<?php
// My model for the homepage
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 13:54
 */
class HomeModel
{
    // Function to get the 3 most recent posts
    public function getRecentPosts($number=3) {
        $sql = "SELECT * FROM posts JOIN users ON posts.u_id = users.u_id ORDER BY p_created LIMIT ".$number;

        global $queriesModel;
        $statement = $queriesModel->pdoStatement($sql);

        $recentPosts = $statement->fetchAll();
        return $recentPosts;
    }
}