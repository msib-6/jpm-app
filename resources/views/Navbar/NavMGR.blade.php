<!-- SIDEBAR -->
<section id="sidebar">
<a href="#" class="brand">
        <img class='bx bxs-smile mt-4' src="{{ asset('Logo-Kalbe.0cf6623a.svg') }}" style="max-width: 180px; max-height: 160px; width: auto; height: auto;">
    </a>
    <ul class="side-menu top">
        <li id="nav-dashboard" class="side-item">
            <a href="{{ route('manager.dashboard') }}">
                <i class='bx bxs-dashboard'></i>
                <span class="text">Dashboard</span>
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
        <div class="profile" style="position: relative;">
            <img src="{{ asset('avatar1.png') }}" id="profileImage" style="cursor: pointer;">
            <div class="dropdown" id="profileDropdown" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; border-radius: 4px; z-index: 1000;">
                <div class="py-0">
                    <a href="#" id="signOut" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                </div>
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
        // Toggle visibility
        if (profileDropdown.style.display === 'none' || profileDropdown.style.display === '') {
            profileDropdown.style.display = 'block';
        } else {
            profileDropdown.style.display = 'none';
        }
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!profileImage.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.style.display = 'none';
        }
    });

    signOutButton.addEventListener('click', function(event) {
        event.preventDefault();
        // Create a form dynamically and submit it
        const logoutForm = document.createElement('form');
        logoutForm.method = 'POST';
        logoutForm.action = '{{ route('logout') }}';
        logoutForm.style.display = 'none';

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';

        logoutForm.appendChild(csrfToken);
        document.body.appendChild(logoutForm);
        logoutForm.submit();
    });
});
</script>

