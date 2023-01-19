<?php
class MainController {  
    private function createHTMLDataUser ($dataArr){
        $tempHTML = "<ul style='display:none'>";

        foreach($dataArr as $data) {
            $tempHTML .= "<li class='level-{$data->level} node'><div class='node-section'><h2>{$data->name}</h2>";
			// if($data->description){
				$tempHTML .= "<div class='description'>{$data->description}</div></div>";
			// }
            

            if (isset($data->children)) {
				$tempHTML .= "<span class='show'>+</span>";
                $tempHTML .= $this->createHTMLDataUser($data->children);
            } 

            $tempHTML .= "</li>";
        }

        $tempHTML .= "</ul>";

        return $tempHTML;
    }

	public function actionIndex() {
		$recDatas = (new AdminController())->recursiveGetData(0, 0);
		$datas = $this->createHTMLDataUser($recDatas);

		require_once(BASEURL . "/views/main/index.php");
    }

    public function actionNotFound (){
        include_once(BASEURL . "/views/404.php");
    }
	 
}