<?php
// Model related to the fake analytics data
// In reality you would have this query your real analytics service
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 28/03/17
 * Time: 20:30
 */
class WebsiteAnalyticsModel extends AdminModel
{
    private $data;

    public function __construct()
    {
        parent::__construct(get_class($this));
        $this->generateData();
    }

    private function generateData() {
        // In reality this would be populated by querying the analytics data
        $data = array(
            'page-views'=> 324,
            'bounce-rate'=> '45%',
            'uniq-sess'=> '81%',
            'avg-sess'=> '00:03:24'
        );

        $this->data = $data;
    }

    // Returning the data
    public function getData() {
        return $this->data;
    }
}