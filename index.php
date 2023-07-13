<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styler.css">
    <title>LOGIN</title>
</head>
<body>
    
    <?php
        $_SESSION['loginT'] = false;
        $host="localhost";
        $username="root";
        $password="";
        $database="quan_ly_nhan_vien";

        $conn = mysqli_connect($host,$username,$password,$database);
        mysqli_query($conn,"SET NAME 'utf8'");

        if($conn->connect_error)
        {
            die("Kết nối thất bại đến CSDL, Lỗi: ".$conn->connect_error);
        }
        $annou = $user = $pass = $login="";
       
        if(isset($_POST['login']))
        {
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            if(!empty($user)&&!empty($pass))
            {
                $sql = "SELECT * FROM `nhanvien` where `idNhanVien` = '$user' and `passWord` = '$pass'";
                $result = mysqli_query($conn,$sql);
                
                $login = $result->num_rows;

            } 
            
            if($login>=1)
            {
                $_SESSION['IDLOGIN'] = $user;
                $_SESSION['loginT'] = true;
                // $_SESSION['logout'] = false;
                header('location: Start.html');
                // $annou = "Hello ".$user;
            }
            else
            {
                $annou = "Tên đăng nhập hoặc mật khẩu không chính xác";
            }
        }  
    ?>
    <div id="main">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="form-login">
            <h2 class="heading">Đăng nhập</h2>
            <div class="box">
                <label for="user">Tên đăng nhập</label>
                <input type="text" id="user" name="user" placeholder="Tên đăng nhập" required class="form-control" value="<?php echo $user ?>">
            </div>
            <div class="box">
                <label>Mật khẩu</label>
                <input type="password" id="pass" name="pass" placeholder="Mật khẩu" required class="form-control">
            </div>
            <div class="tbao">
                <p><?php echo $annou ?></p>
            </div>
            <div class="box1">
                <input type="submit" class="login" name="login" value="Đăng nhập">
                <input type="submit" class="login" name="Test" value="Test dữ liệu">
            </div>
        </form>
    </div>
    <div id="test_dl">
       <div class="work-table">
            <h1>Danh sách dữ liệu sử dụng Test truy vấn</h1>
            <p>Mật khẩu mặc định là: 1</p>
            <?php 
                $sql = "SELECT * FROM `nhanvien` where `idNhanVien` != 'AD'";
                $result = mysqli_query($conn,$sql);
                if ($result->num_rows > 0)
                {
                    echo "<table class='tab'>
                            <tr>
                                <th>ID Nhân Viên</th>
                                <th>Họ Tên</th>
                                <th>Chức Vụ</th>
                                <th>Số Điện Thoại</th>
                                <th>Email</th>
                            </tr>";//</table>
                    while($row = mysqli_fetch_row($result))
                    {
                        echo "<tr>
                                <td>".$row[0]."</td> <td>"
                                .$row[1]."</td> <td>"
                                .$row[2]."</td> <td>"
                                .$row[3]."</td> <td>"
                                .$row[4]."</td> </tr>";
                        }
                    echo "</table>";
                }
            ?>
        </div>

        <div class="work-table">
            <h1>Dữ liệu truy vấn được</h1>
            <p>Tên đăng nhập: admin' or 1=1#, Mật khẩu lúc này nhập bừa cũng có thể truy xuất csdl</p>
            <?php 
                if(isset($_POST['Test']))
                {
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $sql = "SELECT * FROM `nhanvien` where `idNhanVien` = '$user' and `passWord` = '$pass'";
                    $result = mysqli_query($conn,$sql);
                    if ($result->num_rows > 0)
                    {
                        echo "<table class='tab'>
                                <tr>
                                    <th>ID Nhân Viên</th>
                                    <th>Họ Tên</th>
                                    <th>Chức Vụ</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Email</th>
                                </tr>";//</table>
                        while($row = mysqli_fetch_row($result))
                        {
                            echo "<tr>
                                    <td>".$row[0]."</td> <td>"
                                    .$row[1]."</td> <td>"
                                    .$row[2]."</td> <td>"
                                    .$row[3]."</td> <td>"
                                    .$row[4]."</td> </tr>";
                            }
                        echo "</table>";
                    }
                }
                
            ?>
        </div>
    </div>
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>