(function() {
  const modalEl = document.getElementById('preisrechnerModal');
  const modal = new bootstrap.Modal(modalEl);
  const openButtons = [document.getElementById('btnPreisrechnerHero')].filter(Boolean);
  openButtons.forEach(btn => btn.addEventListener('click', () => { resetWizard(); modal.show(); }));

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

    if (basisHeading) {
      if (isMFH) basisHeading.textContent = 'Mehrfamilienhaus-Spezifikation';
      else if (isHaus) basisHeading.textContent = 'Haus-Spezifikation';
      else if (isWhg) basisHeading.textContent = 'Details zur Wohnung';
      else basisHeading.textContent = 'Basisdaten';
    }

    show('fieldGrundstueck', isHaus);
    setRequired('b_grundstueck', isHaus);

    show('fieldWE', isMFH);
    setRequired('b_we', isMFH);

    show('fieldGesamtWF', isMFH);
    setRequired('b_gesamtwf', isMFH);

    show('fieldWohnflaeche', !isMFH);
    setRequired('b_wohnflaeche', !isMFH);

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
    if (document.getElementById('autosaveInfo')) {
      const ai = document.getElementById('autosaveInfo');
      ai.classList.remove('d-none'); setTimeout(() => ai.classList.add('d-none'), 900);
    }
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
    if (step === 1) { setStep(2); return; }
    if (step === 2) {
      const selected = getValue('objektart');
      if (!selected) { objektartError && (objektartError.style.display = 'block'); return; }
      toggleTypeFields();
      setStep(3); return;
    }
    if (step === 3) {
      if (!form.checkValidity()) { form.classList.add('was-validated'); return; }
      setStep(4); return;
    }
    if (step === 4) { setStep(5); return; }
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
  });


  // Helpers to swap selects to free-text with datalist as graceful fallback
  function swapToInput(selectEl, listId, placeholder) {
    if (!selectEl || selectEl.dataset.swapped === '1') return selectEl;
    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control';
    input.placeholder = placeholder || '';
    input.id = selectEl.id;
    input.name = selectEl.name;
    input.required = selectEl.required;
    input.disabled = false;
    const dl = document.createElement('datalist'); dl.id = listId;
    input.setAttribute('list', listId);
    // Move options -> datalist
    const opts = Array.from(selectEl.querySelectorAll('option')).map(o => o.value || o.textContent);
    dl.innerHTML = [...new Set(opts)].filter(Boolean).map(v => `<option value="${v}">`).join('');
    selectEl.after(dl);
    selectEl.after(input);
    selectEl.dataset.swapped = '1';
    selectEl.style.display = 'none';
    return input;
  }
  function revertToSelect(selectEl) {
    if (!selectEl || selectEl.dataset.swapped !== '1') return;
    const next = selectEl.nextElementSibling;
    const afterNext = next ? next.nextElementSibling : null;
    if (next && next.tagName === 'INPUT') next.remove();
    if (afterNext && afterNext.tagName === 'DATALIST') afterNext.remove();
    selectEl.dataset.swapped = '0';
    selectEl.style.display = '';
  }

  const adr = {
    plz: form ? document.getElementById('adr_plz') : null,
    ort: form ? document.getElementById('adr_ort') : null,
    str: form ? document.getElementById('adr_strasse') : null,
    hnr: form ? document.getElementById('adr_hnr') : null,
    full: form ? document.getElementById('adresse') : null,
    status: document.getElementById('adr_status')
  };
  let adrReady = false;
  function setStatus(html, ok=false) {
    if (!adr.status) return;
    adr.status.innerHTML = html || '';
    adr.status.className = ok ? 'ok' : 'bad';
  }
  async function fetchLocalities(plz) {
    const url = `api/openplz_localities.php?postalcode=${encodeURIComponent(plz)}`;
    const res = await fetch(url, {headers:{'X-CSRF-Token': CSRF_TOKEN}});
    return res.json();
  }
  async function fetchStreets(plz, city) {
    const url = `api/openplz_streets.php?postalcode=${encodeURIComponent(plz)}&locality=${encodeURIComponent(city)}`;
    const res = await fetch(url, {headers:{'X-CSRF-Token': CSRF_TOKEN}});
    return res.json();
  }
  function updateWeiterLock() { if (btnWeiter && step===1) btnWeiter.disabled = !adrReady; }
  function composeFull() {
    if (!adr.full) return;
    if (adr.plz?.value && adr.ort?.value && adr.str?.value && adr.hnr?.value) {
      adr.full.value = `${adr.str.value} ${adr.hnr.value}, ${adr.plz.value} ${adr.ort.value}`;
      setStatus(`<i class="bi bi-check-circle me-1"></i>Adresse geprüft: ${adr.full.value}`, true);
      adrReady = true;
    } else { adr.full.value = ''; adrReady = false; }
    updateWeiterLock();
  }
  if (adr.plz) {
    btnWeiter && (btnWeiter.disabled = true);
    adr.plz.addEventListener('input', async () => {
      const v = (adr.plz.value || '').replace(/\D+/g,'').slice(0,5);
      adr.plz.value = v;
      revertToSelect(adr.ort); adr.ort.innerHTML = '<option value="">Bitte PLZ eingeben</option>'; adr.ort.disabled = true;
      revertToSelect(adr.str); adr.str.innerHTML = '<option value="">Bitte Ort wählen</option>'; adr.str.disabled = true;
      adr.hnr.value = ''; adr.hnr.disabled = true;
      adrReady = false; composeFull();
      if (v.length === 5) {
        setStatus('<i class="bi bi-arrow-repeat"></i> Lade Orte …');
        try {
          const data = await fetchLocalities(v);
          if (!data.ok || !data.localities?.length) { 
          setStatus('<i class="bi bi-exclamation-circle"></i> Keine Orte via API gefunden – bitte Ort manuell eingeben.');
          // swap to input fallback
          const input = swapToInput(adr.ort, 'dl_orte', 'Ort eingeben');
          input.disabled = false; input.addEventListener('input', () => { adr.str.disabled = false; composeFull(); });
          adr.ort.disabled = false;
          return; 
        }
          adr.ort.innerHTML = '<option value="">Ort wählen</option>' + data.localities.map(o => `<option>${o}</option>`).join('');
          adr.ort.disabled = false;
          setStatus('<i class="bi bi-info-circle"></i> Ort wählen …');
        } catch(e) { setStatus('<i class="bi bi-x-circle"></i> OpenPLZ nicht erreichbar.'); }
      } else { setStatus(''); }
    });
    adr.ort.addEventListener('change', async () => {
      const plz = adr.plz.value, city = adr.ort.value;
      revertToSelect(adr.str); adr.str.innerHTML = '<option value="">Bitte Ort wählen</option>'; adr.str.disabled = true;
      adr.hnr.value = ''; adr.hnr.disabled = true;
      adrReady = false; composeFull();
      if (plz.length===5 && city) {
        setStatus('<i class="bi bi-arrow-repeat"></i> Lade Straßen …');
        try {
          const data = await fetchStreets(plz, city);
          if (!data.ok || !data.streets?.length) { 
          setStatus('<i class="bi bi-exclamation-circle"></i> Keine Straßen via API gefunden – bitte Straße manuell eingeben.');
          const input = swapToInput(adr.str, 'dl_strassen', 'Straße eingeben');
          input.disabled = false; input.addEventListener('input', () => { adr.hnr.disabled = !input.value; composeFull(); });
          adr.str.disabled = false;
          return; 
        }
          adr.str.innerHTML = '<option value="">Straße wählen</option>' + data.streets.map(s => `<option>${s}</option>`).join('');
          adr.str.disabled = false;
          setStatus('<i class="bi bi-info-circle"></i> Straße wählen …');
        } catch(e) { setStatus('<i class="bi bi-x-circle"></i> OpenPLZ nicht erreichbar.'); }
      }
    });
    adr.str.addEventListener('change', () => { adr.hnr.disabled = !adr.str.value; adr.hnr.focus(); composeFull(); });
    adr.hnr.addEventListener('input', () => composeFull());
  }
})();