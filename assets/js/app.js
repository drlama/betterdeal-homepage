// BetterDeal Preisrechner Wizard
(function() {
  const modalEl = document.getElementById('preisrechnerModal');
  const modal = new bootstrap.Modal(modalEl);
  const openButtons = [document.getElementById('btnPreisrechner'), document.getElementById('btnPreisrechnerHero')].filter(Boolean);

  openButtons.forEach(btn => btn.addEventListener('click', () => {
    resetWizard();
    modal.show();
  }));

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

    // Buttons
    btnZurueck.disabled = (step === 1);
    btnSenden.classList.toggle('d-none', step !== 3);
    btnWeiter.classList.toggle('d-none', step === 3);

    // Progress
    wizardProgress.style.width = (step === 1 ? 33 : step === 2 ? 66 : 100) + '%';
  }

  function resetWizard() {
    form.reset();
    // Clear custom selections
    document.querySelectorAll('.segment .seg').forEach(c => c.classList.remove('active'));
    document.getElementById('detailsWohnung').classList.add('d-none');
    document.getElementById('detailsHaus').classList.add('d-none');
    document.getElementById('detailsMFH').classList.add('d-none');
    objektartError.style.display = 'none';
    setStep(1);
  }

  // Selectable cards visual toggle
  document.querySelectorAll('.btn-check').forEach(input => {
    input.addEventListener('change', () => {
      document.querySelectorAll('.segment .seg').forEach(c => c.classList.remove('active'));
      input.closest('label').querySelector('.segment .seg').classList.add('active');
      objektartError.style.display = 'none';

      // show correct details when we reach step 3
      const art = input.value;
      toggleDetails(art);
    });
  });

  function toggleDetails(art) {
    document.getElementById('detailsWohnung').classList.toggle('d-none', art !== 'wohnung');
    document.getElementById('detailsHaus').classList.toggle('d-none', art !== 'haus');
    document.getElementById('detailsMFH').classList.toggle('d-none', art !== 'mehrfamilienhaus');
  }

  btnWeiter.addEventListener('click', () => {
    if (step === 1) {
      // validate address
      const adr = document.getElementById('adresse');
      if (!adr.value.trim()) {
        adr.classList.add('is-invalid');
        adr.focus();
        return;
      } else {
        adr.classList.remove('is-invalid');
      }
      setStep(2);
      return;
    }
    if (step === 2) {
      const selected = document.querySelector('input[name="objektart"]:checked');
      if (!selected) {
        objektartError.style.display = 'block';
        return;
      }
      // Prepare the correct details section
      toggleDetails(selected.value);
      setStep(3);
      return;
    }
  });

  btnZurueck.addEventListener('click', () => {
    if (step > 1) setStep(step - 1);
  });

  // Bootstrap validation
  form.addEventListener('submit', async function (event) {
    // Show only required fields of active section
    const selected = document.querySelector('input[name="objektart"]:checked');
    const activeSectionId = selected ? (selected.value === 'wohnung' ? 'detailsWohnung' : (selected.value === 'haus' ? 'detailsHaus' : 'detailsMFH')) : null;

    // temporarily disable required on hidden sections to not block validation
    document.querySelectorAll('[required]').forEach(el => {
      if (el.closest('.d-none')) el.dataset.requiredWas = '1', el.required = false;
    });

    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
      form.classList.add('was-validated');
      // restore required
      document.querySelectorAll('[data-required-was="1"]').forEach(el => { el.required = true; delete el.dataset.requiredWas; });
      return;
    }

    event.preventDefault();
    event.stopPropagation();

    // Collect data
    const formData = new FormData(form);
    formData.append('ts', new Date().toISOString());

    try {
      const res = await fetch('api/submit_price_request.php', {
        method: 'POST',
        headers: { 'X-CSRF-Token': CSRF_TOKEN },
        body: formData
      });
      const data = await res.json();
      if (data.ok) {
        const toast = new bootstrap.Toast(document.getElementById('toastSuccess'));
        toast.show();
        modal.hide();
      } else {
        alert('Fehler: ' + (data.error || 'Unbekannt'));
      }
    } catch (e) {
      alert('Netzwerkfehler: ' + e.message);
    } finally {
      // restore required
      document.querySelectorAll('[data-required-was="1"]').forEach(el => { el.required = true; delete el.dataset.requiredWas; });
    }
  });
})();
