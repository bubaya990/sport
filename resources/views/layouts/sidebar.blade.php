<!-- Toggle Button -->
<button class="toggle-btn" id="toggleBtn">☰</button>

<!-- Overlay -->
<div class="overlay" id="overlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h2>Baya</h2>
        <div class="glow-orb"></div>
    </div>
    
    <div class="sidebar-nav">
        <div class="nav-section">
            <div class="nav-section-title">Main</div>
            <a href="{{ route('site.dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-ripple"></span>
                Visitor Dashboard
            </a>
            <a href="{{ route('aboutus.index') }}" class="nav-link">
                <span class="nav-ripple"></span>
                About us
            </a>
            @auth
            <a href="{{ route('participants.index') }}" class="nav-link">
                <span class="nav-ripple"></span>
                Participants
            </a>
             @endauth
            <a href="{{ route('evenements.index') }}" class="nav-link {{ request()->routeIs('evenements.*') ? 'active' : '' }}">
                <span class="nav-ripple"></span>
                Our events
            </a>
        </div>
    </div>
    
    <div class="sidebar-footer">
        @auth
        <form id="logoutForm" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <span class="logout-wave"></span>
                <span class="logout-glow"></span>
                Logout
            </button>
        </form>
        @endauth
    </div>
</aside>

<style>
    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes orbFloat {
        0%, 100% {
            transform: translate(0, 0) scale(1);
            opacity: 0.4;
        }
        50% {
            transform: translate(30px, -20px) scale(1.3);
            opacity: 0.6;
        }
    }

    @keyframes shimmer {
        0% {
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
        }
        100% {
            transform: translateX(300%) translateY(300%) rotate(45deg);
        }
    }

    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 0 20px rgba(0, 140, 150, 0.4);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 0 40px rgba(0, 180, 220, 0.6);
        }
    }

    @keyframes wave {
        0% {
            transform: translateX(-100%) skewX(-15deg);
        }
        100% {
            transform: translateX(200%) skewX(-15deg);
        }
    }

    @keyframes logoutGlow {
        0%, 100% {
            opacity: 0.6;
            filter: blur(15px);
        }
        50% {
            opacity: 1;
            filter: blur(20px);
        }
    }

    @keyframes borderRun {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Sidebar Styles */
    .sidebar {
        width: 250px;
        background: #0a1420;
        color: white;
        padding: 0;
        position: fixed;
        left: -250px;
        top: 0;
        height: 100vh;
        transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        z-index: 1000;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border-right: 2px solid rgba(0, 140, 150, 0.3);
    }

    .sidebar::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, 
            rgba(0, 140, 150, 0.05) 0%,
            transparent 50%,
            rgba(0, 140, 150, 0.05) 100%
        );
        pointer-events: none;
    }

    .sidebar.open {
        transform: translateX(250px);
        box-shadow: 
            10px 0 50px rgba(0, 140, 150, 0.3),
            20px 0 100px rgba(0, 140, 150, 0.1);
    }

    .sidebar-header {
        padding: 30px 20px;
        border-bottom: 1px solid rgba(0, 140, 150, 0.2);
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, 
            rgba(0, 140, 150, 0.1) 0%,
            rgba(0, 140, 150, 0.05) 100%
        );
    }

    .glow-orb {
        position: absolute;
        top: 50%;
        right: 20px;
        width: 60px;
        height: 60px;
        background: radial-gradient(circle, 
            rgba(0, 200, 220, 0.3) 0%,
            rgba(0, 140, 150, 0.1) 50%,
            transparent 70%
        );
        border-radius: 50%;
        animation: orbFloat 6s ease-in-out infinite;
        filter: blur(10px);
    }

    .sidebar-header h2 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #ffffff;
        position: relative;
        z-index: 1;
        letter-spacing: 0.5px;
        animation: fadeIn 0.6s ease-out;
    }

    .sidebar-nav {
        flex: 1;
        padding: 30px 0;
        overflow-y: auto;
    }

    .nav-section {
        animation: slideIn 0.5s ease-out;
    }

    .nav-section-title {
        padding: 0 25px 15px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: rgba(0, 180, 200, 0.8);
        letter-spacing: 2px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        margin: 8px 20px;
        padding: 14px 20px;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 15px;
        position: relative;
        overflow: hidden;
        background: rgba(0, 140, 150, 0.05);
    }

    .nav-ripple {
        position: absolute;
        inset: 0;
        border-radius: 12px;
        background: radial-gradient(circle, 
            rgba(0, 180, 220, 0.4) 0%,
            transparent 70%
        );
        transform: scale(0);
        opacity: 0;
    }

    .sidebar a::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(180deg, 
            transparent 0%,
            #00d4ff 50%,
            transparent 100%
        );
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sidebar a::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, 
            transparent 0%,
            rgba(0, 180, 220, 0.1) 50%,
            transparent 100%
        );
        transform: translateX(-100%);
        transition: transform 0.5s ease;
    }

    .sidebar a:hover {
        background: rgba(0, 140, 150, 0.15);
        color: #ffffff;
        transform: translateX(5px);
        box-shadow: 0 5px 20px rgba(0, 140, 150, 0.2);
    }

    .sidebar a:hover::before {
        opacity: 1;
    }

    .sidebar a:hover::after {
        transform: translateX(100%);
    }

    .sidebar a:hover .nav-ripple {
        animation: ripple 0.6s ease-out;
    }

    .sidebar a.active {
        background: linear-gradient(135deg, 
            rgba(0, 180, 220, 0.25) 0%,
            rgba(0, 140, 150, 0.2) 100%
        );
        color: #ffffff;
        box-shadow: 
            0 0 20px rgba(0, 140, 150, 0.3),
            inset 0 0 20px rgba(0, 180, 220, 0.1);
    }

    .sidebar a.active::before {
        opacity: 1;
        background: linear-gradient(180deg, 
            #00ffff 0%,
            #00d4ff 50%,
            #00ffff 100%
        );
        box-shadow: 0 0 10px #00d4ff;
    }

    .sidebar-footer {
        padding: 20px;
        border-top: 1px solid rgba(0, 140, 150, 0.2);
        background: linear-gradient(135deg, 
            rgba(0, 140, 150, 0.08) 0%,
            rgba(0, 140, 150, 0.03) 100%
        );
        position: relative;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        padding: 16px 24px;
        border-radius: 12px;
        transition: all 0.4s ease;
        font-weight: 600;
        width: 100%;
        border: 2px solid;
        border-color: rgba(180, 50, 40, 0.5);
        cursor: pointer;
        position: relative;
        overflow: hidden;
        font-size: 15px;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, 
            rgba(120, 30, 30, 0.6) 0%,
            rgba(80, 20, 20, 0.5) 100%
        );
        box-shadow: 0 4px 15px rgba(180, 50, 40, 0.2);
    }

    .logout-wave {
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(220, 70, 50, 0.4) 50%,
            transparent 100%
        );
        transform: translateX(-100%) skewX(-15deg);
    }

    .logout-glow {
        position: absolute;
        inset: -20px;
        background: radial-gradient(circle,
            rgba(220, 70, 50, 0.5) 0%,
            transparent 70%
        );
        opacity: 0.6;
        filter: blur(15px);
        animation: logoutGlow 3s ease-in-out infinite;
    }

    .logout-btn:hover {
        transform: translateY(-3px);
        border-color: rgba(220, 70, 50, 0.8);
        background: linear-gradient(135deg, 
            rgba(180, 50, 40, 0.8) 0%,
            rgba(140, 30, 30, 0.7) 100%
        );
        box-shadow: 
            0 8px 30px rgba(220, 70, 50, 0.4),
            0 0 40px rgba(220, 70, 50, 0.2);
    }

    .logout-btn:hover .logout-wave {
        animation: wave 1s ease-in-out;
    }

    .logout-btn:active {
        transform: translateY(-1px);
    }

    /* Toggle Button */
    .toggle-btn {
        position: fixed;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, 
            rgba(0, 140, 150, 0.9) 0%,
            rgba(0, 100, 120, 0.8) 100%
        );
        color: white;
        border: 2px solid rgba(0, 180, 220, 0.5);
        padding: 12px 15px;
        border-radius: 12px;
        cursor: pointer;
        z-index: 1001;
        transition: all 0.3s ease;
        font-size: 20px;
        box-shadow: 0 4px 20px rgba(0, 140, 150, 0.3);
        animation: pulse 3s ease-in-out infinite;
    }

    .toggle-btn:hover {
        background: linear-gradient(135deg, 
            rgba(0, 180, 220, 1) 0%,
            rgba(0, 140, 150, 0.9) 100%
        );
        transform: scale(1.1);
        box-shadow: 0 6px 30px rgba(0, 180, 220, 0.5);
    }

    .toggle-btn:active {
        transform: scale(0.95);
    }

    .toggle-btn.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    /* Overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        z-index: 999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
    }

    .overlay.active {
        opacity: 1;
        visibility: visible;
    }

    /* Custom Scrollbar */
    .sidebar-nav::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.2);
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: rgba(0, 140, 150, 0.5);
        border-radius: 10px;
        transition: background 0.3s ease;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 180, 220, 0.7);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const body = document.body;

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('active');
            toggleBtn.classList.add('hidden');
            body.classList.add('sidebar-open');
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            toggleBtn.classList.remove('hidden');
            body.classList.remove('sidebar-open');
        }

        // Toggle sidebar when button is clicked
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        // Close sidebar when clicking on overlay
        overlay.addEventListener('click', closeSidebar);

        // Close sidebar when clicking anywhere outside
        document.addEventListener('click', function(e) {
            if (sidebar.classList.contains('open') && 
                !sidebar.contains(e.target) && 
                e.target !== toggleBtn) {
                closeSidebar();
            }
        });

        // Close sidebar when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('open')) {
                closeSidebar();
            }
        });
    });
</script>