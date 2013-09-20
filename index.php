<?php
//error_reporting(0);
date_default_timezone_set("Europe/Moscow");
if (strlen($_SERVER['REQUEST_URI']) > 100000)
    exit;
include_once 'render/PageRender.php';
$pr = new PageRender();
$params = explode("/", $_SERVER['REQUEST_URI']);
if (!empty($_GET["page"]) && !empty($_GET["a"])) {
    
    if ($pr->CheckPageExists($_GET["page"])) {
        $pr->Render($_GET["page"]);
    }
}else if (!empty($_POST["page"]) && !empty($_POST["a"])) {
    if ($pr->CheckPageExists($_POST["page"])) {
        $pr->Render($_POST["page"]);
    }
} else {
//        $uc = new UserClass();
//        if (empty($params["1"])){
//            if($uc->IsLoggedIn()){
//                $params["1"] = "cabinet";
//            }else{
//                $params["1"] = "login";
//            }
//        }
    if(empty($params[1])){
        $params[1]="numbers";
    }
    if($pr->CheckPageExists($params["1"])){
        if ($params["2"] == "get") {
            $pr->Render($params["1"]);
        } elseif (!empty($params["1"])) {
            //if ($params["1"] == "firstmenu") {
            //    $pr->Render($params["1"]);
            //} else {
            $pr->Render("head");
            $pr->Render($params["1"]);
            $pr->Render("foot");
            //}
        }
    }
}
?>