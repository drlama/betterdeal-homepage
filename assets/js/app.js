
(() => {
  const modalEl = document.getElementById('preisrechnerModal');
  if(!modalEl) return;

  const modal = new bootstrap.Modal(modalEl);
  const btnOpenList = [document.getElementById('btnPreisrechnerHero2')];
  btnOpenList.forEach(btn => btn && btn.addEventListener('click', () => modal.show()));
  // also attach to any element marked for price wizard
  document.querySelectorAll('[data-price-wizard]').forEach(btn => btn.addEventListener('click', () => modal.show()));


  const steps = Array.from(modalEl.querySelectorAll('.wizard-step'));
  const stepsNav = Array.from(modalEl.querySelectorAll('.wizard-steps li'));
  let step = 0;

  const liveSummary = modalEl.querySelector('#liveSummary');
  const state = { address:{}, typ:'wohnung', fields:{} };

  function setStep(n){
    step = Math.max(0, Math.min(steps.length-1, n));
    steps.forEach((s,i) => s.classList.toggle('d-none', i!==step));
    stepsNav.forEach((li,i) => li.classList.toggle('active', i===step));
    modalEl.querySelector('#btnBack').disabled = step===0;
    modalEl.querySelector('#btnNext').textContent = (step===steps.length-1?'Schließen': (step===steps.length-2 ? 'Absenden' : 'Weiter'));
  }

  function summaryRender(){
    const rows = [];
    const addr = [state.address.strasse, state.address.hausnr, state.address.plz, state.address.ort].filter(Boolean).join(' ');
    rows.push(['Adresse', addr || '–']);
    rows.push(['Objektart', state.typ || '–']);
    if(state.fields.baujahr) rows.push(['Baujahr', state.fields.baujahr]);
    if(state.fields.flaeche) rows.push(['Fläche', state.fields.flaeche + ' m²']);
    if(state.fields.grundstueck) rows.push(['Grundstück', state.fields.grundstueck + ' m²']);
    if(state.fields.energie) rows.push(['Energie', state.fields.energie]);
    liveSummary.innerHTML = rows.map(([k,v]) => `<dt class="col-6">${k}</dt><dd class="col-6 text-end">${v}</dd>`).join('');
  }

  // Address step
  const plz = modalEl.querySelector('#plz');
  const ortSelect = modalEl.querySelector('#ortSelect');
  const reloadOrte = modalEl.querySelector('#reloadOrte');
  const strasseSelect = modalEl.querySelector('#strasseSelect');
  const btnManuelleStrasse = modalEl.querySelector('#btnManuelleStrasse');
  const hausnr = modalEl.querySelector('#hausnr');

  async function fetchOrte(){
    const code = (plz.value||'').trim();
    ortSelect.innerHTML = `<option value="">Lade Orte…</option>`;
    try{
      const r = await fetch(`https://openplzapi.org/de/${code}`);
      if(!r.ok) throw new Error('HTTP '+r.status);
      const data = await r.json();
      if(Array.isArray(data) && data.length){
        ortSelect.innerHTML = `<option value="">Ort wählen…</option>` + data.map(o => `<option>${(o.ort || o.place || '').toString()}</option>`).join('');
      }else{
        ortSelect.innerHTML = `<option value="">Keine Orte gefunden</option>`;
      }
    }catch(err){
      ortSelect.innerHTML = `<option value="">Fehler – bitte manuell eingeben</option>`;
    }
  }

  async function fetchStrassen(){
    strasseSelect.innerHTML = `<option value="">Lade Straßen…</option>`;
    const code = (plz.value||'').trim();
    const ort = (ortSelect.value||'').trim();
    if(!code || !ort){ strasseSelect.innerHTML = `<option value="">Bitte Ort wählen</option>`; return; }
    try{
      // Versuch 1: hypothetischer Straßen-Endpunkt
      const r = await fetch(`https://openplzapi.org/de/${code}/${encodeURIComponent(ort)}/strassen`);
      if(r.ok){
        const data = await r.json();
        if(Array.isArray(data) && data.length){
          const opts = data.slice(0,300).map(s => `<option>${(s.strasse || s.street || s).toString()}</option>`).join('');
          strasseSelect.innerHTML = `<option value="">Straße wählen…</option>` + opts;
          return;
        }
      }
      // Fallback: manuelle Eingabe
      strasseSelect.innerHTML = `<option value="">Keine API-Daten – bitte manuell eingeben</option>`;
    }catch(err){
      strasseSelect.innerHTML = `<option value="">Straßen konnten nicht geladen werden</option>`;
    }
  }

  plz.addEventListener('input', () => { if(plz.value.length===5) fetchOrte(); });
  reloadOrte.addEventListener('click', fetchOrte);
  ortSelect.addEventListener('change', fetchStrassen);
  btnManuelleStrasse.addEventListener('click', () => {
    const manual = document.createElement('input');
    manual.className = 'form-control';
    manual.placeholder = 'Straße eingeben';
    manual.id = 'strasseInput';
    strasseSelect.replaceWith(manual);
  });

  // Objektart step
  modalEl.querySelectorAll('input[name="typ"]').forEach(r => r.addEventListener('change', () => {
    state.typ = r.value;
    buildFields();
    summaryRender();
  }));

  function makeInput(col, label, id, type='number', placeholder='', extra=''){
    return `<div class="col-md-${col}"><label class="form-label">${label}</label><input ${extra} class="form-control" id="${id}" type="${type}" placeholder="${placeholder}"></div>`;
  }
  function makeSelect(col, label, id, options){
    const opts = options.map(o => `<option>${o}</option>`).join('');
    return `<div class="col-md-${col}"><label class="form-label">${label}</label><select class="form-select" id="${id}"><option value="">Bitte wählen</option>${opts}</select></div>`;
  }

  function buildFields(){
    const c = modalEl.querySelector('#fieldsContainer');
    let html = '';
    if(state.typ==='wohnung'){
      html += makeInput(6,'Baujahr','baujahr','number','z. B. 1995');
      html += makeInput(6,'Wohnfläche (m²)','flaeche','number','z. B. 85');
      html += makeInput(6,'Etage','etage','number','z. B. 3');
      html += makeInput(6,'Anzahl Zimmer','zimmer','number','z. B. 3');
      html += makeInput(6,'Balkon / Terrasse (m²)','balkon','number','z. B. 6');
      html += makeInput(6,'Garten (m²)','garten','number','z. B. 10');
      html += makeSelect(6,'Energie-Label','energie',['A+','A','B','C','D','E','F','G']);
      html += makeSelect(6,'Art der Wärmeerzeugung','heizung',['Fernwärme','Gas','Öl','Wärmepumpe','Strom/Elektro','Sonstiges']);
    } else if(state.typ==='haus'){
      html += makeSelect(6,'Subtype','subtype',['Einfamilienhaus','Doppelhaushälfte','Reihenhaus','Bungalow','Villa']);
      html += makeSelect(6,'Transaktionstyp','tx',['Verkauf','Vermietung']);
      html += makeInput(6,'Baujahr','baujahr','number','z. B. 1990');
      html += makeInput(6,'Wohnfläche (m²)','flaeche','number','z. B. 140');
      html += makeInput(6,'Grundstücksfläche (m²)','grundstueck','number','z. B. 500');
      html += makeSelect(6,'Erbpacht','erbpacht',['Nein','Ja']);
      html += makeSelect(6,'Energie-Label','energie',['A+','A','B','C','D','E','F','G']);
      html += makeInput(6,'Anzahl Etagen','etagen','number');
      html += makeInput(6,'Anzahl Zimmer','zimmer','number');
      html += makeInput(6,'Anzahl Badezimmer','bads','number');
      html += makeInput(6,'Balkon / Terrasse (m²)','balkon','number');
      html += makeInput(6,'Garagenplätze','garage','number');
      html += makeInput(6,'Außenparkplätze','parken','number');
      html += makeSelect(6,'Art der Wärmeerzeugung','heizung',['Fernwärme','Gas','Öl','Wärmepumpe','Strom/Elektro','Sonstiges']);
    } else { // mfh
      html += `<h6 class="mt-2">Mehrfamilienhaus‑Spezifikation</h6>`;
      html += makeInput(6,'Baujahr','baujahr','number','z. B. 1965');
      html += makeInput(6,'Modernisierungsjahr','modj','number');
      html += makeInput(6,'Anzahl Wohneinheiten','einheiten','number');
      html += makeInput(6,'Gesamtwohnfläche (m²)','flaeche','number');
      html += makeInput(6,'Grundstücksfläche (m²)','grundstueck','number');
      html += makeSelect(6,'Energie-Label','energie',['A+','A','B','C','D','E','F','G']);
      html += makeInput(6,'Jährliche Nettomieteinnahmen (EUR)','miete','number');
    }
    c.innerHTML = html;

    // bind inputs to state
    c.querySelectorAll('input,select').forEach(inp => {
      inp.addEventListener('input', () => {
        state.fields[inp.id] = inp.value;
        summaryRender();
      });
    });
  }
  buildFields();

  // Next/Back/Submit
  modalEl.querySelector('#btnBack').addEventListener('click', e => { e.preventDefault(); setStep(step-1); });
  modalEl.querySelector('#btnNext').addEventListener('click', e => {
    e.preventDefault();
    if(step===0){
      // collect address
      const manStrasse = modalEl.querySelector('#strasseInput');
      state.address = {
        plz: plz.value.trim(),
        ort: ortSelect.value.trim(),
        strasse: manStrasse ? manStrasse.value.trim() : (strasseSelect.value || '').trim(),
        hausnr: hausnr.value.trim()
      };
      if(!state.address.plz || !state.address.ort || !state.address.hausnr){
        alert('Bitte PLZ, Ort und Hausnummer angeben.'); return;
      }
    }
    if(step===3){
      // submit -> simulate
      const prev = modalEl.querySelector('#summaryPreview');
      prev.innerHTML = liveSummary.innerHTML;
    }
    setStep(step+1);
  });

  modalEl.addEventListener('shown.bs.modal', () => setStep(0));
  summaryRender();
})();
