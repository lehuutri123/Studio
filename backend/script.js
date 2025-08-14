let isLogin = true;

function toggleMode() {
    isLogin = !isLogin;
    document.getElementById("form-title").innerText = isLogin ? "Đăng nhập" : "Đăng ký";
    document.getElementById("toggle-msg").innerHTML = isLogin
        ? `Chưa có tài khoản? <a href='#' onclick='toggleMode()'>Đăng ký</a>`
        : `Đã có tài khoản? <a href='#' onclick='toggleMode()'>Đăng nhập</a>`;
    document.getElementById("message").innerText = "";
}

function handleAction(event) {
    event.preventDefault();
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value;

    if (!username || !password) {
        document.getElementById("message").style.color = "red";
        document.getElementById("message").innerText = "Vui lòng nhập đầy đủ thông tin.";
        return;
    }

    if (isLogin) {
        const userData = localStorage.getItem(username);
        const savedUser = userData ? JSON.parse(userData) : null;

        if (savedUser && savedUser.password === password) {
            localStorage.setItem("loggedInUser", username);
            window.location.href = "TrangChu.html"; 
        } else {
            document.getElementById("message").style.color = "red";
            document.getElementById("message").innerText = "Sai tên đăng nhập hoặc mật khẩu!";
        }
    } else {
        if (localStorage.getItem(username)) {
            document.getElementById("message").style.color = "red";
            document.getElementById("message").innerText = "Tài khoản đã tồn tại!";
        } else {
            localStorage.setItem(username, JSON.stringify({ username, password }));
            document.getElementById("message").style.color = "green";
            document.getElementById("message").innerText = "Đăng ký thành công! Vui lòng đăng nhập.";
            toggleMode();
        }
    }
}

