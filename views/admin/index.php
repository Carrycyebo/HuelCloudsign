<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>用户管理</title>
    <link rel="stylesheet" href="../../static/pkg/bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <script src="../../static/pkg/jquery -3.6.1/jquery-3.6.1.min.js"></script>
    <link rel="stylesheet" href="../../static/css/admin/index.css">
</head>
<body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active disabled" href="#">
            <?php 
              include_once "../../models/core_mysql.php";
              if(isset($_SESSION) && $_SESSION['adminName'] != ""){
                 echo "当前操作员：" .$_SESSION['adminName'];
              }
              else{
                echo "<script>window.location.href='./login.html'</script>";
              }

             ?>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./useradd.html">添加新用户</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout.php">注销</a>
        </li>
      </ul>
    <div class="container">
        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">序号</th>
                <th scope="col">姓名</th>
                <th scope="col">学号</th>
                <th scope="col">今天是否打卡</th>
                <th scope="col">打卡日期</th>
              </tr>
            </thead>
            <tbody id="userList">
              <!-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr> -->
            </tbody>
          </table>
          
    </div>
    <script src="../../static/pkg/bootstrap-4.6.2-dist/js/bootstrap.min.js"></script>
    <script>
        fetch('../../apis/admin/getUserList.php',{
            method : 'GET',
            mode : 'cors',
            credentials : 'include'
        }).then(response => {
            return response.json()
        }).then(
            data => {
              let userList = document.querySelector("#userList");
              
              data.forEach(v =>{
                if (v[3] == 1){
                  isSign = '已打卡'
                }
                else{
                  isSign = '未打卡'
                }
                userList.innerHTML += `
                <tr>
                  <th scope="row">${v[0]}</th>
                  <td>${v[1]}</td>
                  <td>${v[2]}</td>
                  <td>${isSign}</td>
                  <td>${v[4]}</td>
                </tr>
              `;
              })

              userList
              console.log(data)
            }
        )
    </script>
</body>
</html>