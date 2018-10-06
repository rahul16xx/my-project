<?php

class pageclass
{
    						//class-wide variables
    var $query_limit_rr;	// limits the number of rows in a page
	var $queryString_rr;
	var $currentPage;		//  Name of current page 		
	var $maxRows_rr;		
	var $totalPages_rr;		// total pages will be calculated depending on $maxRows_rr
	var $startRow_rr;        // start row for each page
	var $numrow_1;			// total number of rows
	var $pageNum_rr;	 //    
	
	function paging($sql_1)
	{
	$this->maxRows_rr = 30; //return this value
	$this->currentPage = $_SERVER["PHP_SELF"];
	$this->pageNum_rr = 0;
							// If pageNum_rr is not set by default it will show page no 0
	if (isset($_GET['pageNum_rr'])) {
  	$this->pageNum_rr = $_GET['pageNum_rr'];
	}
							// by default it will start from 0*10=10 otherwise
							//  for 3 it will start with 3*10=20
	$this->startRow_rr = $this->pageNum_rr * $this->maxRows_rr; 
	$this->query_limit_rr = sprintf("%s LIMIT %d, %d", $sql_1, $this->startRow_rr, $this->maxRows_rr); 

	if (isset($_GET['totalRows_rr'])) {
  	$this->numrow_1 = $_GET['totalRows_rr'];
	} 
	else 
	{
  	$all_rr = mysql_query($sql_1);
  	$this->numrow_1 = mysql_num_rows($all_rr);
	}
				// calculating number of pages for required for display
	$this->totalPages_rr = ceil($this->numrow_1/$this->maxRows_rr)-1;
	$queryString_rr = "";

	if (!empty($_SERVER['QUERY_STRING'])) {
  	$params = explode("&", $_SERVER['QUERY_STRING']);
  	$newParams = array();
  	foreach ($params as $param) {
  		if (stristr($param, "pageNum_rr") == false && 
        stristr($param, "totalRows_rr") == false) {
      	array_push($newParams, $param);
    	}
  	}
  	if (count($newParams) != 0) {
    $queryString_rr = "&" . htmlentities(implode("&", $newParams));
  	}
	}
	$this->queryString_rr = sprintf("&totalRows_rr=%d%s", $this->numrow_1, $this->queryString_rr);
				// all varaible values are put in string $explodeme to be exploded in main file
	$explodeme="$this->query_limit_rr#$this->maxRows_rr";
	return $explodeme;
	} //End of function paging


	function pageprinting($menu_id)
	{
	echo "<form action='$_SERVER[PHP_SELF]' name='pageform' method='post'>";
	echo "<table width=100%><tr><Td width=40%>";
	
	echo '<div class=text>Showing Records &nbsp;'; 
	echo ($this->startRow_rr + 1);
	echo " to ";
	echo min($this->startRow_rr + $this->maxRows_rr, $this->numrow_1);
	echo " of  ";
	echo $this->numrow_1;

	echo '</div></td><td width=60% align=right class=text>';

	echo "Jump To Page&nbsp;<select class=tbox name='pagenumber' onChange=\"MM_jumpMenu('self',this,1)\">";
	
	for($i=0;$i<=$this->totalPages_rr;$i++) 
	{
	$j=$i;
	echo "<option value='$_SERVER[PHP_SELF]?pageNum_rr=".$j."&Search&selectme=$j&menu=$_REQUEST[menu]&ch=$_GET[ch]'";
        
	if($j==$_GET['selectme']) {
	echo " selected"; } echo ">"; echo $j+1; echo"</option>"; 
	} 
	echo "</select> of&nbsp;";echo $j+1;echo "&nbsp;Pages"; 
        echo "</td></tr></table></form>";
	$explodeme2="$this->startRow_rr#$this->numrow_1";
	return $explodeme2;
	}
	 			// End of function Pageprinting
} 				//End of class pageclass-            


?>
