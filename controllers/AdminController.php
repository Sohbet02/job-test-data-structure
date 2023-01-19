<?php

class AdminController {
    private function loadView ($page, $vars = array()) {
        require_once(BASEURL . "/views/admin/" . $page . ".php");
    }

    private function validateAuthorize () {
        if(!isset($_SESSION['user'])) {
            header("Location: /admin/login");
        }

        return;
    }

    public function recursiveGetData ($id, $level) {
        $tempData = Data::getDataChildrenById($id);
        $data = array();

        foreach($tempData as $d) {
            $obj = new stdClass;
            $obj->id = $d['id'];
            $obj->name = $d['name'];
            $obj->description = $d['description'];
            $obj->level = $level;
            $obj->children = $this->recursiveGetData($d['id'], $level+1);

            if(empty($obj->children)) {
                unset($obj->children);
            }

            array_push($data, $obj);
        }

        return $data;
    }
    
    private function createHtmlData ($dataArr){
        $tempHTML = "<ul>";

        foreach($dataArr as $data) {
            $tempHTML .= "<li class='level-{$data->level} node'><h2 title='{$data->description}'>{$data->name}</h2>";
            
            if (isset($data->children)) {
                $tempHTML .= $this->createHtmlData($data->children);
            } 

            $tempHTML .= "</li>";
        }

        $tempHTML .= "</ul>";

        return $tempHTML;
    }

    public function actionIndex() {
        $this->validateAuthorize();

        $ierarchichData = $this->recursiveGetData(0, 0);
        $htmlData = $this->createHtmlData($ierarchichData);
        $datas = Data::getDataAll();
        
        $this->loadView('index', array("data" => $htmlData, 'datas' => $datas));

    }

    public function actionLogin(){
        if(isset($_SESSION['user'])) {
            header("Location: /admin");
            exit;
        }

        if(isset($_POST['email'])) {
            $email = isset($_POST['email']) ? sanitizeString(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)) : "";
            $password = isset($_POST['password']) ? $_POST['password']: "";

            if($email && $password) {
				$auth = Account::authorize($email, $password);				 
				if(is_array($auth)) {
					$_SESSION['user'] = $auth;
					header("Location: /admin");
					exit;
				} else {
					$errorMessage = "<strong>Error</strong>: Email/password is wrong"  ;
				}

            }else {
                $errorMessage = '<strong>Error</strong>: Missing email/password on login';
            }
        }
        
        $vars = array(
            "errorMessage" => $errorMessage ?? null,
            "email" => $email ?? null
        );

        $this->loadView('login', $vars);
    }

    public function actionLogout() {
        session_destroy();
        header("Location: /admin");
    }
    public function actionDataAdd() {
        $this->validateAuthorize();

        if(isset($_POST['name']) && $_POST['name']) {
            $desc = isset($_POST['description']) ? $_POST['description'] : null;
            $parent = isset($_POST['parent']) ? (int)$_POST['parent'] : 0;

            Data::storeData($_POST['name'], $desc, $parent);
        }

        header("Location: /admin");
    }

    public function actionDataEdit() {
        $this->validateAuthorize();

        if(isset($_POST['name'])  && $_POST['name'] && isset($_POST['data'])) {
            $desc = isset($_POST['description']) ? $_POST['description'] : null;
            $parent = isset($_POST['parent']) ? (int)$_POST['parent'] : 0;
            $data = isset($_POST['data']) ? (int)$_POST['data'] : 0;
            ;
            Data::updateData($data, $_POST['name'], $desc, $parent);
        }

        header("Location: /admin");
    }

    public function actionDataDelete() {
        $this->validateAuthorize();

        if(isset($_POST['data']) && $_POST['data']) {
            $data = (int)$_POST['data'];

            Data::deleteData($data);
        }

        header("Location: /admin");
    }

    public function actionDataGet() {
        $id = json_decode(file_get_contents('php://input'), false);
        if($id) {
            $data = (int)$id;
            $res = Data::getData($data);

            echo json_encode($res);
            exit();
        }
    }
}