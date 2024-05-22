<!-- SIDEBAR -->
<section id="sidebar">
    <a href="#" class="brand">
        <img class='bx bxs-smile' src="{{ asset('Logo_kalbe.png') }}" style="max-width: 100px; max-height: 50px; width: auto; height: auto;">
    </a>
    <ul class="side-menu top">
        <li id="nav-dashboard" class="side-item">
            <a href="{{ route('manager.dashboard') }}">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li id="nav-approval" class="side-item">
            <a href="{{ route('manager.approve') }}">
                <i class='bx bxs-doughnut-chart'></i>
                <span class="text">Status</span>
            </a>
        </li>
    </ul>
</section>
<!-- SIDEBAR -->

<!-- NAVBAR -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" style="display: none;">
        <label for="switch-mode" class="switch-mode"></label>
        <a href="#" class="notification">
            <i class='bx bxs-bell'></i>
            <span class="num">8</span>
        </a>
        <div class="profile">
            <img src="{{ asset('avatar1.png') }}" id="profileImage">
            <div class="dropdown hidden" id="profileDropdown">
                <a href="#" id="signOut">Sign Out</a>
            </div>
        </div>
    </nav>
    <!-- NAVBAR -->

    <!-- Dynamic content will be loaded here -->
    <div id="main-content"></div>
</section>
<!-- CONTENT -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk menghapus kelas 'active' dari semua elemen sidebar
    function removeActiveClass() {
        const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li');
        allSideMenu.forEach(item => {
            item.classList.remove('active');
        });
    }

    // Fungsi untuk menetapkan kelas 'active' ke elemen sidebar yang relevan
    function setActiveNavItem(activeId) {
        removeActiveClass();
        document.getElementById(activeId).classList.add('active');
    }

    // Fungsi untuk memuat konten berdasarkan URL dan menetapkan elemen sidebar yang aktif
    function loadContent(url, activeId) {
        axios.get(url)
            .then(function (response) {
                document.getElementById('main-content').innerHTML = response.data;
                setActiveNavItem(activeId);
            })
            .catch(function (error) {
                console.error('Error loading content:', error);
            });
    }

    // Mengatur event listener untuk elemen dengan data-link
    document.querySelectorAll('[data-link]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            const activeId = this.getAttribute('data-id');
            history.pushState(null, '', url); // Update URL without reloading
            loadContent(url, activeId);
        });
    });

    // Menetapkan elemen sidebar yang aktif berdasarkan URL saat halaman dimuat
    function setInitialActiveItem() {
        const currentUrl = window.location.href;
        const dashboardUrl = '{{ route('manager.dashboard') }}';
        const approvalUrl = '{{ route('manager.approve') }}';

        if (currentUrl === dashboardUrl) {
            setActiveNavItem('nav-dashboard');
        } else if (currentUrl === approvalUrl) {
            setActiveNavItem('nav-approval');
        } else {
            setActiveNavItem('nav-dashboard'); // Default to Dashboard
        }
    }

    // Memuat konten awal berdasarkan URL saat halaman dimuat
    function loadInitialContent() {
        const currentUrl = window.location.href;
        const dashboardUrl = '{{ route('manager.dashboard') }}';
        const approvalUrl = '{{ route('manager.approve') }}';

        if (currentUrl === dashboardUrl) {
            loadContent(dashboardUrl, 'nav-dashboard');
        } else if (currentUrl === approvalUrl) {
            loadContent(approvalUrl, 'nav-approval');
        } else {
            loadContent(dashboardUrl, 'nav-dashboard'); // Default to Dashboard
        }
    }

    // Panggil fungsi untuk menetapkan elemen sidebar yang aktif dan memuat konten awal
    setInitialActiveItem();
    loadInitialContent();
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileImage = document.getElementById('profileImage');
    const profileDropdown = document.getElementById('profileDropdown');
    const signOutButton = document.getElementById('signOut');

    profileImage.addEventListener('click', function(event) {
        event.preventDefault();
        profileDropdown.classList.toggle('hidden');
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!profileImage.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.add('hidden');
        }
    });

    signOutButton.addEventListener('click', function(event) {
        event.preventDefault();
        // Add sign-out logic here
        console.log('Sign Out clicked');
    });
});
</script>
