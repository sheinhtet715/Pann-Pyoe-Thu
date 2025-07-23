<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <title>Footer</title>
</head>
<body>
    <div class="bottom">
        <div class="bottom-left">
            <a class="about-us" href="#">About Us</a>
            <br>
            <a class="education-counselling" href="#">Education Counselling</a>
            <br>
            <a class="local-universities" href="#">Local Universities</a>
            <br>
            <a class="job-opportunities" href="#">Job Opportunities</a>
            <br>
            <a class="scholarships" href="#">Scholarships</a>
            <br>
            <a class="available-courses" href="#">Available Courses</a>
        </div>

        <div class="bottom-middle">
            <p>Contact Us:</p>
            <p>09672659692</p>
            <p>pannpyoethu26@gmail.com</p>
        </div>

        <div class="bottom-right">
            <p>Follow Us On:</p>
            <i class="fab fa-facebook"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-twitter"></i>
        </div>
    </div>
</body>
<style>
 
/* Bottom Section */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #3A9BA5;
    padding: 20px 40px;
    flex-wrap: wrap;
    color: black;
    gap: 20px;
}

.bottom a {
    text-decoration: none;
    color: black;
    font-size: 20px;
    margin-left: 5px;
    transition: all 0.3s ease;
    padding: 5px 10px;
    border-radius: 5px;
}

.bottom a:hover {
    background-color: rgba(0, 0, 0, 0.1);
    transform: translateY(-1px);
}

.bottom p {
    font-size: 20px;
}

.bottom-left, .bottom-middle, .bottom-right {
    flex: 1;
    text-align: center;
    min-width: 200px;
}

.bottom-left {
    text-align: left;
    color: black;
}

.bottom-right {
    text-align: right;
}

.fab {
    font-size: 24px;
    margin-right: 6px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.fab:hover {
    transform: scale(1.2);
}

.fa-facebook { color: #1877f2; }
.fa-instagram { color: #e1306c; }
.fa-twitter { color: #1DA1F2; }

@media (max-width: 768px) {
    
    .bottom {
        flex-direction: column;
        text-align: center;
        padding: 20px;
    }

    .bottom-left, .bottom-right {
        text-align: center;
    }

    .modal-content {
        width: 95%;
        margin: 20px auto;
    }

    .login-container {
        flex-direction: column;
    }

    .login-left {
        border-radius: 25px 25px 0 0;
    }
}
</style>
</html>