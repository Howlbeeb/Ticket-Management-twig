function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('-translate-x-full');
}

function toggleDarkMode() {
  document.documentElement.classList.toggle('dark');
}
