<?php

namespace AppBundle\Services;

/**
 * Class GoogleLineChart
 */
class GoogleLineChart
{
	/**
	 * Google Chart API URL.
	 *
	 * @var string
	 */
	private $apiurl = 'https://chart.googleapis.com/chart';

	/**
	 * Set Google chart type.
	 *
	 * @var string
	 */
	private $type = 'lc';

	/**
	 * Chart dimensions (WxH).
	 *
	 * @var string
	 */
	private $dimensions = '665x350';

	/**
	 * Chart margins.
	 *
	 * Array (in pixels) left, right, top, bottom
	 *
	 * @var array
	 */
	private $margins = array();

	/**
	 * Chart title.
	 *
	 * @var string
	 */
	private $title;

	/**
	 * Chart title style.
	 *
	 * String, RGB colour and font size, separated by comma.
	 *
	 * @var string
	 */
	private $titleStyle = '4A5159,18';

	/**
	 * Colour seriesColor to use.
	 *
	 * Provide a list of comma separated hex RGB values (without leading #) to specify a palette.
	 *
	 * @var array
	 */
	private $seriesColor = array();

	/**
	 * Background color
	 *
	 * @var string
	 */
	private $backgroundColor = 'FFFFFF';

	/**
	 * Chart area color
	 *
	 * @var string
	 */
	private $chartAreaColor = 'ECECED';

	/**
	 * Chart legend.
	 *
	 * @var array
	 */
	private $legend = array();

	/**
	 * X-axis labels.
	 *
	 * @var array
	 */
	private $xLabels = array();

	/**
	 * Y-axis labels.
	 *
	 * @var array
	 */
	private $yLabels = array();

	/**
	 * X-axis title.
	 *
	 * @var string
	 */
	private $xTitle;

	/**
	 * Y-axis title.
	 *
	 * @var string
	 */
	private $yTitle;

	/**
	 * Chart labels style.
	 *
	 * String, RGB colour and font size, separated by comma.
	 *
	 * @var string
	 */
	private $labelsStyle = '4A5159,12';

	/**
	 * Chart titles style.
	 *
	 * String, RGB colour and font size, separated by comma.
	 *
	 * @var string
	 */
	private $titlesStyle = '4A5159,14';

	/**
	 * Specify line thickness
	 *
	 * @var array
	 */
	private $linesThickness = array();

	/**
	 * Line values (in same order as x-axis labels).
	 *
	 * Support multiple series. Each element of the array is another array
	 * containing the series values, with one sub-array per series.
	 *
	 * @var array
	 */
	private $values = array();

	/**
	 * Minimum value
	 *
	 * @var integer
	 */
	private $minimum = 0;

	/**
	 * Maximum value
	 *
	 * @var integer
	 */
	private $maximum = 0;

	/**
	 * Show/Hide the grid.
	 *
	 * @var array
	 */
	private $grid = true;

	/**
	 * Step between each horizontal lines in the grid.
	 *
	 * @var integer
	 */
	private $yMultiplier = 20;

	/**
	 * Define markers (arrays of color and width).
	 *
	 * @var array
	 */
	private $markers = array(array('d', 'DE0A33', 12), array('d', 'FFFFFF', 8), array('N', 'DE0A33', 11));


	private function array_urlencode($array)
	{
		$result = array();

		foreach($array as $value)
		{
			$result[] = urlencode($value);
		}

		return $result;
	}

	/**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
	{
		$this->type = $type;
	}

	/**
     * Get type
     *
     * @return string
     */
	public function getType()
	{
		return $this->type;
	}

	/**
     * Set dimensions
     *
     * @param string $dimensions
     */
    public function setDimensions($dimensions)
	{
		$this->dimensions = $dimensions;
	}

	/**
     * Get dimensions
     *
     * @return string
     */
	public function getDimensions()
	{
		return $this->dimensions;
	}

	/**
     * Set margins
     *
     * @param array $margins
     */
    public function setMargins($margins)
	{
		$this->margins = $margins;
	}

	/**
     * Get margins
     *
     * @return array
     */
	public function getMargins()
	{
		return $this->margins;
	}

	/**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
     * Get title
     *
     * @return string
     */
	public function getTitle()
	{
		return $this->title;
	}

	/**
     * Set titleStyle
     *
     * @param string $titleStyle
     */
    public function setTitleStyle($titleStyle)
	{
		$this->titleStyle = $titleStyle;
	}

	/**
     * Get titleStyle
     *
     * @return string
     */
	public function getTitleStyle()
	{
		return $this->titleStyle;
	}

	/**
     * Set seriesColor
     *
     * @param string $seriesColor
     */
    public function setSeriesColor($seriesColor)
	{
		$this->seriesColor = $seriesColor;
	}

	/**
     * Get seriesColor
     *
     * @return string
     */
	public function getSeriesColor()
	{
		return $this->seriesColor;
	}

	/**
     * Set backgroundColor
     *
     * @param string $backgroundColor
     */
    public function setBackgroundColor($backgroundColor)
	{
		$this->backgroundColor = $backgroundColor;
	}

	/**
     * Get backgroundColor
     *
     * @return string
     */
	public function getBackgroundColor()
	{
		return $this->backgroundColor;
	}

	/**
     * Set chartAreaColor
     *
     * @param string $chartAreaColor
     */
    public function setChartAreaColor($chartAreaColor)
	{
		$this->chartAreaColor = $chartAreaColor;
	}

	/**
     * Get chartAreaColor
     *
     * @return string
     */
	public function getChartAreaColor()
	{
		return $this->chartAreaColor;
	}

	/**
     * Set legend
     *
     * @param array $legend
     */
    public function setLegend($legend)
	{
		$this->legend = $legend;
	}

	/**
     * Get legend
     *
     * @return array
     */
	public function getLegend()
	{
		return $this->legend;
	}

	/**
     * Set xLabels
     *
     * @param array $xLabels
     */
    public function setXLabels($xLabels)
	{
		$this->xLabels = $xLabels;
	}

	/**
     * Get xLabels
     *
     * @return array
     */
	public function getXLabels()
	{
		return $this->xLabels;
	}

	/**
     * Set yLabels
     *
     * @param array $yLabels
     */
    public function setYLabels($yLabels)
	{
		$this->yLabels = $yLabels;
	}

	/**
     * Get yLabels
     *
     * @return array
     */
	public function getYLabels()
	{
		return $this->yLabels;
	}

	/**
     * Set xTitle
     *
     * @param string $xTitle
     */
    public function setXTitle($xTitle)
	{
		$this->xTitle = $xTitle;
	}

	/**
     * Get xTitle
     *
     * @return string
     */
	public function getXTitle()
	{
		return $this->xTitle;
	}

	/**
     * Set yTitle
     *
     * @param string $yTitle
     */
    public function setYTitle($yTitle)
	{
		$this->yTitle = $yTitle;
	}

	/**
     * Get yTitle
     *
     * @return string
     */
	public function getYTitle()
	{
		return $this->yTitle;
	}

	/**
     * Set labelsStyle
     *
     * @param string $labelsStyle
     */
    public function setLabelsStyle($labelsStyle)
	{
		$this->labelsStyle = $labelsStyle;
	}

	/**
     * Get labelsStyle
     *
     * @return string
     */
	public function getLabelsStyle()
	{
		return $this->labelsStyle;
	}

	/**
     * Set titlesStyle
     *
     * @param string $titlesStyle
     */
	public function setTitlesStyle($titlesStyle)
	{
		$this->titlesStyle = $titlesStyle;
	}

	/**
     * Get titlesStyle
     *
     * @return string
     */
	public function getTitlesStyle()
	{
		return $this->titlesStyle;
	}

	/**
     * Set linesThickness
     *
     * @param array $linesThickness
     */
    public function setLinesThickness($linesThickness)
	{
		$this->linesThickness = $linesThickness;
	}

	/**
     * Get linesThickness
     *
     * @return array
     */
	public function getLinesThickness()
	{
		return $this->linesThickness;
	}

	/**
     * Set values
     *
     * @param array $values
     * @param boolean $updateMinMax
     */
    public function setValues($values, $updateMinMax)
	{
		$this->values = $values;

		// Determine minimum and maximum from values
		if($updateMinMax)
		{
			$this->maximum = 0;
			$this->minimum = 0;

			foreach($this->values as $series)
			{
				foreach($series as $value)
				{
					if($value > $this->maximum)
					{
						$this->maximum = $value;
					}

					if($value < $this->minimum)
					{
						$this->minimum = $value;
					}
				}
			}

			// Increases the maximum up to the defined multiplier
			$i = 0;

			while($i < $this->maximum)
			{
				$i += $this->yMultiplier;
			}

			$this->maximum = $i;
		}
	}

	/**
     * Get values
     *
     * @return array
     */
	public function getValues()
	{
		return $this->values;
	}

	/**
     * Set minimum
     *
     * @param integer $minimum
     */
    public function setMinimum($minimum)
	{
		$this->minimum = $minimum;
	}

	/**
     * Get minimum
     *
     * @return integer
     */
	public function getMinimum()
	{
		return $this->minimum;
	}

	/**
     * Set maximum
     *
     * @param integer $maximum
     */
    public function setMaximum($maximum)
	{
		$this->maximum = $maximum;
	}

	/**
     * Get maximum
     *
     * @return integer
     */
	public function getMaximum()
	{
		return $this->maximum;
	}

	/**
     * Set grid
     *
     * @param boolean $grid
     */
    public function setGrid($grid)
	{
		$this->grid = $grid;
	}

	/**
     * Is grid
     *
     * @return boolean
     */
	public function isGrid()
	{
		return $this->grid;
	}

	/**
     * Set yMultiplier
     *
     * @param integer $yMultiplier
     */
	public function setYMultiplier($yMultiplier)
	{
		$this->yMultiplier = $yMultiplier;
	}

	/**
     * Get yMultiplier
     *
     * @return integer
     */
	public function getYMultiplier()
	{
		return $this->yMultiplier;
	}

	/**
     * Set markers
     *
     * @param array $markers
     */
    public function setMarkers($markers)
	{
		$this->markers = $markers;
	}

	/**
     * Get markers
     *
     * @return array
     */
	public function getMarkers()
	{
		return $this->markers;
	}

	/**
	 * Generate a Google Chart API URL to render a chart.
	 *
	 * @return string
	 */
	public function getURL()
	{
		// Do some basic sanity checks
		if(empty($this->type))
		{
			throw new \Exception('No chart type set in $type property.');
		}
		if(empty($this->dimensions))
		{
			throw new \Exception('No chart dimensions set in $dimensions property.');
		}

		// Start URL with chart type and dimensions
		$url = 'cht='.$this->type.'&chs='.$this->dimensions;

		// Add margins
		if(! empty($this->margins))
		{
			$url .= '&chma='.implode(',', $this->margins);
		}

		// Add title
		if(! empty($this->title))
		{
			$url .= '&chtt='.urlencode($this->title);
		}

		// Add title style
		if(! empty($this->titleStyle))
		{
			$url .= '&chts='.$this->titleStyle;
		}

		// Add background color and chart area color
		$chf = null;

		if(! empty($this->backgroundColor))
		{
			$chf = '&chf=bg,s,'.$this->backgroundColor;
		}

		if(! empty($this->chartAreaColor))
		{
			$chf .= (($chf != null) ? '|' : '&chf=').'c,s,'.$this->chartAreaColor;
		}

		$url .= $chf;

		// Add grid
		if($this->grid)
		{
			$url .= '&chg=0,'.round(100 / ($this->maximum / $this->yMultiplier), 2);
		}

		// Add axis labels and title
		$chxl = null;
		$chxt = null;
		$chxs = null;
		$chxp = null;
		$chxr = null;
		$labelIndex = 0;

		if(! empty($this->xLabels))
		{
			$chxl .= '&chxl='.$labelIndex.':|'.implode('|', $this->array_urlencode($this->xLabels));
		}

		$chxt .= '&chxt=x';
		$chxs .= '&chxs=0,'.$this->labelsStyle.',0';
		$labelIndex++;

		if(! empty($this->yLabels))
		{
			$chxl .= (($chxl != null) ? '|' : '&chxl=').$labelIndex.':|'.implode('|', $this->array_urlencode($this->yLabels));
		}

		$chxt .= (($chxt != null) ? ',' : '&chxt=').'y';
		$chxs .= (($chxs != null) ? '|' : '&chxs=').$labelIndex.','.$this->labelsStyle.',0';
		$chxr = '&chxr='.$labelIndex.','.$this->minimum.','.$this->maximum.','.$this->yMultiplier;
		$labelIndex++;

		if(! empty($this->xTitle))
		{
			$chxl .= (($chxl != null) ? '|' : '&chxl=').$labelIndex.':|'.$this->xTitle;
			$chxt .= (($chxt != null) ? ',' : '&chxt=').'x';
			$chxs .= (($chxs != null) ? '|' : '&chxs=').$labelIndex.','.$this->titlesStyle.',0';
			$chxp .= '&chxp='.$labelIndex.',50.0';

			$labelIndex++;
		}

		if(! empty($this->yTitle))
		{
			$chxl .= (($chxl != null) ? '|' : '&chxl=').$labelIndex.':|'.$this->yTitle;
			$chxt .= (($chxt != null) ? ',' : '&chxt=').'y';
			$chxs .= (($chxs != null) ? '|' : '&chxs=').$labelIndex.','.$this->titlesStyle.',0';
			$chxp .= (($chxp != null) ? '|' : '&chxp=').$labelIndex.',50.0';

			$labelIndex++;
		}

		$url .= $chxl.$chxt.$chxs.$chxp.$chxr;

		// Add colours
		if(! empty($this->seriesColor))
		{
			$url .= '&chco='.implode(',', $this->seriesColor);
		}

		// Add lines thickness
		if(! empty($this->linesThickness))
		{
			$url .= '&chls='.implode('|', $this->linesThickness);
		}

		// Add series
		if(! empty($this->values))
		{
			$url .= '&chd=t:';

			foreach($this->values as $series)
			{
				$url .= implode(',', $series);
				$url .= '|';
			}

			$url = rtrim($url, '|');
			$url .= '&chds='.$this->minimum.','.$this->maximum;
		}

		// Add point markers
		if(! empty($this->markers))
		{
			$url .= '&chm=';

			foreach($this->markers as $key => $marker)
			{
				$url .= (($key == 0) ? '' : '|').$marker[0].','.$marker[1].',0,-1,'.$marker[2].',0';
			}
		}

		// Add legend
		if(! empty($this->legend))
		{
			$url .= '&chdl='.implode('|', $this->array_urlencode($this->legend));
		}

		// Return completed URL
		return $this->apiurl.'?'.$url;
	}
}
