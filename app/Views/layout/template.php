<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buah Tangan Gaharu</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <!-- FONT PREMIUM -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICON -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {

            --primary: #A15C2F;
            --secondary: #D9A05B;
            --bg: #F9F6F2;
            --white: #ffffff;
            --text: #2D2D2D;
            --soft: #FFFFFF;
            --border: #EFE7DE;
        }

        body {
    background: var(--bg);
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
    color: var(--text);
    scroll-behavior: smooth;
}

        a {
            text-decoration: none;
        }

        /* ======================
           SIDEBAR
        ====================== */

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg,
                    #fffdfb 0%,
                    #f7efe7 100%);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 999;
            padding: 25px 18px;
            border-right: 1px solid #eee;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .logo {
            font-size: 30px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 45px;
            font-family: 'Playfair Display', serif;
            line-height: 1.2;
        }

        .logo i {
            color: var(--secondary);
        }

        .sidebar .nav-link {
    color: #5B4A42;
    padding: 14px 16px;
    border-radius: 14px;
    margin-bottom: 10px;
    font-size: 14px;
    font-weight: 500;
    transition: .3s;
}

        .sidebar .nav-link i {
            margin-right: 10px;
            font-size: 18px;
        }

        .sidebar .nav-link:hover {
            background: var(--secondary);
            color: white;
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
    background: #A15C2F;
    color: white !important;
    box-shadow: 0 8px 20px rgba(161, 92, 47, .18);
}

        /* ======================
           MAIN CONTENT
        ====================== */

        .main-content {
            margin-left: 240px;
            padding: 28px;
            min-height: 100vh;
        }

        /* ======================
           TOPBAR
        ====================== */

        .topbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            padding: 18px 22px;
            margin-bottom: 28px;
            border: 1px solid #f0e5db;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        }

        .search-box {
            border-radius: 14px;
            border: 1px solid var(--border);
            height: 48px;
            padding-left: 18px;
            background: #fff;
            color: var(--text);
        }

        .search-box:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 4px rgba(217, 119, 6, 0.10);
        }

        .icon-btn {
            width: 45px;
            height: 45px;
            border-radius: 14px;
            border: none;
            background: #fff4eb;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: 0.3s;
        }

        .icon-btn:hover {
            background: var(--secondary);
            color: white;
            transform: translateY(-2px);
        }

        .profile-img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        /* ======================
           CARD
        ====================== */

        .card-custom {
            background: white;
            border-radius: 24px;
            padding: 28px;
            border: 1px solid #f0e5db;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .product-card img {
    transition: .4s;
}

.product-card:hover img {
    transform: scale(1.05);
}

        /* ======================
           TABLE
        ====================== */

        .table {
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .table thead th {
            border: none;
            color: #8b7a70;
            font-size: 14px;
            font-weight: 600;
        }

        .table tbody tr {
            background: white;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.03);
        }

        .table tbody td {
            border: none;
            vertical-align: middle;
            padding: 18px 15px;
            color: #4d3b33;
        }

        /* ======================
           BUTTON
        ====================== */

        .btn-primary {
            background: var(--secondary);
            border: none;
            border-radius: 14px;
            padding: 11px 20px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background: #b96000;
        }

        .btn-danger {
            border-radius: 14px;
            background: #c2410c;
            border: none;
            padding: 10px 18px;
        }

        .btn-danger:hover {
            background: #9a3412;
        }

        /* ======================
           FOOTER
        ====================== */

        footer {
            margin-top: 35px;
            text-align: center;
            color: #8b7a70;
            font-size: 14px;
        }

        /* ======================
           MOBILE
        ====================== */

        @media(max-width: 991px) {

            .sidebar {
                width: 90px;
                padding: 20px 10px;
            }

            .logo span {
                display: none;
            }

            .sidebar .nav-link span {
                display: none;
            }

            .sidebar .nav-link i {
                margin-right: 0;
            }

            .main-content {
                margin-left: 90px;
            }
        }

        @media(max-width:768px) {

            .topbar {
                flex-direction: column;
                gap: 15px;
            }

            .search-area {
                width: 100%;
            }

            .search-box {
                width: 100% !important;
            }

            .topbar-right {
                width: 100%;
                justify-content: space-between;
            }
        }

        #cartBadge {
            position: absolute !important;
            top: -6px !important;
            right: -6px !important;
            min-width: 18px !important;
            width: auto !important;
            height: 18px !important;
            border-radius: 50% !important;
            background-color: #dc3545 !important;
            color: #fff !important;
            font-size: 11px !important;
            line-height: 1 !important;
            align-items: center !important;
            justify-content: center !important;
            border: 2px solid #F9F6F2 !important;
            padding: 0 3px !important;
            transform: none !important;
        }
    </style>
</head>

<body>

    <?= $this->include('layout/sidebar') ?>

    <div class="main-content">

        <?= $this->include('layout/navbar') ?>

        <?= $this->renderSection('content') ?>

        <?= $this->include('layout/footer') ?>

    </div>

</body>

</html>
