<?php 
namespace AppBundle\Twig;

class HelperVistas extends \Twig_Extension
{
 
	public function getFunctions() {
		return array(
			'generateTable' => new \Twig_Function_Method($this,'generateTable')
			);
	}
 
	public function generateTable($num_columns,$num_rows){
		$table = "<table class='table'>";
		for($a=0;$a<$num_rows;$a++)
		{

			$table .="<tr>";
			for($b=0;$b<$num_columns;$b++)
			{
				$table .="<td>".$a."-".$b."</td>";
			}
			$table .="</tr>";
		}
		$table .="</table>";
		return $table;
	}
	 


	public function getName() {
		return "app_bundle";
	}

}



?>