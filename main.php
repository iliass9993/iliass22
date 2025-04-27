<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Now - Premium Streaming</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        /* Mobile Menu Styles */
        .mobile-menu-toggle {
            display: none;
            color: white;
            font-size: 24px;
            margin-right: 20px;
            cursor: pointer;
        }

        .mobile-menu {
            position: fixed;
            top: 80px;
            left: 0;
            width: 100%;
            height: calc(100vh - 80px);
            background: rgba(0, 0, 0, 0.95);
            z-index: 999;
            display: none;
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
        }

        .mobile-menu ul {
            list-style: none;
        }

        .mobile-menu li {
            margin-bottom: 20px;
        }

        .mobile-menu a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .mobile-menu a:hover {
            color: #FFD700;
            padding-left: 10px;
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }

            .nav-links {
                display: none;
            }
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: #000;
            color: #fff;
            overflow-x: hidden;
        }

        /* Active section highlight */
        .content-section:target {
            padding-top: 80px;
            margin-top: -80px;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .modal::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .modal-content {
            text-align: center;
            position: relative;
            z-index: 2;
            animation: fadeInUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal h2 {
            font-size: 48px;
            margin-bottom: 50px;
            color: #FFD700;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .profiles-container {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
            max-width: 900px;
            margin: 0 auto;
        }

        .profile-select {
            cursor: pointer;
            transition: transform 0.3s ease-out, filter 0.3s ease;
            position: relative;
        }

        .profile-select:hover {
            transform: translateY(-10px) scale(1.05);
            filter: brightness(1.1);
        }

        .profile-select img {
            width: 180px;
            height: 180px;
            border-radius: 8px;
            border: 4px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            object-fit: cover;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .profile-select:hover img {
            border-color: #FFD700;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .profile-select span {
            display: block;
            margin-top: 15px;
            font-size: 20px;
            color: #fff;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .profile-select:hover span {
            color: #FFD700;
        }

        .profile-select::after {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border-radius: 12px;
            background: rgba(255, 215, 0, 0.1);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .profile-select:hover::after {
            opacity: 1;
        }

        /* Search Overlay Styles */
        .search-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            z-index: 1500;
            padding: 20px 50px;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .search-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #333;
        }

        .search-header i {
            font-size: 24px;
            color: #FFD700;
            margin-right: 20px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .search-header i:hover {
            transform: scale(1.1);
        }

        .search-header input {
            flex: 1;
            background: transparent;
            border: none;
            color: #fff;
            font-size: 24px;
            padding: 10px;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-header input:focus {
            color: #FFD700;
        }

        .search-results {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .search-result-item {
            cursor: pointer;
            transition: all 0.3s ease;
            transform-origin: center;
        }

        .search-result-item:hover {
            transform: scale(1.05);
            z-index: 1;
        }

        .search-result-item img {
            width: 100%;
            border-radius: 4px;
            transition: transform 0.3s ease;
        }

        .search-result-item:hover img {
            transform: scale(1.03);
        }

        .search-result-item h4 {
            margin-top: 10px;
            font-size: 16px;
            transition: color 0.2s ease;
        }

        .search-result-item:hover h4 {
            color: #FFD700;
        }

        /* Notifications Dropdown */
        .notifications-dropdown {
            display: none;
            position: absolute;
            top: 60px;
            right: 50px;
            width: 350px;
            max-height: 500px;
            overflow-y: auto;
            background-color: #141414;
            border-radius: 4px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
            z-index: 1001;
            padding: 15px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .notifications-dropdown h3 {
            margin-bottom: 15px;
            color: #FFD700;
            font-size: 18px;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
        }

        .notification-item {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #333;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .notification-item:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }

        .notification-item img {
            width: 50px;
            height: 50px;
            border-radius: 4px;
            margin-right: 15px;
            object-fit: cover;
            transition: transform 0.2s ease;
        }

        .notification-item:hover img {
            transform: scale(1.05);
        }

        .notification-text {
            flex: 1;
        }

        .notification-text p {
            font-size: 14px;
            margin-bottom: 5px;
            transition: color 0.2s ease;
        }

        .notification-item:hover .notification-text p {
            color: #FFD700;
        }

        .notification-text small {
            color: #808080;
            font-size: 12px;
        }

        .notification-icon {
            position: relative;
            cursor: pointer;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #FFD700;
            color: #000;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Navbar Styles */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
            transition: all 0.3s ease;
            transform: translateY(0);
        }

        .navbar.hidden {
            transform: translateY(-100%);
        }

        .navbar.scrolled {
            background-color: rgba(0, 0, 0, 0.95);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .navbar-left {
            display: flex;
            align-items: center;
        }

        .logo {
            color: #FFD700;
            font-size: 32px;
            font-weight: 700;
            margin-right: 40px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .nav-links {
            display: flex;
            list-style: none;
        }

        .nav-links li {
            margin-right: 20px;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #FFD700;
            font-weight: 600;
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #FFD700;
            animation: underlineGrow 0.3s ease-out;
        }

        @keyframes underlineGrow {
            from {
                transform: scaleX(0);
            }

            to {
                transform: scaleX(1);
            }
        }

        .navbar-right {
            display: flex;
            align-items: center;
        }

        .navbar-right i {
            color: #fff;
            font-size: 20px;
            margin-left: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .navbar-right i:hover {
            color: #FFD700;
            transform: scale(1.1);
        }

        .back-btn {
            display: none;
            margin-right: 20px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .back-btn:hover {
            transform: translateX(-5px);
        }

        .details-page~.navbar .back-btn {
            display: block;
        }

        .profile {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .profile:hover {
            transform: scale(1.05);
        }

        .profile img {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            margin-left: 20px;
            transition: all 0.3s ease;
        }

        .profile:hover img {
            border: 1px solid #FFD700;
        }

        .profile span {
            margin-left: 10px;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .profile:hover span {
            color: #FFD700;
        }

        .profile-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #141414;
            border: 1px solid #333;
            border-radius: 4px;
            width: 180px;
            z-index: 100;
            margin-top: 5px;
            animation: fadeIn 0.2s ease-out;
        }

        .profile-option {
            padding: 10px 15px;
            color: #fff;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .profile-option:hover {
            background-color: #333;
            color: #FFD700;
            padding-left: 20px;
        }

        /* Hero Section Styles */
        .hero {
            height: 100vh;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
            display: flex;
            align-items: center;
            padding: 0 50px;
            margin-top: -80px;
            position: relative;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .hero-bg.active {
            opacity: 1;
        }

        .hero-content {
            max-width: 600px;
            animation: fadeInLeft 0.8s ease-out;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hero h1 {
            font-size: 60px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            color: #FFD700;
            transition: all 0.5s ease;
        }

        .hero-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .hero-info span {
            margin-right: 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .rating {
            color: #46d369;
            font-weight: 600;
        }

        .hero-description {
            font-size: 18px;
            line-height: 1.5;
            margin-bottom: 30px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
            transition: all 0.5s ease;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .play-btn,
        .info-btn,
        .add-btn {
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .play-btn {
            background-color: #FFD700;
            color: #000;
        }

        .play-btn:hover {
            background-color: #ffea00;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
        }

        .info-btn {
            background-color: rgba(109, 109, 110, 0.7);
            color: #fff;
        }

        .info-btn:hover {
            background-color: rgba(109, 109, 110, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(109, 109, 110, 0.2);
        }

        .add-btn {
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: 1px solid #fff;
        }

        .add-btn:hover {
            background-color: rgba(255, 215, 0, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.1);
        }

        .add-btn.added {
            background-color: #FFD700;
            color: #000;
            border: 1px solid #FFD700;
        }

        .play-btn i,
        .info-btn i,
        .add-btn i {
            margin-right: 10px;
            transition: transform 0.2s ease;
        }

        .play-btn:hover i,
        .info-btn:hover i,
        .add-btn:hover i {
            transform: scale(1.1);
        }

        /* 3D Graphics Elements */
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            opacity: 0.1;
            filter: blur(30px);
            animation: float 15s infinite ease-in-out;
            transform-style: preserve-3d;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, #FFD700 0%, transparent 70%);
            top: 20%;
            left: 10%;
            animation-delay: 0s;
            transform: rotateX(20deg) rotateY(30deg);
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #ff00aa 0%, transparent 70%);
            bottom: 10%;
            right: 10%;
            animation-delay: 2s;
            animation-duration: 20s;
            transform: rotateX(40deg) rotateY(10deg);
        }

        .shape-3 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, #00aaff 0%, transparent 70%);
            top: 60%;
            left: 30%;
            animation-delay: 4s;
            animation-duration: 25s;
            transform: rotateX(10deg) rotateY(50deg);
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            25% {
                transform: translate(50px, 50px) rotate(90deg);
            }

            50% {
                transform: translate(100px, 0) rotate(180deg);
            }

            75% {
                transform: translate(50px, -50px) rotate(270deg);
            }

            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        /* Content Section Styles */
        .content {
            padding: 50px;
            margin-top: -150px;
            position: relative;
            z-index: 1;
        }

        .content-section {
            margin-bottom: 50px;
            transition: all 0.5s ease;
        }

        .category-section {
            display: none;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 24px;
            color: #FFD700;
            transition: all 0.3s ease;
        }

        .section-title:hover {
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .carousel-nav {
            display: flex;
            gap: 10px;
        }

        .carousel-btn {
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .carousel-btn:hover {
            background-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.1);
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
        }

        .carousel {
            display: flex;
            scroll-behavior: smooth;
            padding: 20px 0;
            gap: 15px;
            overflow-x: auto;
            scrollbar-width: none;
            /* Firefox */
        }

        .carousel::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Opera */
        }

        .movie-item {
            min-width: 300px;
            height: 215px;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            flex-shrink: 0;
            transform-origin: center;
        }

        .movie-item:hover {
            transform: scale(1.1);
            z-index: 2;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }

        .movie-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .movie-item:hover img {
            transform: scale(1.05);
        }

        .movie-item.large {
            min-width: 300px;
            height: 170px;
        }

        .movie-item .overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0) 100%);
            padding: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .movie-item:hover .overlay {
            opacity: 1;
        }

        .movie-item .overlay h3 {
            font-size: 14px;
            margin-bottom: 5px;
            transition: color 0.2s ease;
        }

        .movie-item:hover .overlay h3 {
            color: #FFD700;
        }

        .movie-item .overlay .info {
            display: flex;
            font-size: 12px;
            color: #ccc;
        }

        .movie-item .overlay .info span {
            margin-right: 10px;
        }

        .empty-list {
            color: #999;
            font-style: italic;
            padding: 20px;
            animation: fadeIn 0.5s ease;
        }

        /* Video Player Styles */
        .video-player-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 3000;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        .video-player {
            width: 80%;
            max-width: 1200px;
            position: relative;
            animation: scaleUp 0.3s ease;
        }

        @keyframes scaleUp {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .video-player video {
            width: 100%;
            outline: none;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .close-player {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .close-player:hover {
            color: #FFD700;
            transform: scale(1.2);
        }

        /* Details Page Styles */
        .details-page {
            display: none;
            padding: 100px 50px 50px;
            min-height: 100vh;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.7) 100%);
            animation: fadeIn 0.5s ease;
        }

        .details-header {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
            animation: slideUp 0.5s ease;
        }

        .details-poster {
            width: 300px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }

        .details-poster:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
        }

        .details-info {
            flex: 1;
        }

        .details-info h1 {
            font-size: 36px;
            margin-bottom: 15px;
            color: #FFD700;
            transition: all 0.3s ease;
        }

        .details-info h1:hover {
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .details-meta {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: center;
            flex-wrap: wrap;
        }

        .details-overview {
            margin-bottom: 30px;
            line-height: 1.6;
            max-width: 800px;
            transition: all 0.3s ease;
        }

        .episodes-container {
            margin-top: 50px;
            animation: fadeIn 0.8s ease;
        }

        .episode-card {
            display: flex;
            background: #222;
            margin-bottom: 15px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .episode-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .episode-thumbnail {
            width: 200px;
            height: 120px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .episode-card:hover .episode-thumbnail {
            transform: scale(1.05);
        }

        .episode-info {
            padding: 15px;
            flex: 1;
        }

        .episode-title {
            font-weight: bold;
            margin-bottom: 5px;
            color: #FFD700;
            transition: all 0.2s ease;
        }

        .episode-card:hover .episode-title {
            color: #fff;
        }

        .episode-description {
            font-size: 14px;
            color: #ccc;
            transition: all 0.2s ease;
        }

        .episode-card:hover .episode-description {
            color: #fff;
        }

        /* Footer Styles */
        .footer {
            background-color: #000;
            padding: 50px;
            color: #757575;
            position: relative;
            z-index: 1;
        }

        .footer-content {
            max-width: 1000px;
            margin: 0 auto;
            animation: fadeIn 0.8s ease;
        }

        .social-icons {
            margin-bottom: 30px;
        }

        .social-icons i {
            font-size: 24px;
            margin-right: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .social-icons i:hover {
            color: #FFD700;
            transform: translateY(-5px);
        }

        .footer-links {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 15px;
        }

        .footer-links a {
            color: #757575;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: #FFD700;
            padding-left: 5px;
        }

        .copyright {
            font-size: 13px;
        }

        .no-results {
            color: #999;
            font-style: italic;
            padding: 20px;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }

        /* Email Entry Page */
        .email-entry-page {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 3000;
            color: white;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }

        .email-content {
            max-width: 800px;
            padding: 20px;
            animation: fadeInUp 0.5s ease;
        }

        .email-content h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #FFD700;
            transition: all 0.3s ease;
        }

        .email-content h1:hover {
            text-shadow: 0 0 15px rgba(255, 215, 0, 0.6);
        }

        .email-content h2 {
            font-size: 24px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .email-content p {
            font-size: 18px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .email-form {
            display: flex;
            max-width: 600px;
            margin: 0 auto;
            transition: all 0.3s ease;
        }

        .email-form:hover {
            transform: scale(1.02);
        }

        .email-form input {
            flex: 1;
            padding: 15px;
            font-size: 16px;
            border: none;
            border-radius: 4px 0 0 4px;
            transition: all 0.3s ease;
        }

        .email-form input:focus {
            outline: 2px solid #FFD700;
        }

        .email-form button {
            padding: 15px 30px;
            background: #FFD700;
            color: #000;
            border: none;
            border-radius: 0 4px 4px 0;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .email-form button:hover {
            background: #ffea00;
            transform: translateX(5px);
        }

        .login-link {
            margin-top: 20px;
            color: #ccc;
            transition: all 0.3s ease;
        }

        .login-link a {
            color: #FFD700;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .login-link a:hover {
            text-decoration: underline;
            text-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 400px;
            margin: 0 auto;
            animation: fadeIn 0.5s ease;
        }

        .login-form input {
            padding: 12px;
            border-radius: 4px;
            border: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .login-form input:focus {
            outline: 2px solid #FFD700;
            transform: scale(1.02);
        }

        .login-form button {
            padding: 12px;
            background: #FFD700;
            color: #000;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-form button:hover {
            background: #ffea00;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(255, 215, 0, 0.3);
        }

        /* Plans Page */
        .plans-page {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #141414;
            color: white;
            z-index: 3000;
            overflow-y: auto;
            padding: 50px 0;
            animation: fadeIn 0.5s ease;
        }

        .plans-content {
            max-width: 1000px;
            margin: 0 auto;
            text-align: center;
            animation: fadeInUp 0.5s ease;
        }

        .plans-content h1 {
            font-size: 36px;
            margin-bottom: 50px;
            color: #FFD700;
            transition: all 0.3s ease;
        }

        .plans-content h1:hover {
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .plans-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .plan-card {
            background: #222;
            border-radius: 8px;
            padding: 30px;
            width: 300px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            cursor: pointer;
            transform-style: preserve-3d;
            transform: perspective(1000px) rotateY(0deg);
        }

        .plan-card:hover {
            transform: perspective(1000px) rotateY(5deg) scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }

        .plan-card h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #FFD700;
        }

        .plan-card h4 {
            font-size: 28px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .plan-card:hover h4 {
            transform: scale(1.1);
        }

        .plan-card ul {
            list-style: none;
            margin-bottom: 30px;
            text-align: left;
        }

        .plan-card ul li {
            margin-bottom: 10px;
            position: relative;
            padding-left: 25px;
            transition: all 0.2s ease;
        }

        .plan-card:hover ul li {
            transform: translateX(5px);
        }

        .plan-card ul li:before {
            content: "✓";
            color: #FFD700;
            position: absolute;
            left: 0;
        }

        .plan-card button {
            background: #FFD700;
            color: #000;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        .plan-card button:hover {
            background: #ffea00;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
        }

        /* Payment Page */
        .payment-page {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #141414;
            color: white;
            z-index: 3000;
            padding: 50px 0;
            animation: fadeIn 0.5s ease;
        }

        .payment-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            animation: fadeInUp 0.5s ease;
        }

        .payment-content h1 {
            font-size: 36px;
            margin-bottom: 50px;
            color: #FFD700;
            transition: all 0.3s ease;
        }

        .payment-content h1:hover {
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
        }

        .payment-methods {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 50px;
        }

        .payment-card {
            background: #222;
            border-radius: 8px;
            padding: 30px;
            width: 300px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            transform-style: preserve-3d;
            transform: perspective(1000px) rotateY(0deg);
        }

        .payment-card:hover {
            background: #333;
            transform: perspective(1000px) rotateY(5deg) translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
        }

        .payment-card i {
            font-size: 50px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .payment-card:hover i {
            transform: scale(1.1);
            color: #FFD700;
        }

        .payment-card h3 {
            font-size: 24px;
            transition: all 0.3s ease;
        }

        .payment-card:hover h3 {
            color: #FFD700;
        }

        .card-details,
        .paypal-redirect {
            background: #222;
            border-radius: 8px;
            padding: 30px;
            max-width: 500px;
            margin: 0 auto;
            text-align: left;
            animation: fadeIn 0.5s ease;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            transition: all 0.2s ease;
        }

        .form-group:hover label {
            color: #FFD700;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 4px;
            border: 1px solid #444;
            background: #333;
            color: white;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #FFD700;
            box-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
            transform: scale(1.01);
        }

        .card-details button,
        .paypal-redirect button {
            background: #FFD700;
            color: #000;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        .card-details button:hover,
        .paypal-redirect button:hover {
            background: #ffea00;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
        }

        /* Progress bar for continue watching */
        .progress-bar {
            height: 4px;
            background-color: #FFD700;
            margin-top: 10px;
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .hero h1 {
                font-size: 48px;
            }

            .hero-description {
                font-size: 16px;
            }

            .details-header {
                flex-direction: column;
            }

            .details-poster {
                width: 100%;
                max-width: 300px;
                margin: 0 auto 20px;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }

            .logo {
                font-size: 24px;
                margin-right: 20px;
            }

            .nav-links {
                display: none;
            }

            .hero {
                padding: 0 20px;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero-description {
                font-size: 14px;
            }

            .content {
                padding: 20px;
            }

            .footer-links {
                grid-template-columns: repeat(2, 1fr);
            }

            .search-overlay {
                padding: 20px;
            }

            .search-header input {
                font-size: 18px;
            }

            .search-results {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }

            .plans-container,
            .payment-methods {
                flex-direction: column;
                align-items: center;
            }

            /* Responsive styles for details page */
            .details-page {
                padding: 80px 20px 20px;
            }

            .episode-card {
                flex-direction: column;
            }

            .episode-thumbnail {
                width: 100%;
                height: auto;
            }

            .video-player {
                width: 95%;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 28px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .play-btn,
            .info-btn,
            .add-btn {
                margin-bottom: 15px;
                width: 100%;
                justify-content: center;
            }

            .footer-links {
                grid-template-columns: 1fr;
            }

            .modal h2 {
                font-size: 32px;
            }

            .profile-select img {
                width: 100px;
                height: 100px;
            }

            .email-form,
            .login-form {
                flex-direction: column;
            }

            .email-form button {
                border-radius: 4px;
                margin-top: 10px;
            }

            /* More responsive styles for details page */
            .details-info h1 {
                font-size: 28px;
            }

            .details-meta {
                flex-wrap: wrap;
            }

            .details-meta span {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>



    <!-- Profile Selection Modal -->
    <div class="modal" id="profileModal">
        <div class="modal-content">
            <h2>Qui regarde ?</h2>
            <div class="profiles-container">
                <div class="profile-select" onclick="selectProfile('Profile 1', 'men/32')">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile 1">
                    <span>Profile 1</span>
                </div>
                <div class="profile-select" onclick="selectProfile('Profile 2', 'women/44')">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile 2">
                    <span>Profile 2</span>
                </div>
                <div class="profile-select" onclick="selectProfile('Profile 3', 'men/75')">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile 3">
                    <span>Profile 3</span>
                </div>
                <div class="profile-select" onclick="selectProfile('Profile 4', 'women/68')">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Profile 4">
                    <span>Profile 4</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Overlay -->
    <div class="search-overlay" id="searchOverlay">
        <div class="search-header">
            <i class="fas fa-arrow-left" onclick="closeSearch()"></i>
            <input type="text" id="searchInput" placeholder="Titles, people, genres">
            <i class="fas fa-search"></i>
        </div>
        <div class="search-results" id="searchResults">
            <!-- Results will be populated here -->
        </div>
    </div>

    <!-- Notifications Dropdown -->
    <div class="notifications-dropdown" id="notificationsDropdown">
        <h3>Notifications</h3>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="New Release">
            <div class="notification-text">
                <p>New season of Stranger Things is now available!</p>
                <small>2 hours ago</small>
            </div>
        </div>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="New Release">
            <div class="notification-text">
                <p>The Witcher: Season 3 coming next week</p>
                <small>1 day ago</small>
            </div>
        </div>
        <div class="notification-item">
            <img src="https://via.placeholder.com/50" alt="New Release">
            <div class="notification-text">
                <p>New movie added: Dune (2021)</p>
                <small>3 days ago</small>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="navbar">
        <div class="navbar-left">
            <i class="fas fa-arrow-left back-btn" onclick="backToBrowse()"></i>
            <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <i class="fas fa-bars"></i>
            </div>
            <div class="logo" onclick="goToHome()">WATCH NOW</div>
            <ul class="nav-links">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#tvShowsSection" id="tvShowsLink">TV Shows</a></li>
                <li><a href="#moviesSection" id="moviesLink">Movies</a></li>
                <li><a href="#newPopularSection" id="newPopularLink">New & Popular</a></li>
                <li><a href="#myListSection" id="myListLink">My List</a></li>
            </ul>

        </div>
        <div class="navbar-right">
            <i class="fas fa-search" onclick="openSearch()"></i>
            <div class="notification-icon">
                <i class="fas fa-bell" onclick="toggleNotifications()"></i>
                <span class="notification-badge">3</span>
            </div>
            <div class="profile" onclick="toggleProfileMenu()">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" id="currentProfileImg">
                <span id="currentProfileName">Profile 1</span>
                <div class="profile-menu" id="profileMenu">
                    <div class="profile-option" onclick="showProfileModal()">Changer de profil</div>
                    <div class="profile-option" onclick="logout()">Déconnexion</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Email Entry Page -->
    <div class="email-entry-page" id="emailEntryPage" style="background: #000;">
        <div class="email-content">
            <h1>Films, séries et bien plus en illimité.</h1>
            <h2>Où que vous soyez. Annulez à tout moment.</h2>
            <p>
                Prêt à regarder Watch Now ? Entrez votre adresse e-mail pour créer ou
                réactiver votre abonnement.
            </p>
            <div class="email-form">
                <input
                    type="email"
                    id="userEmail"
                    placeholder="Adresse e-mail"
                    required />
                <button onclick="validateEmail()">
                    Commencer <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            <p class="login-link">
                Déjà membre ? <a href="#" onclick="showLoginForm()">Se connecter</a>
            </p>
        </div>
    </div>
    <div class="hero" id="home">
        <button class="add-btn" id="addToDetailsList" style="display:none;">
            <i class="fas fa-plus"></i> My List
        </button>
        <img class="hero-bg active" src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/r3UKPGdQC5mPiA9bE9otM9CN4lW.jpg" alt="The Dark Knight">
        <img class="hero-bg" src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/uKYUR8GPkKRCksczYDJb3pwZauo.jpg" alt="Stranger Things">
        <img class="hero-bg" src="https://www.themoviedb.org/t/p/w600_and_h900_bestv2/LnhRnyCLTcqwT4vKwcg61kNIQl.jpg" alt="The Witcher">
        <img class="hero-bg" src="https://image.tmdb.org/t/p/original/7RyHsO4yDXtBv1zUU3mTpHeQ0d5.jpg" alt="Avengers: Endgame">
        <div class="hero-content">
            <h1>THE DARK KNIGHT</h1>
            <div class="hero-info">
                <span class="rating">96% Match</span>
                <span class="year">2008</span>
                <span class="duration">2h 32m</span>
                <span class="quality">HD</span>
            </div>
            <p class="hero-description">When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.</p>
            <div class="hero-buttons">
                <button class="play-btn" onclick="playMedia(1, false)"><i class="fas fa-play"></i> Play</button>
                <button class="info-btn" onclick="showDetails(1, false)"><i class="fas fa-info-circle"></i> More Info</button>
                <button class="add-btn" id="addToMyList"><i class="fas fa-plus"></i> My List</button>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">Popular on Watch Now</h2>
                <div class="carousel-nav">
                    <button class="carousel-btn left" onclick="scrollCarousel('popular', -300)"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn right" onclick="scrollCarousel('popular', 300)"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="carousel-container">
                <div class="carousel" id="popular">
                    <!-- Content will be added by JavaScript -->
                </div>
            </div>
        </div>

        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">Trending Now</h2>
                <div class="carousel-nav">
                    <button class="carousel-btn left" onclick="scrollCarousel('trending', -300)"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn right" onclick="scrollCarousel('trending', 300)"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="carousel-container">
                <div class="carousel" id="trending">
                    <!-- Content will be added by JavaScript -->
                </div>
            </div>
        </div>

        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">Continue Watching</h2>
                <div class="carousel-nav">
                    <button class="carousel-btn left" onclick="scrollCarousel('continue', -300)"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn right" onclick="scrollCarousel('continue', 300)"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="carousel-container">
                <div class="carousel" id="continue">
                    <!-- Content will be added by JavaScript -->
                </div>
            </div>
        </div>

        <div class="content-section">
            <div class="section-header">
                <h2 class="section-title">New Releases</h2>
                <div class="carousel-nav">
                    <button class="carousel-btn left" onclick="scrollCarousel('new', -300)"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn right" onclick="scrollCarousel('new', 300)"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="carousel-container">
                <div class="carousel" id="new">
                    <!-- Content will be added by JavaScript -->
                </div>
            </div>
        </div>

        <!-- TV Shows Section -->
        <div class="content-section category-section" id="tvShowsSection">
            <div class="section-header">
                <h2 class="section-title">TV Shows</h2>
                <div class="carousel-nav">
                    <button class="carousel-btn left" onclick="scrollCarousel('tvShows', -300)"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn right" onclick="scrollCarousel('tvShows', 300)"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="carousel-container">
                <div class="carousel" id="tvShows">
                    <!-- Content will be added by JavaScript -->
                </div>
            </div>
        </div>

        <!-- Movies Section -->
        <div class="content-section category-section" id="moviesSection">
            <div class="section-header">
                <h2 class="section-title">Movies</h2>
                <div class="carousel-nav">
                    <button class="carousel-btn left" onclick="scrollCarousel('movies', -300)"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn right" onclick="scrollCarousel('movies', 300)"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="carousel-container">
                <div class="carousel" id="movies">
                    <!-- Content will be added by JavaScript -->
                </div>
            </div>
        </div>

        <!-- New & Popular Section -->
        <div class="content-section category-section" id="newPopularSection">
            <div class="section-header">
                <h2 class="section-title">New & Popular</h2>
                <div class="carousel-nav">
                    <button class="carousel-btn left" onclick="scrollCarousel('newPopular', -300)"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn right" onclick="scrollCarousel('newPopular', 300)"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="carousel-container">
                <div class="carousel" id="newPopular">
                    <!-- Content will be added by JavaScript -->
                </div>
            </div>
        </div>

        <!-- My List Section -->
        <div class="content-section category-section" id="myListSection">
            <div class="section-header">
                <h2 class="section-title">My List</h2>
                <div class="carousel-nav">
                    <button class="carousel-btn left" onclick="scrollCarousel('myList', -300)"><i class="fas fa-chevron-left"></i></button>
                    <button class="carousel-btn right" onclick="scrollCarousel('myList', 300)"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="carousel-container">
                <div class="carousel" id="myList">
                    <!-- Content will be added by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <div class="social-icons">
                <i class="fab fa-facebook"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-youtube"></i>
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">Audio Description</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Gift Cards</a></li>
                    <li><a href="#">Media Center</a></li>
                </ul>
                <ul>
                    <li><a href="#">Investor Relations</a></li>
                    <li><a href="#">Jobs</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
                <ul>
                    <li><a href="#">Legal Notices</a></li>
                    <li><a href="#">Cookie Preferences</a></li>
                    <li><a href="#">Corporate Information</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
            <div class="copyright">
                <p>&copy; 2023 GoldFlix. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        // Enhanced Movie Data (30 items per category)
        const movies = {
            popular: [{
                    id: 1,
                    title: "Stranger Things",
                    image: "https://m.media-amazon.com/images/M/MV5BMDZkYmVhNjMtNWU4MC00MDQxLWE3MjYtZGMzZWI1ZjhlOWJmXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg",
                    year: 2016,
                    type: "TV Show",
                    rating: "95%",
                    duration: "4 Seasons",
                    description: "When a young boy vanishes, a small town uncovers a mystery involving secret experiments, terrifying supernatural forces and one strange little girl."
                },
                {
                    id: 2,
                    title: "The Witcher",
                    image: "https://image.tmdb.org/t/p/original/7vjaCdMw15FEbXyLQTVa04URsPm.jpg",
                    year: 2019,
                    type: "TV Show",
                    rating: "89%",
                    duration: "2 Seasons",
                    description: "Geralt of Rivia, a mutated monster-hunter for hire, journeys toward his destiny in a turbulent world where people often prove more wicked than beasts."
                },
                {
                    id: 3,
                    title: "Money Heist",
                    image: "https://m.media-amazon.com/images/M/MV5BODI0ZTljYTMtODQ1NC00NmI0LTk1YWUtN2FlNDM1MDExMDlhXkEyXkFqcGdeQXVyMTM0NTUzNDIy._V1_.jpg",
                    year: 2017,
                    type: "TV Show",
                    rating: "92%",
                    duration: "5 Parts",
                    description: "An unusual group of robbers attempt to carry out the most perfect robbery in Spanish history - stealing 2.4 billion euros from the Royal Mint of Spain."
                },
                {
                    id: 4,
                    title: "Dark",
                    image: "https://m.media-amazon.com/images/M/MV5BOTk2NzUyOTctZDdlMS00MDJlLTgzNTEtNzQzYjFhNjA0YjBjXkEyXkFqcGdeQXVyMjg1NDcxNDE@._V1_.jpg",
                    year: 2017,
                    type: "TV Show",
                    rating: "94%",
                    duration: "3 Seasons",
                    description: "A missing child sets four families on a frantic hunt for answers as they unearth a mind-bending mystery that spans three generations."
                },
                {
                    id: 5,
                    title: "The Crown",
                    image: "https://media-cldnry.s-nbcnews.com/image/upload/t_fit-560w,f_auto,q_auto:best/rockcms/2022-10/crown-season-5-posters-mc-221018-04-157c09.jpg",
                    year: 2016,
                    type: "TV Show",
                    rating: "90%",
                    duration: "5 Seasons",
                    description: "This drama follows the political rivalries and romance of Queen Elizabeth II's reign and the events that shaped the second half of the 20th century."
                },
                {
                    id: 6,
                    title: "Breaking Bad",
                    image: "https://m.media-amazon.com/images/M/MV5BYmQ4YWMxYjUtNjZmYi00MDQ1LWFjMjMtNjA5ZDdiYjdiODU5XkEyXkFqcGdeQXVyMTMzNDExODE5._V1_.jpg",
                    year: 2008,
                    type: "TV Show",
                    rating: "96%",
                    duration: "5 Seasons",
                    description: "A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine in order to secure his family's future."
                },
                {
                    id: 7,
                    title: "The Mandalorian",
                    image: "https://m.media-amazon.com/images/M/MV5BZDhlMzY0ZGItZTcyNS00ZTAxLWIyMmYtZGQ2ODg5OWZiYmJkXkEyXkFqcGdeQXVyODkzNTgxMDg@._V1_.jpg",
                    year: 2019,
                    type: "TV Show",
                    rating: "88%",
                    duration: "2 Seasons",
                    description: "The travels of a lone bounty hunter in the outer reaches of the galaxy, far from the authority of the New Republic."
                },
                {
                    id: 8,
                    title: "Peaky Blinders",
                    image: "https://m.media-amazon.com/images/M/MV5BMTkzNjEzMDEzMF5BMl5BanBnXkFtZTgwMDI0MjE4MjE@._V1_.jpg",
                    year: 2013,
                    type: "TV Show",
                    rating: "93%",
                    duration: "6 Seasons",
                    description: "A notorious gang in 1919 Birmingham, England, is led by the fierce Tommy Shelby, a crime boss set on moving up in the world no matter the cost."
                },
                {
                    id: 9,
                    title: "Squid Game",
                    image: "https://m.media-amazon.com/images/M/MV5BYWE3MDVkN2EtNjQ5MS00ZDQ4LTliNzYtMjc2YWMzMDEwMTA3XkEyXkFqcGdeQXVyMTEzMTI1Mjk3._V1_.jpg",
                    year: 2021,
                    type: "TV Show",
                    rating: "95%",
                    duration: "1 Season",
                    description: "Hundreds of cash-strapped players accept a strange invitation to compete in children's games. Inside, a tempting prize awaits with deadly high stakes."
                },
                {
                    id: 10,
                    title: "The Queen's Gambit",
                    image: "https://image.tmdb.org/t/p/original/zU0htwkhNvBQdVSIKB9s6hgVeFK.jpg",
                    year: 2020,
                    type: "TV Show",
                    rating: "97%",
                    duration: "Limited Series",
                    description: "In a 1950s orphanage, a young girl reveals an astonishing talent for chess and begins an unlikely journey to stardom while grappling with addiction."
                }
            ],
            trending: [{
                    id: 31,
                    title: "Dune",
                    image: "https://m.media-amazon.com/images/M/MV5BN2FjNmEyNWMtYzM0ZS00NjIyLTg5YzYtYThlMGVjNzE1OGViXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "83%",
                    duration: "2h 35m",
                    description: "Feature adaptation of Frank Herbert's science fiction novel about the son of a noble family entrusted with the protection of the most valuable asset in the galaxy."
                },
                {
                    id: 32,
                    title: "No Time to Die",
                    image: "https://m.media-amazon.com/images/M/MV5BYWQ2NzQ1NjktMzNkNS00MGY1LTgwMmMtYTllYTI5YzNmMmE0XkEyXkFqcGdeQXVyMjM4NTM5NDY@._V1_.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "78%",
                    duration: "2h 43m",
                    description: "James Bond has left active service. His peace is short-lived when Felix Leiter, an old friend from the CIA, turns up asking for help."
                },
                {
                    id: 33,
                    title: "The Batman",
                    image: "https://m.media-amazon.com/images/M/MV5BMDdmMTBiNTYtMDIzNi00NGVlLWIzMDYtZTk3MTQ3NGQxZGEwXkEyXkFqcGdeQXVyMzMwOTU5MDk@._V1_.jpg",
                    year: 2022,
                    type: "Movie",
                    rating: "85%",
                    duration: "2h 56m",
                    description: "When a sadistic serial killer begins murdering key political figures in Gotham, Batman is forced to investigate the city's hidden corruption."
                },
                {
                    id: 34,
                    title: "Spider-Man: No Way Home",
                    image: "https://m.media-amazon.com/images/M/MV5BZWMyYzFjYTYtNTRjYi00OGExLWE2YzgtOGRmYjAxZTU3NzBiXkEyXkFqcGdeQXVyMzQ0MzA0NTM@._V1_.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "93%",
                    duration: "2h 28m",
                    description: "With Spider-Man's identity now revealed, Peter asks Doctor Strange for help. When a spell goes wrong, dangerous foes from other worlds start to appear."
                },
                {
                    id: 35,
                    title: "The Irishman",
                    image: "https://m.media-amazon.com/images/M/MV5BMGUyM2ZiZmUtMWY0OC00NTQ4LThkOGUtNjY2NjkzMDJiMWMwXkEyXkFqcGdeQXVyMzY0MTE3NzU@._V1_.jpg",
                    year: 2019,
                    type: "Movie",
                    rating: "95%",
                    duration: "3h 29m",
                    description: "Hitman Frank Sheeran looks back at the secrets he kept as a loyal member of the Bufalino crime family in this acclaimed film from Martin Scorsese."
                },
                {
                    id: 36,
                    title: "Extraction",
                    image: "https://m.media-amazon.com/images/M/MV5BMDJiNzUwYzEtNmQ2Yy00NWE4LWEwNzctM2M0MjE0OGUxZTA3XkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg",
                    year: 2020,
                    type: "Movie",
                    rating: "67%",
                    duration: "1h 56m",
                    description: "A hardened mercenary's mission becomes a soul-searching race to survive when he's sent into Bangladesh to rescue a drug lord's kidnapped son."
                },
                {
                    id: 37,
                    title: "The Gray Man",
                    image: "https://m.media-amazon.com/images/M/MV5BOWY4MmFiY2QtMzE1YS00NTg1LWIwOTQtYTI4ZGUzNWIxNTVmXkEyXkFqcGdeQXVyODk4OTc3MTY@._V1_.jpg",
                    year: 2022,
                    type: "Movie",
                    rating: "46%",
                    duration: "2h 2m",
                    description: "When the CIA's most skilled mercenary accidentally uncovers dark agency secrets, a psychopathic former colleague puts a bounty on his head."
                },
                {
                    id: 38,
                    title: "Red Notice",
                    image: "https://m.media-amazon.com/images/M/MV5BZmRjODgyMzEtMzIxYS00OWY2LTk4YjUtMGMzZjMzMTZiN2Q0XkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "36%",
                    duration: "1h 58m",
                    description: "An Interpol agent tracks the world's most wanted art thief with help from a rival thief. But nothing is as it seems, as a series of double-crosses ensue."
                },
                {
                    id: 39,
                    title: "Don't Look Up",
                    image: "https://m.media-amazon.com/images/M/MV5BNzk1OGU2NmMtNTdhZC00NjdlLWE5YTMtZTQ0MGExZTQzOGQyXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "55%",
                    duration: "2h 18m",
                    description: "Two low-level astronomers must go on a giant media tour to warn humankind of an approaching comet that will destroy planet Earth."
                },
                {
                    id: 40,
                    title: "The Power of the Dog",
                    image: "https://image.tmdb.org/t/p/original/kEy48iCzGnp0ao1cZbNeWR6yIhC.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "94%",
                    duration: "2h 6m",
                    description: "Charismatic rancher Phil Burbank inspires fear and awe in those around him. When his brother brings home a new wife and her son, Phil torments them."
                }
            ],
            continue: [{
                    id: 61,
                    title: "Game of Thrones",
                    image: "https://m.media-amazon.com/images/M/MV5BYTRiNDQwYzAtMzVlZS00NTI5LWJjYjUtMzkwNTUzMWMxZTllXkEyXkFqcGdeQXVyNDIzMzcwNjc@._V1_.jpg",
                    year: 2011,
                    type: "TV Show",
                    rating: "89%",
                    duration: "8 Seasons",
                    progress: 65,
                    description: "Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia."
                },
                {
                    id: 62,
                    title: "The Walking Dead",
                    image: "https://m.media-amazon.com/images/M/MV5BZmU5NTcwNjktODIwMi00ZmZkLTk4ZWUtYzVjZWQ5ZTZjN2RlXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg",
                    year: 2010,
                    type: "TV Show",
                    rating: "79%",
                    duration: "11 Seasons",
                    progress: 40,
                    description: "Sheriff Deputy Rick Grimes wakes up from a coma to learn the world is in ruins and must lead a group of survivors to stay alive."
                },
                {
                    id: 63,
                    title: "Friends",
                    image: "https://m.media-amazon.com/images/M/MV5BNDVkYjU0MzctMWRmZi00NTkxLTgwZWEtOWVhYjZlYjllYmU4XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_.jpg",
                    year: 1994,
                    type: "TV Show",
                    rating: "94%",
                    duration: "10 Seasons",
                    progress: 85,
                    description: "Follows the personal and professional lives of six twenty to thirty-something-year-old friends living in Manhattan."
                },
                {
                    id: 64,
                    title: "The Office",
                    image: "https://m.media-amazon.com/images/M/MV5BMDNkOTE4NDQtMTNmYi00MWE0LWE4ZTktYTc0NzhhNWIzNzJiXkEyXkFqcGdeQXVyMzQ2MDI5NjU@._V1_.jpg",
                    year: 2005,
                    type: "TV Show",
                    rating: "93%",
                    duration: "9 Seasons",
                    progress: 30,
                    description: "A mockumentary on a group of typical office workers, where the workday consists of ego clashes, inappropriate behavior, and tedium."
                },
                {
                    id: 65,
                    title: "Big Bang Theory",
                    image: "https://image.tmdb.org/t/p/original/ooBGRQBdbGzBxAVfExiO8r7kloA.jpg",
                    year: 2007,
                    type: "TV Show",
                    rating: "81%",
                    duration: "12 Seasons",
                    progress: 70,
                    description: "A woman who moves into an apartment across the hall from two brilliant but socially awkward physicists shows them how little they know about life."
                },
                {
                    id: 66,
                    title: "Westworld",
                    image: "https://image.tmdb.org/t/p/original/6aj09UTMQNyfSfk0ZX8rYOEsXL2.jpg",
                    year: 2016,
                    type: "TV Show",
                    rating: "86%",
                    duration: "4 Seasons",
                    progress: 25,
                    description: "At the intersection of the near future and the reimagined past, waits a world in which every human appetite can be indulged without consequence."
                },
                {
                    id: 67,
                    title: "The Sopranos",
                    image: "https://m.media-amazon.com/images/M/MV5BZGJjYzhjYTYtMDBjYy00OWU1LTg5OTYtNmYwOTZmZjE3ZDdhXkEyXkFqcGdeQXVyNTAyODkwOQ@@._V1_.jpg",
                    year: 1999,
                    type: "TV Show",
                    rating: "92%",
                    duration: "6 Seasons",
                    progress: 55,
                    description: "New Jersey mob boss Tony Soprano deals with personal and professional issues in his home and business life that affect his mental state."
                },
                {
                    id: 68,
                    title: "The Wire",
                    image: "https://m.media-amazon.com/images/M/MV5BNTllYzFhMjAtZjExNS00MjM4LWE5YmMtOGFiZGRlOTU5YzJiXkEyXkFqcGdeQXVyNDIzMzcwNjc@._V1_.jpg",
                    year: 2002,
                    type: "TV Show",
                    rating: "94%",
                    duration: "5 Seasons",
                    progress: 20,
                    description: "The Baltimore drug scene, as seen through the eyes of drug dealers and law enforcement."
                },
                {
                    id: 69,
                    title: "Sherlock",
                    image: "https://m.media-amazon.com/images/M/MV5BMWY3NTljMjEtYzRiMi00NWM2LTkzNjItZTVmZjE0MTdjMjJhL2ltYWdlL2ltYWdlXkEyXkFqcGdeQXVyNTQ4NTc5OTU@._V1_.jpg",
                    year: 2010,
                    type: "TV Show",
                    rating: "96%",
                    duration: "4 Seasons",
                    progress: 90,
                    description: "A modern update finds the famous sleuth and his doctor partner solving crime in 21st century London."
                },
                {
                    id: 70,
                    title: "Dexter",
                    image: "https://m.media-amazon.com/images/M/MV5BZjkzMmU5MjMtODllZS00OTA5LTk2ZTEtNjdhYjZhMDA5ZTRhXkEyXkFqcGdeQXVyOTA3MTMyOTk@._V1_.jpg",
                    year: 2006,
                    type: "TV Show",
                    rating: "88%",
                    duration: "9 Seasons",
                    progress: 75,
                    description: "By day, mild-mannered Dexter is a blood-spatter analyst for the Miami police. But at night, he is a serial killer who only targets other murderers."
                }
            ],
            new: [{
                    id: 91,
                    title: "Stranger Things 4",
                    image: "https://m.media-amazon.com/images/M/MV5BMDZkYmVhNjMtNWU4MC00MDQxLWE3MjYtZGMzZWI1ZjhlOWJmXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "96%",
                    duration: "New Season",
                    description: "The fourth season of Stranger Things sees the group separated for the first time, facing new horrors as Vecna's curse threatens Hawkins."
                },
                {
                    id: 92,
                    title: "The Sandman",
                    image: "https://image.tmdb.org/t/p/original/q54qEgagGOYCq5D1903eBVMNkbo.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "87%",
                    duration: "1 Season",
                    description: "Upon escaping after decades of imprisonment by a mortal wizard, Dream, the personification of dreams, sets about to reclaim his lost equipment."
                },
                {
                    id: 93,
                    title: "House of the Dragon",
                    image: "https://m.media-amazon.com/images/M/MV5BZjBiOGIyY2YtOTA3OC00YzY1LThkYjktMGRkYTNhNTExY2I2XkEyXkFqcGdeQXVyMTEyMjM2NDc2._V1_.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "85%",
                    duration: "1 Season",
                    description: "An internal succession war within House Targaryen at the height of its power, 172 years before the birth of Daenerys Targaryen."
                },
                {
                    id: 94,
                    title: "The Lord of the Rings: The Rings of Power",
                    image: "https://www.originalfilmart.com/cdn/shop/files/lord_of_the_rings_the_two_towers_2002_original_film_art_5dd21feb-10ab-41a1-84a1-4c4b082e9626_5000x.webp?v=1705516902",
                    year: 2022,
                    type: "TV Show",
                    rating: "83%",
                    duration: "1 Season",
                    description: "Epic drama set thousands of years before the events of J.R.R. Tolkien's 'The Hobbit' and 'The Lord of the Rings' follows an ensemble cast."
                },
                {
                    id: 95,
                    title: "Obi-Wan Kenobi",
                    image: "https://image.tmdb.org/t/p/original/qJRB789ceLryrLvOKrZqLKr2CGf.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "82%",
                    duration: "Limited Series",
                    description: "Jedi Master Obi-Wan Kenobi watches over young Luke Skywalker and evades the Empire's elite Jedi hunters during his exile on the desert planet Tatooine."
                },
                {
                    id: 96,
                    title: "The Bear",
                    image: "https://www.inspireuplift.com/resizer/?image=https://cdn.inspireuplift.com/uploads/images/seller_products/1700127662_my-image-0.jpeg&width=600&height=600&quality=90&format=auto&fit=pad",
                    year: 2022,
                    type: "TV Show",
                    rating: "92%",
                    duration: "1 Season",
                    description: "A young chef from the fine dining world returns to Chicago to run his family's sandwich shop after a heartbreaking death in his family."
                },
                {
                    id: 97,
                    title: "Wednesday",
                    image: "https://m.media-amazon.com/images/I/6144TiJ10LL._AC_SL1500_.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "88%",
                    duration: "1 Season",
                    description: "Follows Wednesday Addams' years as a student, when she attempts to master her emerging psychic ability, thwart a killing spree, and solve the mystery."
                },
                {
                    id: 98,
                    title: "The Watcher",
                    image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRHHHUktk1Lnpa27sCBrTB_bjLTb48p-kaYDg&s",
                    year: 2022,
                    type: "TV Show",
                    rating: "65%",
                    duration: "1 Season",
                    description: "A family moves into their suburban dream home, only to discover they've inherited a nightmare in the form of a stalker known as 'The Watcher'."
                },
                {
                    id: 99,
                    title: "Dahmer",
                    image: "https://fr.web.img4.acsta.net/r_1920_1080/pictures/22/09/17/18/16/3249476.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "84%",
                    duration: "Limited Series",
                    description: "Story of one of America's most notorious serial killers, largely told from the points of view of his victims, and dives deeply into the systemic racism."
                },
                {
                    id: 100,
                    title: "The Crown Season 5",
                    image: "https://media-cldnry.s-nbcnews.com/image/upload/t_fit-560w,f_auto,q_auto:best/rockcms/2022-10/crown-season-5-posters-mc-221018-04-157c09.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "91%",
                    duration: "New Season",
                    description: "The fifth season of The Crown, which covers the Queen's reign from the early to late 1990s, including events such as the Windsor Castle fire."
                }
            ],
            tvShows: [{
                    id: 121,
                    title: "The Last of Us",
                    image: "https://m.media-amazon.com/images/M/MV5BZGUzYTI3M2EtZmM0Yy00NGUyLWI4ODEtN2Q3ZGJlYzhhZjU3XkEyXkFqcGdeQXVyNTM0OTY1OQ@@._V1_.jpg",
                    year: 2023,
                    type: "TV Show",
                    rating: "96%",
                    duration: "1 Season",
                    description: "After a global pandemic destroys civilization, a hardened survivor takes charge of a 14-year-old girl who may be humanity's last hope."
                },
                {
                    id: 122,
                    title: "The White Lotus",
                    image: "https://m.media-amazon.com/images/M/MV5BYjdjNzBmYjEtM2Y5My00YjI0LWJjY2YtOGQ4MjNkNmE2MDVjXkEyXkFqcGdeQXVyMTEyMjM2NDc2._V1_.jpg",
                    year: 2021,
                    type: "TV Show",
                    rating: "90%",
                    duration: "2 Seasons",
                    description: "Social satire set at an exclusive tropical resort, following the exploits of various guests and employees over the span of a week."
                },
                {
                    id: 123,
                    title: "Succession",
                    image: "https://m.media-amazon.com/images/S/pv-target-images/cae41fd33dd9c0bff38cb1efe256b9da739752369b446350fd6f59825bda331a.jpg",
                    year: 2018,
                    type: "TV Show",
                    rating: "95%",
                    duration: "4 Seasons",
                    description: "The Roy family is known for controlling the biggest media and entertainment company in the world, but their world changes when their father steps down."
                },
                {
                    id: 124,
                    title: "Euphoria",
                    image: "https://media.gqmagazine.fr/photos/654516ce6fa02633ebcfd5d4/16:9/w_1920,c_limit/zendaya_1.jpg",
                    year: 2019,
                    type: "TV Show",
                    rating: "87%",
                    duration: "2 Seasons",
                    description: "A look at life for a group of high school students as they grapple with issues of drugs, sex, and violence."
                },
                {
                    id: 125,
                    title: "Barry",
                    image: "https://www.ecranlarge.com/content/uploads/2022/06/j1xpwd11f0baei7px6udmhuvx2f-073.jpg",
                    year: 2018,
                    type: "TV Show",
                    rating: "98%",
                    duration: "3 Seasons",
                    description: "A hit man from the Midwest moves to Los Angeles and gets caught up in the city's theatre arts scene."
                },
                {
                    id: 126,
                    title: "Severance",
                    image: "http://files.macbidouille.com/mbv3/2025/01/20/FvIVzxVlqfdWkkvj.jpeg",
                    year: 2022,
                    type: "TV Show",
                    rating: "97%",
                    duration: "1 Season",
                    description: "Mark leads a team of office workers whose memories have been surgically divided between their work and personal lives."
                },
                {
                    id: 127,
                    title: "Only Murders in the Building",
                    image: "https://img.etimg.com/thumb/msid-108533772,width-300,height-225,imgsize-32384,resizemode-75/only-murders-in-the-building-season-4-release-date-all-you-need-to-know.jpg",
                    year: 2021,
                    type: "TV Show",
                    rating: "100%",
                    duration: "2 Seasons",
                    description: "Three strangers share an obsession with true crime and suddenly find themselves wrapped up in one."
                },
                {
                    id: 128,
                    title: "Ted Lasso",
                    image: "https://m.media-amazon.com/images/M/MV5BMDVmODUzNmEtMGMxZC00NWUzLTkxMTAtMDM5OTQzMWE0ZDM3XkEyXkFqcGdeQXVyMDM2NDM2MQ@@._V1_.jpg",
                    year: 2020,
                    type: "TV Show",
                    rating: "94%",
                    duration: "2 Seasons",
                    description: "American football coach Ted Lasso heads to London to manage AFC Richmond, a struggling English Premier League football team."
                },
                {
                    id: 129,
                    title: "The Marvelous Mrs. Maisel",
                    image: "https://m.media-amazon.com/images/M/MV5BODI0ZTljYTMtODQ1NC00NmI0LTk1YWUtN2FlNDM1MDExMDlhXkEyXkFqcGdeQXVyMTM0NTUzNDIy._V1_.jpg",
                    year: 2017,
                    type: "TV Show",
                    rating: "89%",
                    duration: "4 Seasons",
                    description: "A housewife in the 1950s decides to become a stand-up comic."
                },
                {
                    id: 130,
                    title: "The Handmaid's Tale",
                    image: "https://mulhernocinema.com/wp-content/uploads/2019/02/the-handmaids-tale-001-1000x509.jpg",
                    year: 2017,
                    type: "TV Show",
                    rating: "88%",
                    duration: "5 Seasons",
                    description: "Set in a dystopian future, a woman is forced to live as a concubine under a fundamentalist theocratic dictatorship."
                }
            ],
            movies: [{
                    id: 151,
                    title: "The Irishman",
                    image: "https://m.media-amazon.com/images/M/MV5BMGUyM2ZiZmUtMWY0OC00NTQ4LThkOGUtNjY2NjkzMDJiMWMwXkEyXkFqcGdeQXVyMzY0MTE3NzU@._V1_.jpg",
                    year: 2019,
                    type: "Movie",
                    rating: "95%",
                    duration: "3h 29m",
                    description: "Hitman Frank Sheeran looks back at the secrets he kept as a loyal member of the Bufalino crime family in this acclaimed film from Martin Scorsese."
                },
                {
                    id: 152,
                    title: "Roma",
                    image: "https://www.ultimatemovierankings.com/wp-content/uploads/2019/02/roma-movie-poster.jpg",
                    year: 2018,
                    type: "Movie",
                    rating: "96%",
                    duration: "2h 15m",
                    description: "A year in the life of a middle-class family's maid in Mexico City in the early 1970s."
                },
                {
                    id: 153,
                    title: "Marriage Story",
                    image: "https://m.media-amazon.com/images/M/MV5BZGVmY2RjNDgtMTc3Yy00YmY0LTgwODItYzBjNWJhNTRlYjdkXkEyXkFqcGdeQXVyMjM4NTM5NDY@._V1_.jpg",
                    year: 2019,
                    type: "Movie",
                    rating: "95%",
                    duration: "2h 17m",
                    description: "Noah Baumbach's incisive and compassionate look at a marriage breaking up and a family staying together."
                },
                {
                    id: 154,
                    title: "The Trial of the Chicago 7",
                    image: "https://m.media-amazon.com/images/M/MV5BNDExMGMyN2QtYjRkZC00Yzk1LTkzMDktMTliZTI5NjQ0NTNkXkEyXkFqcGdeQXVyMTEyMjM2NDc2._V1_.jpg",
                    year: 2020,
                    type: "Movie",
                    rating: "89%",
                    duration: "2h 9m",
                    description: "The story of 7 people on trial stemming from various charges surrounding the uprising at the 1968 Democratic National Convention in Chicago."
                },
                {
                    id: 155,
                    title: "Da 5 Bloods",
                    image: "https://cdn.theatlantic.com/thumbor/df0ZSx0A1MM-q4X3VHyLZ8SNNBU=/0x330:4500x2861/976x549/media/img/mt/2020/06/D5B_Unit_06807RC/original.jpg",
                    year: 2020,
                    type: "Movie",
                    rating: "92%",
                    duration: "2h 34m",
                    description: "Four African American vets battle the forces of man and nature when they return to Vietnam seeking the remains of their fallen squad leader."
                },
                {
                    id: 156,
                    title: "Mank",
                    image: "https://m.media-amazon.com/images/M/MV5BZGFiMWFhNDAtMzUyZS00NmQ2LTljNDYtMmZjNTc5MDUxMzViXkEyXkFqcGdeQXVyNjAwNDUxODI@._V1_.jpg",
                    year: 2020,
                    type: "Movie",
                    rating: "83%",
                    duration: "2h 11m",
                    description: "1930s Hollywood is reevaluated through the eyes of scathing social critic and alcoholic screenwriter Herman J. Mankiewicz."
                },
                {
                    id: 157,
                    title: "The Power of the Dog",
                    image: "https://image.tmdb.org/t/p/original/kEy48iCzGnp0ao1cZbNeWR6yIhC.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "94%",
                    duration: "2h 6m",
                    description: "Charismatic rancher Phil Burbank inspires fear and awe in those around him. When his brother brings home a new wife and her son, Phil torments them."
                },
                {
                    id: 158,
                    title: "Don't Look Up",
                    image: "https://m.media-amazon.com/images/M/MV5BNzk1OGU2NmMtNTdhZC00NjdlLWE5YTMtZTQ0MGExZTQzOGQyXkEyXkFqcGdeQXVyMTQxNzMzNDI@._V1_.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "55%",
                    duration: "2h 18m",
                    description: "Two low-level astronomers must go on a giant media tour to warn humankind of an approaching comet that will destroy planet Earth."
                },
                {
                    id: 159,
                    title: "The Lost Daughter",
                    image: "https://flixchatter.net/wp-content/uploads/2022/01/lost-daughter-poster.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "94%",
                    duration: "2h 1m",
                    description: "A woman's beach vacation takes a dark turn when her obsession with a young mother forces her to confront secrets from her past."
                },
                {
                    id: 160,
                    title: "Tick, Tick... Boom!",
                    image: "https://t2.genius.com/unsafe/300x300/https%3A%2F%2Fimages.genius.com%2F189b51d35dde12c9e5066ee447c6256d.500x500x1.jpg",
                    year: 2021,
                    type: "Movie",
                    rating: "87%",
                    duration: "1h 55m",
                    description: "On the brink of turning 30, a promising theater composer navigates love, friendship and the pressure to create something great."
                }
            ],
            newPopular: [{
                    id: 181,
                    title: "You People",
                    image: "https://mlpnk72yciwc.i.optimole.com/cqhiHLc.IIZS~2ef73/w:600/h:400/q:75/https://bleedingcool.com/wp-content/uploads/2023/01/UJHP_20211122_27511_R.jpg",
                    year: 2023,
                    type: "Movie",
                    rating: "58%",
                    duration: "1h 57m",
                    description: "A new couple and their families find themselves examining modern love and family dynamics amidst clashing cultures, societal expectations."
                },
                {
                    id: 182,
                    title: "Pam & Tommy",
                    image: "https://fr.web.img6.acsta.net/c_225_300/pictures/22/01/21/15/45/2065695.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "79%",
                    duration: "Limited Series",
                    description: "The story of Pamela Anderson and Tommy Lee's relationship goes viral when their private honeymoon sex tape is stolen and leaked to the public."
                },
                {
                    id: 183,
                    title: "The Woman King",
                    image: "https://m.media-amazon.com/images/M/MV5BY2I4MDIwYWUtOWMxNC00ZTIzLWE3OGYtOWUyMmIwZGE2NjU4XkEyXkFqcGdeQXVyMTUzMTg2ODkz._V1_.jpg",
                    year: 2022,
                    type: "Movie",
                    rating: "94%",
                    duration: "2h 15m",
                    description: "A historical epic inspired by true events that took place in The Kingdom of Dahomey, one of the most powerful states of Africa in the 18th and 19th centuries."
                },
                {
                    id: 184,
                    title: "The Weekend Away",
                    image: "https://fr.web.img6.acsta.net/c_310_420/pictures/22/02/17/16/50/2627801.jpg",
                    year: 2022,
                    type: "Movie",
                    rating: "55%",
                    duration: "1h 29m",
                    description: "A weekend getaway to Croatia goes awry when a woman's best friend vanishes, leaving behind a bloody trail and more questions than answers."
                },
                {
                    id: 185,
                    title: "The Tinder Swindler",
                    image: "https://cdn.theatlantic.com/thumbor/df0ZSx0A1MM-q4X3VHyLZ8SNNBU=/0x330:4500x2861/976x549/media/img/mt/2020/06/D5B_Unit_06807RC/original.jpg",
                    year: 2022,
                    type: "Movie",
                    rating: "97%",
                    duration: "1h 54m",
                    description: "Posing as a wealthy, jet-setting diamond mogul, an Israeli conman wooed women online then conned them out of millions of dollars."
                },
                {
                    id: 186,
                    title: "Inventing Anna",
                    image: "https://m.media-amazon.com/images/M/MV5BZjc0MmNmODEtZWE1MC00YTg0LTlmYzUtNmQxYTc5MDcwZjFlXkEyXkFqcGdeQWFybm8@._V1_.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "64%",
                    duration: "Limited Series",
                    description: "A journalist investigates the case of Anna Delvey, the Instagram-legendary German heiress who stole the hearts of New York's social scene."
                },
                {
                    id: 187,
                    title: "Vikings: Valhalla",
                    image: "https://m.media-amazon.com/images/M/MV5BYWFjYmMxMjMtMGE2ZC00YWZhLTgzNDYtYTA3ODA2MDg2NTA4XkEyXkFqcGc@._V1_.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "88%",
                    duration: "1 Season",
                    description: "Set over a thousand years ago in the early 11th century, follow the adventures of the most famous Vikings who ever lived."
                },
                {
                    id: 188,
                    title: "Bridgerton Season 2",
                    image: "https://m.media-amazon.com/images/M/MV5BYzk5NzU1ZjYtNDM3Yy00YTZmLWE3YjctMjEzMDA5NTEzNDU2XkEyXkFqcGc@._V1_.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "78%",
                    duration: "New Season",
                    description: "The second season of Bridgerton follows Lord Anthony Bridgerton's quest to find a suitable wife, leading him to court Edwina Sharma."
                },
                {
                    id: 189,
                    title: "The Witcher: Blood Origin",
                    image: "https://image.tmdb.org/t/p/original/7vjaCdMw15FEbXyLQTVa04URsPm.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "38%",
                    duration: "Limited Series",
                    description: "Set in an elven world 1200 years before the world of The Witcher, seven outcasts unite to launch a deadly mission against an all-powerful empire."
                },
                {
                    id: 190,
                    title: "1899",
                    image: "https://m.media-amazon.com/images/M/MV5BY2UyM2YwZTEtOTk5Zi00ODhkLTg2ZjctMzIxMTViZjFmN2Y4XkEyXkFqcGc@._V1_QL75_UY281_CR18,0,190,281_.jpg",
                    year: 2022,
                    type: "TV Show",
                    rating: "76%",
                    duration: "1 Season",
                    description: "Multinational immigrants traveling from the old continent to the new encounter a nightmarish riddle aboard a second ship adrift on the open sea."
                }
            ]
        };

        let myList = [];
        let currentProfile = "Profile 1";
        let userEmail = '';
        let selectedPlan = '';
        let paymentMethod = '';
        let currentBgIndex = 0;
        const heroBgImages = [{
                url: "https://image.tmdb.org/t/p/original/1XDDXPXGiI8id7MrUxK36ke7gkX.jpg",
                title: "THE DARK KNIGHT",
                year: "2008",
                rating: "96%",
                duration: "2h 32m",
                description: "When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice."
            },
            {
                url: "https://image.tmdb.org/t/p/original/8u0QBGUbZcBW59VEAdmeFl9g98N.jpg",
                title: "STRANGER THINGS",
                year: "2016",
                rating: "95%",
                duration: "4 Seasons",
                description: "When a young boy vanishes, a small town uncovers a mystery involving secret experiments, terrifying supernatural forces and one strange little girl."
            },
            {
                url: "https://image.tmdb.org/t/p/original/9yBVqNruk6Ykrwc32qrK2TIE5xw.jpg",
                title: "THE WITCHER",
                year: "2019",
                rating: "89%",
                duration: "2 Seasons",
                description: "Geralt of Rivia, a mutated monster-hunter for hire, journeys toward his destiny in a turbulent world where people often prove more wicked than beasts."
            },
            {
                url: "https://image.tmdb.org/t/p/original/7RyHsO4yDXtBv1zUU3mTpHeQ0d5.jpg",
                title: "AVENGERS: ENDGAME",
                year: "2019",
                rating: "94%",
                duration: "3h 1m",
                description: "After the devastating events of Avengers: Infinity War, the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos' actions and restore balance to the universe."
            }
        ];

        // Function to rotate background images and update content
        function rotateBackground() {
            const bgElements = document.querySelectorAll('.hero-bg');
            const heroContent = document.querySelector('.hero-content');

            // Fade out current content
            heroContent.style.opacity = '0';

            setTimeout(() => {
                // Change background
                bgElements[currentBgIndex].classList.remove('active');

                currentBgIndex = (currentBgIndex + 1) % bgElements.length;
                bgElements[currentBgIndex].classList.add('active');

                // Update content
                const currentBg = heroBgImages[currentBgIndex];
                document.querySelector('.hero h1').textContent = currentBg.title;
                document.querySelector('.hero-info .year').textContent = currentBg.year;
                document.querySelector('.hero-info .rating').textContent = currentBg.rating + " Match";
                document.querySelector('.hero-info .duration').textContent = currentBg.duration;
                document.querySelector('.hero-description').textContent = currentBg.description;

                // Fade in new content
                heroContent.style.opacity = '1';
            }, 500);

            setTimeout(rotateBackground, 8000); // Rotate every 8 seconds
        }

        // Function to load movies into carousels
        function loadMovies() {
            // Load all categories
            for (const category in movies) {
                const carousel = document.getElementById(category);
                if (carousel) {
                    carousel.innerHTML = ''; // Clear existing content
                    movies[category].forEach(movie => {
                        const movieItem = createMovieItem(movie);
                        carousel.appendChild(movieItem);
                    });
                }
            }

            // Load My List
            updateMyList();
        }

        // Function to create a movie item element
        function createMovieItem(movie) {
            const movieItem = document.createElement('div');
            movieItem.className = 'movie-item';
            movieItem.innerHTML = `
                <img src="${movie.image}" alt="${movie.title}" title="${movie.title}">
                <div class="overlay">
                    <h3>${movie.title}</h3>
                    <div class="info">
                        <span>${movie.rating}</span>
                        <span>${movie.year}</span>
                        <span>${movie.duration}</span>
                    </div>
                </div>
            `;

            // Add progress bar for continue watching
            if (movie.progress) {
                const progressBar = document.createElement('div');
                progressBar.className = 'progress-bar';
                progressBar.style.width = `${movie.progress}%`;
                movieItem.querySelector('.overlay').appendChild(progressBar);
            }

            // Add click event to show details
            movieItem.addEventListener('click', () => {
                showDetails(movie.id, movie.type === "TV Show");
            });

            return movieItem;
        }

        // Function to show details page
        function showDetails(itemId, isSeries = false) {
            // Hide main content and show details page
            document.querySelector('.content').style.display = 'none';
            document.querySelector('.hero').style.display = 'none';
            document.getElementById('detailsPage').style.display = 'block';

            // Find the item in our data
            let item;
            for (const category in movies) {
                const found = movies[category].find(m => m.id === itemId);
                if (found) {
                    item = found;
                    break;
                }
            }

            if (!item) return;

            // Update details page with item info
            document.getElementById('detailsTitle').textContent = item.title;
            document.getElementById('detailsYear').textContent = item.year;
            document.getElementById('detailsRating').textContent = item.rating + " Match";
            document.getElementById('detailsDuration').textContent = item.duration;
            document.getElementById('detailsOverview').textContent = item.description || "No description available.";
            document.getElementById('detailsPoster').src = item.image;

            // Store current item for playback
            document.getElementById('detailsPage').dataset.itemId = itemId;
            document.getElementById('detailsPage').dataset.isSeries = isSeries;

            // Load episodes if it's a series
            if (isSeries) {
                loadEpisodes(itemId);
                document.getElementById('episodesContainer').style.display = 'block';
            } else {
                document.getElementById('episodesContainer').style.display = 'none';
            }

            // Update "My List" button state
            const isInList = myList.includes(itemId);
            const addBtn = document.getElementById('addToDetailsList');
            addBtn.classList.toggle('added', isInList);
            addBtn.innerHTML = isInList ?
                '<i class="fas fa-check"></i> My List' :
                '<i class="fas fa-plus"></i> My List';
        }

        // Function to load episodes for a series
        function loadEpisodes(seriesId) {
            const episodesContainer = document.getElementById('episodesContainer');
            episodesContainer.innerHTML = '';

            // In a real app, you would fetch these from an API
            // For demo, we'll create sample episodes
            const sampleEpisodes = [{
                    id: 1,
                    title: "Episode 1: The Beginning",
                    description: "The story begins with an unexpected event that changes everything for our characters.",
                    duration: "45m",
                    thumbnail: "https://image.tmdb.org/t/p/original/bZGAX8oMDm3Mo5i0ZPKh9G2OcaO.jpg"
                },
                {
                    id: 2,
                    title: "Episode 2: The Plot Thickens",
                    description: "Secrets are revealed as the characters deal with the aftermath of the first episode.",
                    duration: "47m",
                    thumbnail: "https://image.tmdb.org/t/p/original/5MkBAawsj7O9zitVtzMXagyrIBw.jpg"
                },
                {
                    id: 3,
                    title: "Episode 3: Major Revelations",
                    description: "A shocking truth comes to light that will change the course of the story forever.",
                    duration: "52m",
                    thumbnail: "https://image.tmdb.org/t/p/original/d5NXSklXo0qyIYkgV94XAgMIckC.jpg"
                },
                {
                    id: 4,
                    title: "Episode 4: The Turning Point",
                    description: "The characters face their biggest challenge yet as the story reaches a critical moment.",
                    duration: "49m",
                    thumbnail: "https://image.tmdb.org/t/p/original/7RyHsO4yDXtBv1zUU3mTpHeQ0d5.jpg"
                }
            ];

            sampleEpisodes.forEach(episode => {
                const episodeCard = document.createElement('div');
                episodeCard.className = 'episode-card';
                episodeCard.onclick = () => location.href = '/player.php?' + episode;
                episodeCard.innerHTML = `
                    <img class="episode-thumbnail" src="${episode.thumbnail}" alt="${episode.title}">
                    <div class="episode-info">
                        <div class="episode-title">${episode.title} • ${episode.duration}</div>
                        <div class="episode-description">${episode.description}</div>
                    </div>
                `;
                episodesContainer.appendChild(episodeCard);
            });
        }

        // Function to play media (movie or series episode)
        function playMedia(itemId = null, isSeries = false) {
            location.href = '/player.php';
            // If no itemId provided, use the one from details page
            if (itemId === null) {
                itemId = document.getElementById('detailsPage').dataset.itemId;
                isSeries = document.getElementById('detailsPage').dataset.isSeries === 'true';
            }

            if (isSeries) {
                // Play first episode by default
                playEpisode(itemId, 1);
            } else {
                // Play movie
                openVideoPlayer(`videos/movies/${itemId}.mp4`);
            }
        }

        // Function to play specific episode
        function playEpisode(seriesId, episodeId) {
            location.href = '/player.php';
            openVideoPlayer(`videos/series/${seriesId}/s1e${episodeId}.mp4`);
        }

        // Function to open video player
        function openVideoPlayer(videoSrc) {
            location.href = '/player.php';
            const player = document.getElementById('videoPlayer');
            player.src = videoSrc;
            player.load();
            document.getElementById('videoPlayerContainer').style.display = 'flex';
            player.play();
        }

        // Function to close video player
        function closeVideoPlayer() {
            location.href = '/player.php';
            const player = document.getElementById('videoPlayer');
            player.pause();
            document.getElementById('videoPlayerContainer').style.display = 'none';
        }

        // Function to go back from details page
        function backToBrowse() {
            document.getElementById('detailsPage').style.display = 'none';
            document.querySelector('.content').style.display = 'block';
            document.querySelector('.hero').style.display = 'flex';
        }

        // Function to update My List display
        function updateMyList() {
            const myListCarousel = document.getElementById('myList');
            if (myListCarousel) {
                myListCarousel.innerHTML = '';
                if (myList.length === 0) {
                    myListCarousel.innerHTML = '<p class="empty-list">Your list is empty. Add movies and TV shows to watch later.</p>';
                } else {
                    myList.forEach(movieId => {
                        // Find the movie in any category
                        let movie;
                        for (const category in movies) {
                            const found = movies[category].find(m => m.id === movieId);
                            if (found) {
                                movie = found;
                                break;
                            }
                        }
                        if (movie) {
                            const movieItem = createMovieItem(movie);
                            myListCarousel.appendChild(movieItem);
                        }
                    });
                }
            }
        }

        // Function to toggle item in My List
        function toggleMyList(movieId) {
            const index = myList.indexOf(movieId);
            if (index === -1) {
                myList.push(movieId);
            } else {
                myList.splice(index, 1);
            }
            updateMyList();
            localStorage.setItem(`myList_${currentProfile}`, JSON.stringify(myList));

            // Update the "My List" button in details page if we're viewing this item
            if (document.getElementById('detailsPage').dataset.itemId == movieId) {
                const addBtn = document.getElementById('addToDetailsList');
                const isInList = myList.includes(movieId);
                addBtn.classList.toggle('added', isInList);
                addBtn.innerHTML = isInList ?
                    '<i class="fas fa-check"></i> My List' :
                    '<i class="fas fa-plus"></i> My List';
            }
        }

        // Function to show profile selection modal
        function showProfileModal() {
            document.getElementById('profileModal').style.display = 'flex';
        }

        // Function to select a profile
        function selectProfile(profileName, imgPath) {
            currentProfile = profileName;
            document.getElementById('currentProfileName').textContent = profileName;
            document.getElementById('currentProfileImg').src = `https://randomuser.me/api/portraits/${imgPath}.jpg`;

            // Load profile's My List from localStorage
            const savedList = localStorage.getItem(`myList_${profileName}`);
            myList = savedList ? JSON.parse(savedList) : [];
            updateMyList();

            // Close modal
            document.getElementById('profileModal').style.display = 'none';
            document.getElementById('profileMenu').style.display = 'none';
        }

        // Function to toggle profile menu
        function toggleProfileMenu() {
            const menu = document.getElementById('profileMenu');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        // Function to logout
        function logout() {
            // Remove login status but keep subscription info
            // localStorage.removeItem('isLoggedIn');

            // // Hide main content and show email entry page
            // document.getElementById('emailEntryPage').style.display = 'flex';
            // document.querySelector('.navbar').style.display = 'none';
            // document.querySelector('.hero').style.display = 'none';
            // document.querySelector('.content').style.display = 'none';
            // document.getElementById('detailsPage').style.display = 'none';
            // document.getElementById('videoPlayerContainer').style.display = 'none';

            // // Close profile menu
            // document.getElementById('profileMenu').style.display = 'none';

            // // Reset to default profile
            // currentProfile = "Profile 1";
        }

        // Function to open search overlay
        function openSearch() {
            document.getElementById('searchOverlay').style.display = 'block';
            document.getElementById('searchInput').focus();
        }

        // Function to close search overlay
        function closeSearch() {
            document.getElementById('searchOverlay').style.display = 'none';
            document.getElementById('searchInput').value = '';
            document.getElementById('searchResults').innerHTML = '';
        }

        // Function to search movies and TV shows
        function searchContent(query) {
            const resultsContainer = document.getElementById('searchResults');
            resultsContainer.innerHTML = '';

            if (query.length < 2) return;

            const results = [];
            for (const category in movies) {
                movies[category].forEach(item => {
                    if (item.title.toLowerCase().includes(query.toLowerCase())) {
                        results.push(item);
                    }
                });
            }

            if (results.length === 0) {
                resultsContainer.innerHTML = '<p class="no-results">No results found for "' + query + '"</p>';
            } else {
                results.forEach(item => {
                    const resultItem = document.createElement('div');
                    resultItem.className = 'search-result-item';
                    resultItem.innerHTML = `
                        <img src="${item.image}" alt="${item.title}">
                        <h4>${item.title}</h4>
                        <p>${item.year} • ${item.type}</p>
                    `;
                    resultItem.addEventListener('click', () => {
                        closeSearch();
                        showDetails(item.id, item.type === "TV Show");
                    });
                    resultsContainer.appendChild(resultItem);
                });
            }
        }

        // Function to toggle notifications dropdown
        function toggleNotifications() {
            const dropdown = document.getElementById('notificationsDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Function to handle category navigation
        function setupCategoryNavigation() {
            document.getElementById('tvShowsLink').addEventListener('click', (e) => {
                e.preventDefault();
                scrollToSection('tvShowsSection');
            });

            document.getElementById('moviesLink').addEventListener('click', (e) => {
                e.preventDefault();
                scrollToSection('moviesSection');
            });

            document.getElementById('newPopularLink').addEventListener('click', (e) => {
                e.preventDefault();
                scrollToSection('newPopularSection');
            });

            document.getElementById('myListLink').addEventListener('click', (e) => {
                e.preventDefault();
                scrollToSection('myListSection');
            });
        }

        // Function to scroll to a specific section smoothly
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            // if (section) {
            //     // Hide all category sections first
            //     document.querySelectorAll('.category-section').forEach(s => {
            //         s.style.display = 'none';
            //     });

            //     // Show the selected section
            //     section.style.display = 'block';

            //     // Update active nav link
            //     document.querySelectorAll('.nav-links a').forEach(link => {
            //         link.classList.remove('active');
            //     });
            //     event.target.classList.add('active');

            //     // Scroll to section
            //     section.scrollIntoView({
            //         behavior: 'smooth',
            //         block: 'start'
            //     });
            // }
        }

        // Function to scroll carousel
        function scrollCarousel(carouselId, scrollAmount) {
            const carousel = document.getElementById(carouselId);
            if (carousel) {
                carousel.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            }
        }

        // Function to go to home
        function goToHome() {
            document.querySelector('.content').style.display = 'block';
            document.querySelector('.hero').style.display = 'flex';
            document.getElementById('detailsPage').style.display = 'none';

            // Scroll to top
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });

            // Reset active nav link
            document.querySelectorAll('.nav-links a').forEach(link => {
                link.classList.remove('active');
            });
            document.querySelector('.nav-links a[href="#home"]').classList.add('active');
        }

        // Fonction pour valider l'email
        function validateEmail() {
            const emailInput = document.getElementById('userEmail');
            const email = emailInput.value.trim();

            // Validation simple d'email
            if (!email.includes('@') || !email.includes('.')) {
                alert('Veuillez entrer une adresse e-mail valide');
                return;
            }

            userEmail = email;

            // Masquer la page email et afficher la page des abonnements
            document.getElementById('emailEntryPage').style.display = 'none';
            document.getElementById('plansPage').style.display = 'block';
        }

        // Fonction pour sélectionner un abonnement
        function selectPlan(plan) {
            selectedPlan = plan;

            // Mettre en évidence le plan sélectionné
            document.querySelectorAll('.plan-card').forEach(card => {
                card.style.border = 'none';
            });
            event.currentTarget.style.border = '2px solid #FFD700';

            // Masquer la page des abonnements et afficher la page de paiement
            document.getElementById('plansPage').style.display = 'none';
            document.getElementById('paymentPage').style.display = 'block';
        }

        // Fonction pour sélectionner un mode de paiement
        function selectPayment(method) {
            paymentMethod = method;

            // Mettre en évidence la méthode sélectionnée
            document.querySelectorAll('.payment-card').forEach(card => {
                card.style.border = 'none';
            });
            event.currentTarget.style.border = '2px solid #FFD700';

            // Afficher les détails appropriés
            if (method === 'card') {
                document.getElementById('cardDetails').style.display = 'block';
                document.getElementById('paypalRedirect').style.display = 'none';
            } else {
                document.getElementById('cardDetails').style.display = 'none';
                document.getElementById('paypalRedirect').style.display = 'block';
            }
        }

        // Fonction pour traiter le paiement
        function processPayment() {
            // Ici, vous intégreriez normalement un vrai système de paiement
            // Pour cet exemple, nous simulons simplement le paiement

            alert('Paiement effectué avec succès !');

            // Masquer la page de paiement et afficher le contenu principal
            completeRegistration();
        }

        // Fonction pour rediriger vers PayPal
        function redirectToPayPal() {
            // En production, vous redirigeriez vers l'API PayPal
            alert('Redirection vers PayPal...');

            // Simulation - après 2 secondes, considérer le paiement réussi
            setTimeout(() => {
                completeRegistration();
            }, 2000);
        }

        // Fonction pour terminer l'inscription
        function completeRegistration() {
            // Enregistrer les informations dans localStorage
            localStorage.setItem('userEmail', userEmail);
            localStorage.setItem('selectedPlan', selectedPlan);
            localStorage.setItem('paymentMethod', paymentMethod);
            localStorage.setItem('isSubscribed', 'true');
            localStorage.setItem('isLoggedIn', 'true');

            // Masquer toutes les pages d'inscription
            document.getElementById('emailEntryPage').style.display = 'none';
            document.getElementById('plansPage').style.display = 'none';
            document.getElementById('paymentPage').style.display = 'none';

            // Afficher la page principale
            document.querySelector('.navbar').style.display = 'flex';
            document.querySelector('.hero').style.display = 'flex';
            document.querySelector('.content').style.display = 'block';
            document.getElementById('detailsPage').style.display = 'none';
        }

        // Fonction pour afficher le formulaire de connexion
        function showLoginForm() {
            const emailContent = document.querySelector('.email-content');
            emailContent.innerHTML = `
                <h1>Se connecter</h1>
                <div class="login-form">
                    <input type="email" id="loginEmail" placeholder="Adresse e-mail" required>
                    <input type="password" id="loginPassword" placeholder="Mot de passe" required>
                    <button onclick="login()">Se connecter</button>
                    <p class="login-link">Nouveau sur Watch Now ? <a href="#" onclick="showEmailForm()">Inscrivez-vous maintenant</a></p>
                </div>
            `;
        }

        // Fonction pour afficher le formulaire d'email
        function showEmailForm() {
            const emailContent = document.querySelector('.email-content');
            emailContent.innerHTML = `
                <h1>Films, séries et bien plus en illimité.</h1>
                <h2>Où que vous soyez. Annulez à tout moment.</h2>
                <p>Prêt à regarder Watch Now ? Entrez votre adresse e-mail pour créer ou réactiver votre abonnement.</p>
                <div class="email-form">
                    <input type="email" id="userEmail" placeholder="Adresse e-mail" required>
                    <button onclick="validateEmail()">Commencer <i class="fas fa-chevron-right"></i></button>
                </div>
                <p class="login-link">Déjà membre ? <a href="#" onclick="showLoginForm()">Se connecter</a></p>
            `;
        }

        // Fonction pour gérer la connexion
        function login() {
            const email = document.getElementById('loginEmail').value.trim();
            const password = document.getElementById('loginPassword').value;

            // Ici, vous vérifieriez normalement les identifiants avec votre backend
            // Pour cet exemple, nous vérifions simplement si l'email est valide

            if (!email.includes('@')) {
                alert('Veuillez entrer une adresse e-mail valide');
                return;
            }

            if (password.length < 6) {
                alert('Le mot de passe doit contenir au moins 6 caractères');
                return;
            }

            // Simuler une connexion réussie
            localStorage.setItem('isLoggedIn', 'true');

            // Masquer la page d'email et afficher le contenu principal
            document.getElementById('emailEntryPage').style.display = 'none';
            document.querySelector('.navbar').style.display = 'flex';
            document.querySelector('.hero').style.display = 'flex';
            document.querySelector('.content').style.display = 'block';
        }

        // Function to handle navbar hide/show on scroll
        function handleNavbarScroll() {
            const navbar = document.querySelector('.navbar');
            let lastScroll = 0;

            window.addEventListener('scroll', () => {
                const currentScroll = window.pageYOffset;

                if (currentScroll <= 0) {
                    navbar.classList.remove('hidden');
                    return;
                }

                if (currentScroll > lastScroll && !navbar.classList.contains('hidden')) {
                    // Scroll down
                    navbar.classList.add('hidden');
                } else if (currentScroll < lastScroll && navbar.classList.contains('hidden')) {
                    // Scroll up
                    navbar.classList.remove('hidden');
                }

                lastScroll = currentScroll;

                // Add scrolled class for background color
                if (window.scrollY > 100) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        }

        // Initialize the page
        document.addEventListener('DOMContentLoaded', () => {
            // Load movies and setup UI
            loadMovies();
            selectProfile(currentProfile, 'men/32');

            // Setup search functionality
            document.getElementById('searchInput').addEventListener('input', (e) => {
                searchContent(e.target.value);
            });

            // Setup category navigation
            setupCategoryNavigation();

            // Setup "Add to My List" button
            document.getElementById('addToMyList').addEventListener('click', function() {
                this.classList.toggle('added');
                this.innerHTML = this.classList.contains('added') ?
                    '<i class="fas fa-check"></i> My List' :
                    '<i class="fas fa-plus"></i> My List';
                // Add the featured movie to My List
                toggleMyList(1); // Assuming The Dark Knight has ID 1
            });

            // Setup "Add to My List" button in details page
            document.getElementById('addToDetailsList').addEventListener('click', function() {
                const itemId = document.getElementById('detailsPage').dataset.itemId;
                toggleMyList(parseInt(itemId));
            });

            // Close notifications dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.notification-icon') && !e.target.closest('.notifications-dropdown')) {
                    document.getElementById('notificationsDropdown').style.display = 'none';
                }

                if (!e.target.closest('.profile')) {
                    document.getElementById('profileMenu').style.display = 'none';
                }
            });

            // Check if user is subscribed and logged in
            const isSubscribed = localStorage.getItem('isSubscribed');
            const isLoggedIn = localStorage.getItem('isLoggedIn');

            if (1) {
                // User is subscribed and logged in, show main content
                document.getElementById('emailEntryPage').style.display = 'none';
            } else if (isSubscribed === 'true' && isLoggedIn !== 'true') {
                // User is subscribed but not logged in, show login form
                document.getElementById('emailEntryPage').style.display = 'flex';
                document.querySelector('.navbar').style.display = 'none';
                document.querySelector('.hero').style.display = 'none';
                document.querySelector('.content').style.display = 'none';
                document.getElementById('detailsPage').style.display = 'none';
                showLoginForm();
            } else {
                // New user, show email form
                document.getElementById('emailEntryPage').style.display = 'flex';
                document.querySelector('.navbar').style.display = 'none';
                document.querySelector('.hero').style.display = 'none';
                document.querySelector('.content').style.display = 'none';
                document.getElementById('detailsPage').style.display = 'none';
            }

            // Start background rotation
            setTimeout(rotateBackground, 8000);

            // Setup navbar scroll behavior
            handleNavbarScroll();
        });

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
        }

        function closeMobileMenu() {
            document.getElementById('mobileMenu').style.display = 'none';
        }
    </script>
</body>

</html>