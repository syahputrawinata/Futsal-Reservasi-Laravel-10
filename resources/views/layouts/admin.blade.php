<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            min-height: 100vh;
            display: flex;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .admin-sidebar {
            width: 250px;
            background-color: #0d6efd; /* Tema biru */
            color: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding-top: 20px;
            overflow-y: auto;
            transition: transform 0.4s cubic-bezier(0.25, 1, 0.5, 1); /* Smooth animasi */
        }
        .admin-sidebar.hide {
            transform: translateX(-100%);
        }
        .admin-sidebar a, .admin-sidebar button {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            border: none;
            background: none;
            text-align: left;
            width: 100%;
            font-size: 14px;
        }
        .admin-sidebar a:hover, .admin-sidebar button:hover {
            color: #fff;
            background-color: #084298;
        }
        .admin-sidebar .dropdown-btn {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-sidebar .dropdown-container {
            display: none;
            background-color: #1a73e8; /* Warna dropdown lebih muda */
            padding-left: 20px;
            transition: max-height 0.4s ease, opacity 0.4s ease; /* Dropdown lebih smooth */
            max-height: 0;
            overflow: hidden;
            opacity: 0;
        }
        .dropdown-container.show {
            max-height: 500px;
            opacity: 1;
        }
        .admin-main {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
            transition: margin-left 0.4s cubic-bezier(0.25, 1, 0.5, 1); /* Smooth animasi */
        }
        .admin-main.full {
            margin-left: 0;
        }
        .toggle-sidebar {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1000;
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }
        .toggle-sidebar:hover {
            background-color: #084298;
            transform: scale(1.05);
        }
        .toggle-sidebar:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar" id="sidebar">
        <h3 class="text-center py-5">Admin Panel</h3>
        <a href="admin.dashboard">Dashboard</a>

        <!-- Field Management -->
        <button class="dropdown-btn">
            Field Management
            <span>&#x25BC;</span>
        </button>
        <div class="dropdown-container">
            <a href="">Booking Field</a>
            <a href="">Add Field</a>
            <a href="">Manage Fields</a>
        </div>

        <!-- User Management -->
        <button class="dropdown-btn">
            User Management
            <span>&#x25BC;</span>
        </button>
        <div class="dropdown-container">
            <a href="">Manage Accounts</a>
            <a href="">Permissions</a>
        </div>

        <!-- Settings -->
        <a href="">Settings</a>
        <a href="{{ route('logout') }}">Logout</a>
    </div>

    <!-- Toggle Sidebar Button -->
    <button class="toggle-sidebar" id="toggleButton">☰</button>

    <!-- Main Content -->
    <div class="admin-main" id="main">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Sidebar Toggle JS -->
    <script>
        const toggleButton = document.getElementById('toggleButton');
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main');
        const dropdownButtons = document.querySelectorAll('.dropdown-btn');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('hide');
            main.classList.toggle('full');
        });

        dropdownButtons.forEach(button => {
            button.addEventListener('click', () => {
                const dropdown = button.nextElementSibling;
                dropdown.classList.toggle('show');
            });
        });
    </script>
</body>
</html>
