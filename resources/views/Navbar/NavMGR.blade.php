<!-- SIDEBAR -->
<section id="sidebar" class="hide">
    <a href="#" class="brand" style="display: flex; justify-content: center;">
        <img class='bx bxs-smile mt-10 p-2 ml-2' src="{{ asset('Logo-Kalbe.0cf6623a.svg') }}" style="max-width: 150px; max-height: 140px; width: auto; height: auto;">
    </a>
    <ul class="side-menu top">
        <li id="nav-dashboard" class="side-item">
            <a href="{{ route('manager.dashboard') }}">
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

<!-- CONTENT -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Function to remove 'active' class from all sidebar items
    function removeActiveClass() {
        const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li');
        allSideMenu.forEach(item => {
            item.classList.remove('active');
        });
    }

    // Function to set 'active' class to the relevant sidebar item
    function setActiveNavItem(activeId) {
        removeActiveClass();
        document.getElementById(activeId).classList.add('active');
    }

    // Function to load content based on URL and set the active sidebar item
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

    // Set event listener for elements with data-link
    document.querySelectorAll('[data-link]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const url = this.getAttribute('href');
            const activeId = this.getAttribute('data-id');
            history.pushState(null, '', url); // Update URL without reloading
            loadContent(url, activeId);
        });
    });

    // Set active sidebar item based on the URL when the page loads
    function setInitialActiveItem() {
        const currentUrl = window.location.href;
        const dashboardUrl = '{{ route('manager.dashboard') }}';

        if (currentUrl === dashboardUrl) {
            setActiveNavItem('nav-dashboard');
        } else {
            setActiveNavItem('nav-dashboard'); // Default to Dashboard
        }
    }

    // Load initial content based on the URL when the page loads
    function loadInitialContent() {
        const currentUrl = window.location.href;
        const dashboardUrl = '{{ route('manager.dashboard') }}';

        if (currentUrl === dashboardUrl) {
            loadContent(dashboardUrl, 'nav-dashboard');
        } else {
            loadContent(dashboardUrl, 'nav-dashboard'); // Default to Dashboard
        }
    }

    // Call functions to set the active sidebar item and load initial content
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
