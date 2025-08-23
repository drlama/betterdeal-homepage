// BetterDeal landing interactions + Preisrechner Wizard
(function() {
  // Open Wizard
  const modalEl = document.getElementById('preisrechnerModal');
  const modal = new bootstrap.Modal(modalEl);
  const openButtons = [document.getElementById('btnPreisrechner'), document.getElementById('btnPreisrechnerHero')].filter(Boolean);
  openButtons.forEach(btn => btn.addEventListener('click', () => { resetWizard(); modal.show(); }));

  // Contact form AJAX
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const fd = new FormData(contactForm);
      try {
        const res = await fetch('api/contact.php', { method:'POST', headers:{'X-CSRF-Token': CSRF_TOKEN}, body: fd });
        const data = await res.json();
        if (data.ok) {
          contactForm.reset();
          new bootstrap.Toast(document.getElementById('toastContact')).show();
        } else {
          alert(data.error || 'Fehler beim Senden');
        }
      } catch (err) {
        alert('Netzwerkfehler: ' + err.message);
      }
    });
  }

  // ==== Wizard code (from v2, adapted to segmented UI) ====
  const form = document.getElementById('preisrechnerForm');
  const btnWeiter = document.getElementById('btnWeiter');
  const btnSenden = document.getElementById('btnSenden');
  const btnZurueck = document.getElementById('btnZurueck');
  const wizardProgress = document.getElementById('wizardProgress');
  const objektartError = document.getElementById('objektartError');
  let step = 1;

  function setStep(n) {
    step = n;
    document.querySelectorAll('.wizard-step').forEach(s => s.classList.add('d-none'));
    document.querySelector(`.wizard-step[data-step="${n}"]`).classList.remove('d-none');
    btnZurueck.disabled = (step === 1);
    btnSenden.classList.toggle('d-none', step !== 3);
    btnWeiter.classList.toggle('d-none', step === 3);
    wizardProgress.style.width = (step === 1 ? 33 : step === 2 ? 66 : 100) + '%';
  }

  function resetWizard() {
    if (!form) return;
    form.reset();
    document.querySelectorAll('.segment .seg').forEach(c => c.classList.remove('active'));
    document.getElementById('detailsWohnung').classList.add('d-none');
    document.getElementById('detailsHaus').classList.add('d-none');
    document.getElementById('detailsMFH').classList.add('d-none');
    objektartError.style.display = 'none';
    setStep(1);
  }

  document.querySelectorAll('.btn-check').forEach(input => {
    input.addEventListener('change', () => {
      document.querySelectorAll('.segment .seg').forEach(c => c.classList.remove('active'));
      input.closest('label').querySelector('.seg').classList.add('active');
      objektartError.style.display = 'none';
      toggleDetails(input.value);
    });
  });

  function toggleDetails(art) {
    document.getElementById('detailsWohnung').classList.toggle('d-none', art !== 'wohnung');
    document.getElementById('detailsHaus').classList.toggle('d-none', art !== 'haus');
    document.getElementById('detailsMFH').classList.toggle('d-none', art !== 'mehrfamilienhaus');
  }

  if (btnWeiter) btnWeiter.addEventListener('click', () => {
    if (step === 1) {
      const adr = document.getElementById('adresse');
      if (!adr.value.trim()) { adr.classList.add('is-invalid'); adr.focus(); return; }
      adr.classList.remove('is-invalid');
      setStep(2); return;
    }
    if (step === 2) {
      const selected = document.querySelector('input[name="objektart"]:checked');
      if (!selected) { objektartError.style.display = 'block'; return; }
      toggleDetails(selected.value);
      setStep(3); return;
    }
  });

  if (btnZurueck) btnZurueck.addEventListener('click', () => { if (step > 1) setStep(step-1); });

  if (form) form.addEventListener('submit', async function (event) {
    document.querySelectorAll('[required]').forEach(el => { if (el.closest('.d-none')) el.dataset.requiredWas='1', el.required=false; });
    if (!form.checkValidity()) {
      event.preventDefault(); event.stopPropagation(); form.classList.add('was-validated');
      document.querySelectorAll('[data-required-was="1"]').forEach(el => { el.required=true; delete el.dataset.requiredWas; });
      return;
    }
    event.preventDefault(); event.stopPropagation();
    const formData = new FormData(form); formData.append('ts', new Date().toISOString());
    try {
      const res = await fetch('api/submit_price_request.php', { method:'POST', headers:{'X-CSRF-Token': CSRF_TOKEN}, body: formData });
      const data = await res.json();
      if (data.ok) { new bootstrap.Toast(document.getElementById('toastSuccess')).show(); modal.hide(); }
      else { alert('Fehler: ' + (data.error || 'Unbekannt')); }
    } catch (e) { alert('Netzwerkfehler: ' + e.message); }
    finally { document.querySelectorAll('[data-required-was="1"]').forEach(el => { el.required=true; delete el.dataset.requiredWas; }); }
  });
})();