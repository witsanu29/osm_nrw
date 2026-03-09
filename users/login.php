<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){

        $user = $result->fetch_assoc();

        if(password_verify($password,$user['password'])){

            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];

            header("Location: ../dashboard.php");
            exit;

        }else{
            echo "❌ รหัสผ่านไม่ถูกต้อง";
        }

    }else{
        echo "❌ ไม่พบผู้ใช้งาน";
    }

}
?>

<!DOCTYPE html>
<html lang="th">
<head>

<meta charset="UTF-8">
<title>Login System</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
height:100vh;
display:flex;
align-items:center;
justify-content:center;
background: linear-gradient(135deg,#4facfe,#00f2fe);
font-family: 'Prompt', sans-serif;
}

.login-card{
width:380px;
padding:35px;
border-radius:20px;
background:rgba(255,255,255,0.15);
backdrop-filter: blur(10px);
box-shadow:0 10px 40px rgba(0,0,0,0.2);
color:white;
}

.login-title{
font-size:28px;
font-weight:bold;
text-align:center;
margin-bottom:25px;
}

.form-control{
border-radius:10px;
padding:12px;
}

.btn-login{
background:#fff;
color:#333;
font-weight:bold;
border-radius:10px;
padding:12px;
transition:0.3s;
}

.btn-login:hover{
background:#f1f1f1;
transform:scale(1.03);
}

.logo{
font-size:40px;
text-align:center;
margin-bottom:10px;
}

</style>

</head>

<body>

<div class="login-card">

<div class="logo">🔐</div>
<div class="login-title">เข้าสู่ระบบ</div>

<?php if(isset($error)){ ?>

<div class="alert alert-danger text-center">
<?php echo $error; ?>
</div>

<?php } ?>

<form method="POST">

<div class="mb-3">
<input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้" required>
</div>

<div class="mb-3">
<input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
</div>

<div class="d-grid">
<button class="btn btn-login">เข้าสู่ระบบ</button>
</div>

</form>

<div class="text-center mt-3">
<small>ระบบจัดการข้อมูล</small>
</div>

</div>

</body>
</html>