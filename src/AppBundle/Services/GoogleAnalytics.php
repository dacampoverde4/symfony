<?php

namespace AppBundle\Services;

use Google_Client;
use Google_Service_AnalyticsReporting;
use Google_Service_AnalyticsReporting_DateRange;
use Google_Service_AnalyticsReporting_GetReportsRequest;
use Google_Service_AnalyticsReporting_Dimension;
use Google_Service_AnalyticsReporting_Metric;
use Google_Service_AnalyticsReporting_OrderBy;
use Google_Service_AnalyticsReporting_ReportRequest;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class GoogleAnalytics
 */
class GoogleAnalytics
{
    /**
     * @var Google_Client
     */
    private $client;

    /**
     * @var Google_Service_AnalyticsReporting
     */
    private $analytics;

    /**
     * @var String
     */
    private $viewId;

    /**
     * construct
     */
    public function __construct($keyFileLocation, $viewId)
	{
        if(! file_exists($keyFileLocation))
		{
            throw new Exception('Can\'t find file key location defined by google_analytics_api.google_analytics_json_key parameter, ex : ../data/analytics/analytics-key.json');
        }

        $this->client = new Google_Client();
        $this->client->setApplicationName('GoogleAnalytics');
        $this->client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $this->client->setAuthConfig($keyFileLocation);

        $this->analytics = new Google_Service_AnalyticsReporting($this->client);

		$this->viewId = $viewId;
    }

    /**
     * @return Google_Service_AnalyticsReporting
     */
    public function getAnalytics()
	{
        return $this->analytics;
    }

    /**
     * @return Google_Client
     */
    public function getClient()
	{
        return $this->client;
    }

    /**
     * @return String
     */
    public function getViewId()
	{
        return $this->viewId;
    }

    /**
     * @param $dateStart
     * @param $dateEnd
	 *
     * @return mixed
     */
    public function getVisitedPages($dateStart, $dateEnd)
	{
        // Create the DateRange object
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($dateStart);
        $dateRange->setEndDate($dateEnd);

        // Create the Dimension object
        $dimension = new Google_Service_AnalyticsReporting_Dimension();
        $dimension->setName('ga:contentGroup1');

        // Create the Metric object
        $metric1 = new Google_Service_AnalyticsReporting_Metric();
        $metric1->setExpression('ga:pageviews');

        // Create the Metric object
        $metric2 = new Google_Service_AnalyticsReporting_Metric();
        $metric2->setExpression('ga:avgTimeOnPage');

        // Create the OrderBy object
        $orderBy = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy->setFieldName('ga:pageviews');
		$orderBy->setSortOrder('DESCENDING');

        // Create the ReportRequest object
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($this->viewId);
        $request->setDateRanges($dateRange);
		$request->setDimensions(array($dimension));
        $request->setMetrics(array($metric1, $metric2));
		$request->setOrderBys(array($orderBy));

		$body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request));

        return $report = $this->analytics->reports->batchGet($body)->getReports()[0];
    }

    /**
     * @param $dateStart
     * @param $dateEnd
	 *
     * @return mixed
     */
    public function getVisitorsLocations($dateStart, $dateEnd)
	{
        // Create the DateRange object
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($dateStart);
        $dateRange->setEndDate($dateEnd);

        // Create the Dimension object
        $dimension = new Google_Service_AnalyticsReporting_Dimension();
        $dimension->setName('ga:country');

        // Create the Metric object
        $metric = new Google_Service_AnalyticsReporting_Metric();
        $metric->setExpression('ga:users');

        // Create the OrderBy object
        $orderBy = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy->setFieldName('ga:users');
		$orderBy->setSortOrder('DESCENDING');

        // Create the ReportRequest object
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($this->viewId);
        $request->setDateRanges($dateRange);
		$request->setDimensions(array($dimension));
        $request->setMetrics(array($metric));
		$request->setOrderBys(array($orderBy));

		$body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request));

        return $report = $this->analytics->reports->batchGet($body)->getReports()[0];
    }

    /**
     * @param $dateStart
     * @param $dateEnd
	 *
     * @return mixed
     */
    public function getVisitedPagesByDate($dateStart, $dateEnd)
	{
        // Create the DateRange object
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($dateStart);
        $dateRange->setEndDate($dateEnd);

        // Create the Dimension object
        $dimension1 = new Google_Service_AnalyticsReporting_Dimension();
        $dimension1->setName('ga:year');

        // Create the Dimension object
        $dimension2 = new Google_Service_AnalyticsReporting_Dimension();
        $dimension2->setName('ga:month');

        // Create the Dimension object
        $dimension3 = new Google_Service_AnalyticsReporting_Dimension();
        $dimension3->setName('ga:day');

        // Create the Metric object
        $metric = new Google_Service_AnalyticsReporting_Metric();
        $metric->setExpression('ga:pageviews');

        // Create the OrderBy object
        $orderBy1 = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy1->setFieldName('ga:year');
		$orderBy1->setSortOrder('ASCENDING');

        // Create the OrderBy object
        $orderBy2 = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy2->setFieldName('ga:month');
		$orderBy2->setSortOrder('ASCENDING');

        // Create the OrderBy object
        $orderBy3 = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy3->setFieldName('ga:day');
		$orderBy3->setSortOrder('ASCENDING');

        // Create the ReportRequest object
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($this->viewId);
        $request->setDateRanges($dateRange);
		$request->setDimensions(array($dimension1, $dimension2, $dimension3));
        $request->setMetrics(array($metric));
		$request->setOrderBys(array($orderBy1, $orderBy2, $orderBy3));

		$body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request));

        return $report = $this->analytics->reports->batchGet($body)->getReports()[0];
    }

    /**
     * @param $dateStart
     * @param $dateEnd
	 *
     * @return mixed
     */
    public function getVisitorsByDate($dateStart, $dateEnd)
	{
        // Create the DateRange object
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate($dateStart);
        $dateRange->setEndDate($dateEnd);

        // Create the Dimension object
        $dimension1 = new Google_Service_AnalyticsReporting_Dimension();
        $dimension1->setName('ga:year');

        // Create the Dimension object
        $dimension2 = new Google_Service_AnalyticsReporting_Dimension();
        $dimension2->setName('ga:month');

        // Create the Dimension object
        $dimension3 = new Google_Service_AnalyticsReporting_Dimension();
        $dimension3->setName('ga:day');

        // Create the Metric object
        $metric = new Google_Service_AnalyticsReporting_Metric();
        $metric->setExpression('ga:users');

        // Create the OrderBy object
        $orderBy1 = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy1->setFieldName('ga:year');
		$orderBy1->setSortOrder('ASCENDING');

        // Create the OrderBy object
        $orderBy2 = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy2->setFieldName('ga:month');
		$orderBy2->setSortOrder('ASCENDING');

        // Create the OrderBy object
        $orderBy3 = new Google_Service_AnalyticsReporting_OrderBy();
        $orderBy3->setFieldName('ga:day');
		$orderBy3->setSortOrder('ASCENDING');

        // Create the ReportRequest object
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($this->viewId);
        $request->setDateRanges($dateRange);
		$request->setDimensions(array($dimension1, $dimension2, $dimension3));
        $request->setMetrics(array($metric));
		$request->setOrderBys(array($orderBy1, $orderBy2, $orderBy3));

		$body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request));

        return $report = $this->analytics->reports->batchGet($body)->getReports()[0];
    }
}
