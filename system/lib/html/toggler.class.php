<?


class toggler
{
	private static $L_per,$L_start,$L_output;
	
	private $getVarName;
	
	public $per,$start,$output;
	
	public function setup($get_var_name,$per,$total_result,$show_page_in_toggler = 10)
	{
		$this->getVarName = $get_var_name;
		
		$this->per = $per ;
                     
        $total_pages = ceil(($total_result/$per));
                     
        $_GET[$get_var_name] = isset($_GET[$get_var_name]) && is_numeric($_GET[$get_var_name]) && $_GET[$get_var_name] > 0 && $_GET[$get_var_name] <=  $total_pages? $_GET[$get_var_name] - 1 : 1 - 1; 
                     
        $this->start = $per * $_GET[$get_var_name] + 1;
		
		
				
		$next = $_GET[$get_var_name] + 2;
		
		$prev = $_GET[$get_var_name];
		
		$first = 1;
		
		$last = $total_pages;
		
		if($first != ($_GET[$get_var_name]+1))
		{
			$this->output .= '<li><a href="'.addUrlGetValue(curPageURL(), $get_var_name, $first).'">First</a></li> ';
		}
		
		if($prev >= 1)
		{
			$this->output .= '<li class"prev"><a href="'.addUrlGetValue(curPageURL(), $get_var_name, $prev).'">Prev</a></li> ';
		}
				
		$this->InsiderTogglerMaker($total_pages,$show_page_in_toggler,$_GET[$get_var_name]+1);
		
		if($next <= $total_pages)
		{
			$this->output .= '<li class="next"><a href="'.addUrlGetValue(curPageURL(), $get_var_name, $next).'">Next</a></li> ';
		}
		
		if($last != ($_GET[$get_var_name]+1))
		{
			$this->output .= '<li><a href="'.addUrlGetValue(curPageURL(), $get_var_name, $last).'">Last</a></li> ';
		}
		
		
	}
	
	private function InsiderTogglerMaker($total_pages,$show_pages,$currunt)
	{
		
		$currunt = $currunt > $total_pages ? 1 : ceil($currunt) ;
		
		$n = $currunt;
	
		$show_pages = ($total_pages-$n) <= $show_pages/2 ? $show_pages * 2 - ($total_pages-$n) - 3 : $show_pages; 
		
		$split = ceil($show_pages/2);
		
		$prev_result = $currunt - 1 - ($currunt - $split) > 0 ? $currunt - 1 - ($currunt - $split) : 1 ;
			
		$z = ($currunt - $split) > 0 ? ($currunt - $split + 1) : 1;
		
		$bc = ($currunt - $split) < 0 ? abs(($currunt - $split)) : 0;
		
		if($total_pages > 1)
		{
		
		
		for($i=0; $i<ceil($prev_result); $i++)
		{
			
			if($z == $currunt)
			{
				break;
			}
			
			$this->output .= '<li><a href="'.addUrlGetValue(curPageURL(), $this->getVarName , $z).'">'.$z.'</a></li> ';
			
			$z++; 
			
		}
		
		for($i=0; $i<$split+1+$bc; $i++)
		{
			if($n > $total_pages)
			{
				break;
			}
			
			if($n == $currunt)
			{
				$this->output .= "<li class=\"activePage\">".$n."</li> ";
			}
			else
			{
				$this->output .= '<li><a href="'.addUrlGetValue(curPageURL(), $this->getVarName , $n).'">'.$n.'</a></li> ';
			}
			
			$n++;
		}
	}
	
	}

	
}




?>