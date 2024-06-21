<!-- SIDEBAR -->
<section id="sidebar" class="hide">
    <a href="#" class="brand" style="display: flex; justify-content: center;">
        <img class='bx bxs-smile mt-10 p-1' src="{{ asset('Logo-Kalbe.0cf6623a.svg') }}" style="max-width: 150px; max-height: 140px; width: auto; height: auto;">
    </a>
    <ul class="side-menu top">
    <li id="nav-jpm" class="side-item">
            <a href="{{ route('pjl.line.dashboard', ['line' => Auth::user()->role]) }}">
                <i class='bx bxs-dashboard'></i>
                <span class="text">JPM</span>
            </a>
        </li>
        <li id="nav-pm" class="side-item">
            <a href="{{ route('pjl.line.pmDashboard', ['line' => Auth::user()->role]) }}">
                <i class='bx bx-grid'></i>
                <span class="text">PM</span>
            </a>
        </li>
        <li id="nav-approval" class="side-item">
            <a href="{{ route('pjl.line.approval', ['line' => Auth::user()->role]) }}">
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
        <i class='bx bx-menu bx-menu-large'></i>
        <form action="#">
        </form>
        <div class="profile" style="position: relative;">
            <img src="{{ asset('profile.png') }}" id="profileImage" style="cursor: pointer;">
            <div class="dropdown" id="profileDropdown" style="display: none; position: absolute; right: 0; background: white; border: 1px solid #ccc; border-radius: 4px; z-index: 1000; width: 100px; opacity: 0; transform: translateY(-10px); transition: opacity 0.3s ease, transform 0.3s ease;">
            <div class="py-0">
                    <a href="#" id="signOut" class="block px-4 py-2 text-sm text-center hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white" style="display: block; width: 100%; transition: background-color 0.3s ease;">Sign out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- NAVBAR -->

    <!-- Dynamic content will be loaded here -->
    <div id="main-content"></div>
</section>


	</section>
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
        const dashboardUrl = '{{ route('pjl.line.dashboard', ['line' => Auth::user()->role]) }}';
        const approvalUrl = '{{ route('pjl.line.approval', ['line' => Auth::user()->role]) }}';
        const pmUrl = '{{ route('pjl.line.pmDashboard', ['line' => Auth::user()->role]) }}';

        if (currentUrl === dashboardUrl) {
            setActiveNavItem('nav-jpm');
        } else if (currentUrl === approvalUrl) {
            setActiveNavItem('nav-approval');
        } else if (currentUrl === pmUrl) {
            setActiveNavItem('nav-pm');
        } else {
            setActiveNavItem('nav-jpm'); // Default to JPM
        }
    }

    // Memuat konten awal berdasarkan URL saat halaman dimuat
 
    function loadInitialContent() {
        const currentUrl = window.location.href;
        const dashboardUrl = '{{ route('pjl.line.dashboard', ['line' => Auth::user()->role]) }}';
        const approvalUrl = '{{ route('pjl.line.approval', ['line' => Auth::user()->role]) }}';
        const pmUrl = '{{ route('pjl.line.pmDashboard', ['line' => Auth::user()->role]) }}';

        if (currentUrl === dashboardUrl) {
            loadContent(dashboardUrl, 'nav-jpm');
        } else if (currentUrl === approvalUrl) {
            loadContent(approvalUrl, 'nav-approval');
        } else if (currentUrl === pmUrl) {
            loadContent(pmUrl, 'nav-pm');
        } else {
            loadContent(dashboardUrl, 'nav-jpm'); // Default to JPM
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
        // Toggle visibility with transition
        if (profileDropdown.style.display === 'none' || profileDropdown.style.display === '') {
            profileDropdown.style.display = 'block';
            setTimeout(() => {
                profileDropdown.style.opacity = '1';
                profileDropdown.style.transform = 'translateY(0)';
            }, 10); // Small delay to trigger transition
        } else {
            profileDropdown.style.opacity = '0';
            profileDropdown.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                profileDropdown.style.display = 'none';
            }, 300); // Match the duration of the transition
        }
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!profileImage.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.style.opacity = '0';
            profileDropdown.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                profileDropdown.style.display = 'none';
            }, 300); // Match the duration of the transition
        }
    });

    // Sign out logic
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
