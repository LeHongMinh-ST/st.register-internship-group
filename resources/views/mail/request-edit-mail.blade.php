<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống đăng ký nguyện vọng TTCN/KLTN - Thông báo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }
        .content p {
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #0c83ff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Thông báo</h1>
    </div>
    <div class="content">
        <p>Xin chào {{ $student->name }},</p>
        <p>Chúng tôi nhận được yêu cầu của bạn cần cập nhật thông tin nhóm đăng ký TTCN/KLTN.</p>
        <p>Vui lòng nhấn vào nút bên dưới để chỉnh sửa thông tin:</p>
        <a href="{{ $editLink }}" class="button">Chỉnh sửa thông tin</a>
        <p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.</p>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} ST TEAM - Khoa công nghệ thông tin - Học viện Nông nghiệp Việt Nam.</p>
    </div>
</div>
</body>
</html>
