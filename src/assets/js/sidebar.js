const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const topbar = document.getElementById('topbar');
    const toggleBtn = document.getElementById('toggleBtn');
    const mobileBtn = document.getElementById('mobileBtn');
    const overlay = document.getElementById('overlay');

    // Desktop collapse
    if (toggleBtn) {
      toggleBtn.addEventListener('click', () => {
        if (sidebar) sidebar.classList.toggle('collapsed');
        if (content) content.classList.toggle('full');
        if (topbar) topbar.classList.toggle('full');
      });
    }

    // Mobile sidebar open
    if (mobileBtn) {
      mobileBtn.addEventListener('click', () => {
        if (sidebar) sidebar.classList.add('mobile-show');
        if (overlay) overlay.classList.add('show');
      });
    }

    // 🔥 Click outside to close
    if (overlay) {
      overlay.addEventListener('click', () => {
        if (sidebar) sidebar.classList.remove('mobile-show');
        if (overlay) overlay.classList.remove('show');
      });
    }

    // const currentPage = window.location.pathname.split('/').pop() || 'index.html';
    // const navLinks = document.querySelectorAll('.sidebar .nav-link');

    // if (navLinks.length > 0) {
    //   navLinks.forEach(link => {
    //     link.classList.remove('active');
    //     if (link.getAttribute('href') === currentPage) {
    //       link.classList.add('active');
    //     }
    //   });
    // }


    const currentPath = window.location.pathname.replace(/\/$/, '');

const navLinks = document.querySelectorAll('.sidebar .nav-link');

navLinks.forEach(link => {
  link.classList.remove('active');

  const linkPath = new URL(link.href).pathname.replace(/\/$/, '');

  if (
    linkPath === currentPath ||
    (currentPath === '' && linkPath.endsWith('index.html'))
  ) {
    link.classList.add('active');
  }
});
