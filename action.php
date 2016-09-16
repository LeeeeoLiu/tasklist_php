<?php
//1.连接数据库
try {
    $pdo = new PDO("mysql:host=localhost;dbname=Tasklist_php;", "root", "liuyuan.xing");
} catch (PDOException $e) {
    die("数据库连接失败" . $e->getMessage());
}

//2.通过action的值做地应操作
switch ($_GET['action']) {
    case "add"://增加操作
        $content = $_POST['content'];
        $if_done = false;

        $sql = "insert into tasklist values(null,'{$content}','{$if_done}')";
        $rw = $pdo->exec($sql);
        if ($rw > 0) {
            echo "<script>window.location='index.php'</script>";
        } else {
            echo "<script>alert('Failure');window.history.back();</script>";
        }
        break;

    case "del"; //删除操作
        $id = $_GET['id'];
        $sql = "delete from tasklist where id={$id}";
        $pdo->exec($sql);
        header("Location:index.php");
        echo "<script>window.location='index.php'</script>";
        break;

    case "edit":
        //1.获取表单信息
        $id = $_GET['id'];
        $content = $_POST['content_edit'];
        $sql = "update tasklist set content='{$content}' where id={$id}";
        $rw = $pdo->exec($sql);
        if ($rw > 0) {
            echo "<script>window.location='index.php'</script>";
        } else {
            echo "<script>alert('Failure');window.history.back();</script>";
        }
        break;

    case "done":
        //1.获取表单信息
        $if_done = true;
        $id = $_GET['id'];
        $sql = "update tasklist set if_done='{$if_done}' where id={$id}";
        $rw = $pdo->exec($sql);
        if ($rw > 0) {
            echo "<script>window.location='index.php'</script>";
        } else {
            echo "<script>alert('Failure');window.history.back();</script>";
        }
        break;

    case "redo":
        //1.获取表单信息
        $if_done = false;
        $id = $_GET['id'];
        $sql = "update tasklist set if_done='{$if_done}' where id={$id}";
        $rw = $pdo->exec($sql);
        if ($rw > 0) {
            echo "<script>window.location='index.php'</script>";
        } else {
            echo "<script>alert('Failure');window.history.back();</script>";
        }
        break;
}





