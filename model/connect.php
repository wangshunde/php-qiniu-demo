<?php
class connect{
    protected $dbms='mysql';
    protected $host='qdm169657316.my3w.com';
    protected $dbName='qdm169657316_db';
    protected $user='qdm169657316';
    protected $pass='wang1990';

    public function getList(){
        $dsn="$this->dbms:host=$this->host;dbname=$this->dbName";
        $db = new PDO($dsn, $this->user, $this->pass); //初始化一个PDO对象    
        $db->query("set names utf8");
        $sql = "select * from qn_photo";
        $res = $db->prepare($sql);
        $res->execute();
        $row = $res->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($row);
        return $row;
    }
    
    public function insert($link){
        $dsn="$this->dbms:host=$this->host;dbname=$this->dbName";
        $db = new PDO($dsn, $this->user, $this->pass); //初始化一个PDO对象       
        $db->query("set names utf8");
        $sql = "insert into qn_photo (vc_photo) values('$link')";
        $res = $db->exec($sql);
        return $res;
        
        
    }
    public function url($status){
        $db = new PDO($this->dbName, $this->dbUser, $this->dbPassword);       
        $db->query("set names utf8");
        $sql = "select substring(a.sInfoKey,14,10) as twoMenu,a.tValue as url,c.tValue as oneMenu from tb_sysInfo as a inner join  dbo.SplitString((select tValue from tb_sysInfo where sInfoKey = '$status'),',',1) as b on a.ID = b.phone inner join tb_sysInfo as c on c.sInfoKey = 'oneMenu'+ substring(a.sInfoKey,8,5);";
        $res = $db->prepare($sql);
        $res->execute();
        $row = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $k=>$v) {
            $url[] = $v["url"];
        }
        return $url;
    }
    
    
}


