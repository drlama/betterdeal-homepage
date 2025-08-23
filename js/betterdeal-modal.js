// Modal Logic for BetterDeal Homepage

document.addEventListener("DOMContentLoaded", function() {
  const modal = document.getElementById("betterdeal-modal");
  const openBtn = document.getElementById("betterdeal-btn");
  const closeBtn = document.getElementById("modal-close");
  const nextBtn = document.getElementById("next-step");
  const prevBtn = document.getElementById("prev-step");
  const step1 = document.getElementById("step-1");
  const step2 = document.getElementById("step-2");
  const form = document.getElementById("betterdeal-form");
  const dynamicFields = document.getElementById("dynamic-fields");

  // Open modal
  openBtn.onclick = () => {
    modal.classList.add("active");
    step1.classList.add("active");
    step2.classList.remove("active");
    form.reset();
  };

  // Close modal
  closeBtn.onclick = () => {
    modal.classList.remove("active");
  };
  window.onclick = (e) => {
    if (e.target === modal) modal.classList.remove("active");
  };

  // Next Step
  nextBtn.onclick = () => {
    // Validate address
    const address = document.getElementById("address").value.trim();
    if (!address) {
      alert("Bitte geben Sie Ihre Adresse ein.");
      return;
    }
    // Show dynamic fields based on objekttyp
    const objekttyp = document.querySelector('input[name="objekttyp"]:checked').value;
    dynamicFields.innerHTML = "";
    if (objekttyp === "wohnung") {
      addField("Größe der Wohnung (m²)", "wohnflaeche", "number", "min='10' max='500' required");
      addField("Baujahr", "baujahr", "number", "min='1800' max='2025' required");
      addField("Zimmeranzahl", "zimmer", "number", "min='1' max='10' required");
    } else if (objekttyp === "haus") {
      addField("Grundstücksfläche (m²)", "grundstueck", "number", "min='50' max='5000' required");
      addField("Baujahr", "baujahr", "number", "min='1800' max='2025' required");
      addField("Zimmeranzahl", "zimmer", "number", "min='2' max='15' required");
    } else if (objekttyp === "mehrfamilienhaus") {
      addField("Wohnfläche gesamt (m²)", "wohnflaeche", "number", "min='100' max='10000' required");
      addField("Anzahl Wohneinheiten", "einheiten", "number", "min='2' max='100' required");
      addField("Baujahr", "baujahr", "number", "min='1800' max='2025' required");
    }
    // Step switch
    step1.classList.remove("active");
    step2.classList.add("active");
  };

  // Previous Step
  prevBtn.onclick = () => {
    step2.classList.remove("active");
    step1.classList.add("active");
  };

  // Add a form field
  function addField(label, name, type, extra) {
    const div = document.createElement("div");
    div.className = "modal-input-group";
    div.innerHTML = `<label class="modal-label" for="${name}">${label}</label>
      <input type="${type}" id="${name}" name="${name}" ${extra} />`;
    dynamicFields.appendChild(div);
  }

  // Form submit
  form.onsubmit = function(e) {
    e.preventDefault();
    // Collect all field values
    const data = {};
    new FormData(form).forEach((v, k) => { data[k] = v });
    // Simulate API call (replace with real AJAX if needed)
    alert("Ihre Anfrage wurde übermittelt!\n\n" + JSON.stringify(data, null, 2));
    modal.classList.remove("active");
  };
});