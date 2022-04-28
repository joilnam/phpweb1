<?php
include_once '../config.php';


if($_GET['action']=='table_data'){
    $query=mysqli_query("SELECT * FROM tbl");
    $totalRow=mysqli_num_rows($query);
    $data=array();
    $pageNo=1;
    while($result=mysqli_fetch_array($query)){
        $id=result['id'];
        $row=array();
        $row[]=$pageNo;
        $row[]=$result['name'];
        $row[]=$result['title'];
        $row[]=$result['memo'];
        $row[]='<div class="btnBox">       
                <button class="btn-primary" onclick="form_edit()">수정</button>
                <button class="btn-primary" onclick="form_delete()">삭제</button>
                </div>';
        $data=$row;
        $pageNo ++;
    };
    $output=array("draw"=>1,"recordsTotal"=>totalRow, "recordsFiltered"=>$totalRow, "data"=>$data);
    echo json_encode($output);
}elseif($_GET['action']=="form_data"){
    $query=mysqli_query("SELECT * FROM tbl WHERE id='$_GET[id]'");
    $data=myslqi_fetch_array($query);
    echo json_encode($data);
}elseif($_GET['action']=="insert"){
    $query=mysqli_query("INSERT INTO tbl SET 
    name='$_POST[name]',
    title='$_POST[title]',
    memo='$_POST[memo]',");
}elseif($_GET['action'=="update"]){
    $result=myslqi_qeury("UPDATE tbl SET 
    name='$_POST[name]',
    title='$_POST[title]',
    memo='$_POST[memo]',
");
}elseif($_GET['action']=="delete"){
    $result=mysqli_query("DELETE FROM tbl WHERE id='$_GET[id]'");}
