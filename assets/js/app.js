
// Placeholder for future interactivity
document.addEventListener('DOMContentLoaded', () => {
  // Example: focus first input when modal opens
  const modal = document.getElementById('preisrechnerModal');
  if (modal) {
    modal.addEventListener('shown.bs.modal', () => {
      const input = modal.querySelector('input');
      if (input) input.focus();
    });
  }
});
