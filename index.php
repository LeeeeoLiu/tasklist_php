<html>
<head>
    <meta charset="UTF-8">
    <title>Tasklist</title>
    <script src="angular.min.js"></script>
</head>
<script>
    function doDel(id) {
        if (confirm("确定要删除吗？")) {
            window.location = 'action.php?action=del&id=' + id;
        }
    }
</script>
<body>
<div ng-app="myTask" ng-controller="taskCtrl">
    <center>
        <!--    --><?php //include("menu.php");?>

        <h1>Add task</h1>
        <form action="action.php?action=add" method="post">
            <table>
                <tr>
                    <td><input type="text" name="content"/></td>
                    <td>
                        <input type="submit" value="Submit"/>
                    </td>
                </tr>
            </table>
        </form>

        <h1>Todolist</h1>
        <table width="600" border="1">
            <?php
            //1.连接数据库
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=Tasklist_php;", "root", "liuyuan.xing");
            } catch (PDOException $e) {
                die("数据库连接失败" . $e->getMessage());
            }
            //2.执行SQL查询，并解析与遍历
            $sql = "select * from tasklist";
            foreach ($pdo->query($sql) as $row) {
                if (!$row['if_done']) {
                    echo "<tr>";
                    echo "<td>{$row['content']}</td>";
                    echo "<td>
                    <form action='action.php?action=del&id={$row['id']}' method='post'>
                          <button type='submit'>Delete</button>
                    </form></td>";
                    echo "<td><button ng-click='toggle()'>Edit Task</button></td>";
                    echo "<td>
                           <form action='action.php?action=edit&id={$row['id']}' method='post'  ng-show='myVar'>
                                <div class='form-group'>
                                    <div>
                                        <input type='text' name='content_edit' id='task-name' class='form-control'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <div>
                                        <button type='submit'>Submit your change</button>
                                    </div>
                                </div>
                            </form></td>";
                    echo "<td><form action='action.php?action=done&id={$row['id']}' method='post'>
                          <button type='submit'>Finish</button></form></td>";
                    echo "</tr>";
                }
            }

            ?>
        </table>
        <br>
        <br>
        <h1>Finishlist</h1>
        <table width="600" border="1">
            <?php
            //1.连接数据库
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=Tasklist_php;", "root", "liuyuan.xing");
            } catch (PDOException $e) {
                die("数据库连接失败" . $e->getMessage());
            }
            //2.执行SQL查询，并解析与遍历
            $sql = "select * from tasklist";
            foreach ($pdo->query($sql) as $row) {
                if ($row['if_done']) {
                    echo "<tr>";
                    echo "<td>{$row['content']}</td>";
                    echo "<td>
                    <form action='action.php?action=del&id={$row['id']}' method='post'>
                          <button type='submit'>Delete</button>
                    </form></td>";
                    echo "<td><button ng-click='toggle()'>Edit Task</button></td>";
                    echo "<td>
                           <form action='action.php?action=edit&id={$row['id']}' method='post'  ng-show='myVar'>
                                <div class='form-group'>
                                    <div>
                                        <input type='text' name='content_edit' id='task-name' class='form-control'>
                                    </div>
                                </div>
                                <div class='form-group'>
                                    <div>
                                        <button type='submit'>Submit your change</button>
                                    </div>
                                </div>
                            </form></td>";
                    echo "<td><form action='action.php?action=redo&id={$row['id']}' method='post'>
                          <button type='submit'>Redo</button>
                    </form></td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </center>
</div>

<script>
    var app = angular.module('myTask', []);
    app.controller('taskCtrl', function ($scope) {
        $scope.myVar = false;
        $scope.toggle = function () {
            $scope.myVar = !$scope.myVar;
        };
    });
</script>
</body>
</html>


