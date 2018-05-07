<?php
// My model to get data relevant to the admin dashboard
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 20:51
 */
class DashboardModel extends AdminModel
{
    // The data that I will return
    private $newsData;
    private $analyticsData;
    private $postsData;

    public function __construct()
    {
        // My constructor calls the parent constructor storing the name of this class
        // All of my models are like this
        parent::__construct(get_class($this));
        // Calling methods to get the relevant data
        $this->generateNewsData();
        $this->generateAnalyticsData();
        $this->generatePostsData();
    }

    // Each of the three below functions first create a new model and then retrieve data from them
    private function generateNewsData() {
        require_once 'WebsiteNewsModel.php';
        $model = new WebsiteNewsModel();
        $this->newsData = $model->getData();
    }

    private function generateAnalyticsData() {
        require_once 'WebsiteAnalyticsModel.php';
        $model = new WebsiteAnalyticsModel();
        $this->analyticsData = $model->getData();
    }

    private function generatePostsData() {
        require_once 'PostsAdminModel.php';
        $model = new PostsAdminModel();
        $this->postsData = $model->getRecentPosts(3);
    }

    // Each of the three below functions return the data for the dashboard
    public function getNewsData() {
        return $this->newsData;
    }

    public function getAnalyticsData() {
        return $this->analyticsData;
    }

    public function getPostsData() {
        return $this->postsData;
    }
}