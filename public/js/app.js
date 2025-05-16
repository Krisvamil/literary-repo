document.addEventListener('DOMContentLoaded', () => {
  // Auto-dismiss alerts
  document.querySelectorAll('.alert').forEach(alert => {
    setTimeout(() => {
      alert.style.opacity = '0';
      setTimeout(() => alert.remove(), 500);
    }, 3000);
  });

  // Toggle elements via data-toggle="#selector"
  document.querySelectorAll('[data-toggle]').forEach(toggler => {
    const selector = toggler.getAttribute('data-toggle');
    if (!selector) return;
    const target = document.querySelector(selector);
    if (!target) return;
    toggler.addEventListener('click', () => {
      target.classList.toggle('hidden');
    });
  });

  // Input focus visuals (already styled in CSS, optional JS fallback)
  document.querySelectorAll('input, textarea').forEach(input => {
    input.addEventListener('focus', () => input.classList.add('focused'));
    input.addEventListener('blur', () => input.classList.remove('focused'));
  });

  // Optional: Scroll to top buttons or interactive modals can be added here
});
