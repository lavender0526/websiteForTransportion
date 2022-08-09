<?php
namespace vendor;
use vendor\Controller;
use \PDO;
use \PDOException;

class DB extends controller 
{
  public static $db_host;
  public static $db_name ;
  public static $db_user ;
  public static $db_password ;
   private static $conn = null;
 static function connect(){
if (self::$conn!=null)return;
$dsn = sprintf("mysql:host=%s;dbname=%s;charset=utf8", self::$db_host, self::$db_name);
try {
    self::$conn = new PDO($dsn, self::$db_user, self::$db_password);
} 
catch (PDOException $e) {
    self::$conn = NULL;
}

}
static function select($sql,$args){
  DB::connect();
  if (self::$conn==null) return self::response(14,'DB無法開啟');
  $stmt=self::$conn->prepare($sql);
  $result=$stmt->execute($args);
  if ($result) {
     $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
     return self::response(200,'查詢成功',$rows);
  }
  else {
      return self::response(400,'SQL錯誤');
  }
}
static function insert($sql, $args){
    self::connect();
    if (self::$conn==NULL) return self::response(14, "無法開啟DB");
    $stmt = self::$conn->prepare($sql);
    $result = $stmt->execute($args);
    if ($result) {
        $count = $stmt->rowCount();
        $id = self::$conn->lastInsertId();
        return ($count < 1) ? self::response(204, "新增失敗") : self::response(200, "新增成功", $id);
    } else {
        return self::response(400, "SQL錯誤",$result);
    }

    // DB::connect();
    // if (self::$conn==NULL) return self::response(14, "無法開啟DB");
    // $stmt = self::$conn->prepare($sql);
    // $result = $stmt->execute($args);
    // if ($result) {
    //     $count = $stmt->rowCount();
    //     return ($count < 1) ? self::response(204, "新增失敗") : self::response(200, "新增成功");
    // } else {
    //     return self::response(400, "SQL錯誤");
    // }
}
static function remove($sql,$args){
    DB::connect();
    if (self::$conn==NULL) return self::response(14, "無法開啟DB");
    $stmt = self::$conn->prepare($sql);
    $result = $stmt->execute($args);
    if ($result) {
        $count = $stmt->rowCount();
        return ($count<1)?self::response(204,'刪除失敗'):
        self::response(200,'刪除成功');
    } else {
        return self::response(400,"SQL錯誤");
    }
}
static function update($sql,$args){
    DB::connect();
    if (self::$conn==NULL) return self::response(14, "無法開啟DB");
    $stmt = self::$conn->prepare($sql);
    $result = $stmt->execute($args);

           if ($result) {
              $count=$stmt->rowCount();
              return ($count<1)? self::response(204,'更新失敗'): self::response(200,'更新成功');
            }
            else {
                return self::response(400,"SQL錯誤");
        }
}
}


?>