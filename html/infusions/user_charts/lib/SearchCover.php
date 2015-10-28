<?php

/**
 * Created by PhpStorm.
 * User: preacher
 * Date: 13.10.15
 * Time: 22:43
 */

require_once INFUSIONS."user_charts/lib/AmazonECS.class.php";


error_reporting(E_ALL & ~E_NOTICE);

// TODO-Michy Notize fehler suchen

class SearchCover
{

    private $Interpret = '';
    private $Song = '';
    private $res = '';
    private $id = '';
    private $cover = '';

    public function __construct($interpret, $song, $id){
        $result = dbquery("SELECT chart_interpret chart_song FROM " . DB_CHARTS);
        $this->res = $result;
        $this->Interpret = $interpret;
        $this->Song = $song;
        $this->id = $id;
    }
// Todo-Michy Fehler abfangen !!!!
    public function getTest(){
        $res = $this->Interpret . " - " . $this->Song;
        $this->CoverSearch($res);
        if($this->cover['Items']['Item']['SmallImage']){
            $cover = htmlentities($this->cover['Items']['Item']['SmallImage']['URL']);
            $sql = "UPDATE " . DB_CHARTS . " SET chart_cover = \"" . htmlspecialchars($cover) . "\" WHERE chart_id = " . $this->id . ";";
            $ready = dbquery($sql);
            return $ready;
        }elseif($this->cover['Items']['Item'][0]['SmallImage']){
            $cover =  htmlentities($this->cover['Items']['Item'][0]['SmallImage']['URL']);
            $sql = "UPDATE " . DB_CHARTS . " SET chart_cover = \"" . htmlspecialchars($cover) . "\" WHERE chart_id = " . $this->id . ";";
            $ready = dbquery($sql);
            return $ready;
        }else{
            $cover = "img/dummy_cd.jpg";
            $sql = "UPDATE " . DB_CHARTS . " SET chart_cover = \"" . htmlspecialchars($cover) . "\" WHERE chart_id = " . $this->id . ";";
            $ready = dbquery($sql);
            return $ready;
        }
    }

    public function CoverSearch($nameSong)
    {
        try
        {
            // get a new object with your API Key and secret key. Lang is optional.
            // if you leave lang blank it will be US.
            $amazonEcs = new AmazonECS('AKIAJ45XKTAZEFQWMN3Q', 'VwUj6FDtpTu/JcAl6cLsGfw0eQIc2A3uvhYv3mYv', 'de', 'ASSOCIATE TAG');
            $this->cover = $amazonEcs->returnType('1')->country('de')->category('All')->responseGroup('Small,Images')->search($nameSong);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
}