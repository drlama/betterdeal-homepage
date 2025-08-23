// BetterDeal landing + enhanced 5-step wizard (corrected MFH logic)
(function() {
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
        if (data.ok) { contactForm.reset(); new bootstrap.Toast(document.getElementById('toastContact')).show(); }
        else { alert(data.error || 'Fehler beim Senden'); }
      } catch (err) { alert('Netzwerkfehler: ' + err.message); }
    });
  }

  // Wizard
  const form = document.getElementById('preisrechnerForm');
  const btnWeiter = document.getElementById('btnWeiter');
  const btnSenden = document.getElementById('btnSenden');
  const btnZurueck = document.getElementById('btnZurueck');
  const wizardProgress = document.getElementById('wizardProgress');
  const objektartError = document.getElementById('objektartError');
  const autosaveInfo = document.getElementById('autosaveInfo');
  const basisHeading = document.getElementById('basisHeading');
  let step = 1;
  const totalSteps = 5;
  const LS_KEY = 'bd_price_wizard';

  function setStep(n) {
    step = n;
    document.querySelectorAll('.wizard-step').forEach(s => s.classList.add('d-none'));
    document.querySelector(`.wizard-step[data-step="${n}"]`).classList.remove('d-none');
    btnZurueck.disabled = (step === 1);
    btnSenden.classList.toggle('d-none', step !== totalSteps);
    btnWeiter.classList.toggle('d-none', step === totalSteps);
    wizardProgress.style.width = (step * 100 / totalSteps) + '%';
    document.querySelectorAll('.stepper .step').forEach((el) => {
      const s = parseInt(el.getAttribute('data-step'), 10);
      el.classList.toggle('active', s === step);
      el.classList.toggle('done', s < step);
    });
    if (step === totalSteps) renderSummary();
  }

  function resetWizard() {
    if (!form) return;
    form.reset();
    document.querySelectorAll('.segment .seg').forEach(c => c.classList.remove('active'));
    objektartError && (objektartError.style.display = 'none');
    toggleTypeFields();
    updateLiveSummary();
    setStep(1);
    try {
      const cached = JSON.parse(localStorage.getItem(LS_KEY) || '{}');
      Object.entries(cached).forEach(([k,v]) => {
        const el = form.elements[k]; if (!el) return;
        if (el.type === 'radio') {
          const r = form.querySelector(`input[name="${k}"][value="${v}"]`);
          if (r) { r.checked = true; r.dispatchEvent(new Event('change')); }
        } else { el.value = v; el.dispatchEvent(new Event('input')); }
      });
    } catch {}
  }

  document.addEventListener('change', (e) => {
    const t = e.target;
    if (t.matches('.btn-check[name="objektart"]')) {
      document.querySelectorAll('.segment .seg').forEach(c => c.classList.remove('active'));
      t.closest('label').querySelector('.seg').classList.add('active');
      objektartError && (objektartError.style.display = 'none');
      toggleTypeFields();
      updateLiveSummary();
      autosave();
    }
  });

  form && form.addEventListener('input', () => { updateLiveSummary(); autosave(); });

  function toggleTypeFields() {
    const art = getValue('objektart');
    const isHaus = art === 'haus';
    const isMFH = art === 'mehrfamilienhaus';
    const isWhg = art === 'wohnung';

    // Step 3 heading
    if (basisHeading) {
      if (isMFH) basisHeading.textContent = 'Mehrfamilienhaus-Spezifikation';
      else if (isHaus) basisHeading.textContent = 'Haus-Spezifikation';
      else if (isWhg) basisHeading.textContent = 'Details zur Wohnung';
      else basisHeading.textContent = 'Basisdaten';
    }

    // Step 3 fields
    show('fieldGrundstueck', isHaus);
    setRequired('b_grundstueck', isHaus);

    show('fieldWE', isMFH);
    setRequired('b_we', isMFH);

    show('fieldGesamtWF', isMFH);
    setRequired('b_gesamtwf', isMFH);

    show('fieldWohnflaeche', !isMFH);
    setRequired('b_wohnflaeche', !isMFH);

    // Step 4 blocks
    document.getElementById('ausstattungWhgHaus').classList.toggle('d-none', isMFH);
    document.getElementById('ausstattungMFH').classList.toggle('d-none', !isMFH);
  }

  function show(id, visible) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.toggle('d-none', !visible);
  }
  function setRequired(name, req) {
    const el = form.elements[name]; if (!el) return;
    el.required = !!req;
  }
  function getValue(name) {
    const el = form.elements[name];
    if (!el) return '';
    if (el.type === 'radio') {
      const checked = form.querySelector(`input[name="${name}"]:checked`);
      return checked ? checked.value : '';
    }
    return el.value || '';
  }

  function updateLiveSummary() {
    const art = getValue('objektart');
    const fl = art === 'mehrfamilienhaus' ? (getValue('b_gesamtwf') || '–') : (getValue('b_wohnflaeche') || '–');
    const map = {
      'adresse': getValue('adresse'),
      'objektart': (art || '–'),
      'b_baujahr': getValue('b_baujahr') || '–',
      'flaeche': fl,
      'b_energie': getValue('b_energie') || '–'
    };
    Object.entries(map).forEach(([k,v]) => {
      const el = document.querySelector(`[data-k="${k}"]`);
      if (el) el.textContent = v || '–';
    });
  }

  function autosave() {
    if (!form) return;
    const data = {};
    Array.from(form.elements).forEach(el => {
      if (!el.name) return;
      if (el.type === 'radio') {
        if (el.checked) data[el.name] = el.value;
      } else {
        data[el.name] = el.value;
      }
    });
    localStorage.setItem(LS_KEY, JSON.stringify(data));
    autosaveInfo && (autosaveInfo.classList.remove('d-none'), setTimeout(() => autosaveInfo.classList.add('d-none'), 900));
  }

  function renderSummary() {
    const art = getValue('objektart');
    const list = document.getElementById('summaryList'); if (!list) return;
    list.innerHTML = '';
    const labelsBase = {
      adresse:'Adresse', objektart:'Objektart',
      b_baujahr:'Baujahr', b_modernisierung:'Modernisierungsjahr',
      b_energie:'Energie-Label'
    };
    const labelsWhgHaus = {
      b_wohnflaeche:'Wohnfläche (m²)',
      a_zimmer:'Zimmer', a_baeder:'Bäder', a_balkon:'Balkon/Terrasse (m²)',
      a_garten:'Garten (m²)', a_garagen:'Garagenplätze', a_park:'Außenparkplätze',
      a_waerme:'Wärmeerzeugung'
    };
    const labelsHausOnly = { b_grundstueck:'Grundstück (m²)' };
    const labelsMFH = { b_we:'Wohneinheiten', b_gesamtwf:'Gesamtwohnfläche (m²)', m_netto_miete:'Nettomiete p.a. (EUR)' };

    const finalLabels = Object.assign({}, labelsBase);
    if (art === 'mehrfamilienhaus') Object.assign(finalLabels, labelsMFH);
    else {
      Object.assign(finalLabels, labelsWhgHaus);
      if (art === 'haus') Object.assign(finalLabels, labelsHausOnly);
    }

    // collect values
    const data = {};
    Object.keys(finalLabels).forEach(k => data[k] = getValue(k));

    Object.entries(finalLabels).forEach(([k,label]) => {
      const v = data[k];
      if (v === '' || v === null) return;
      const item = document.createElement('div');
      item.className = 'list-group-item d-flex justify-content-between';
      item.innerHTML = `<span class="text-muted">${label}</span><strong>${v}</strong>`;
      list.appendChild(item);
    });
  }

  if (btnWeiter) btnWeiter.addEventListener('click', () => {
    if (step === 1) {
      const adr = form.elements['adresse'];
      if (!adr.value.trim()) { adr.classList.add('is-invalid'); adr.focus(); return; }
      adr.classList.remove('is-invalid');
      setStep(2); return;
    }
    if (step === 2) {
      const selected = getValue('objektart');
      if (!selected) { objektartError && (objektartError.style.display = 'block'); return; }
      toggleTypeFields();
      setStep(3); return;
    }
    if (step === 3) {
      // requireds are set via toggleTypeFields
      if (!form.checkValidity()) { form.classList.add('was-validated'); return; }
      setStep(4); return;
    }
    if (step === 4) {
      setStep(5); return;
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
      if (data.ok) { new bootstrap.Toast(document.getElementById('toastSuccess')).show(); modal.hide(); localStorage.removeItem(LS_KEY); }
      else { alert('Fehler: ' + (data.error || 'Unbekannt')); }
    } catch (e) { alert('Netzwerkfehler: ' + e.message); }
    finally { document.querySelectorAll('[data-required-was="1"]').forEach(el => { el.required=true; delete el.dataset.requiredWas; }); }
  });

})();