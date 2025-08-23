// BetterDeal Modal Functionality

document.addEventListener('DOMContentLoaded', function() {
    initBetterDealModal();
});

function initBetterDealModal() {
    const modal = document.getElementById('betterDealModal');
    const form = document.getElementById('betterDealForm');
    const messageDiv = document.getElementById('modalMessage');
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = document.getElementById('modalSpinner');
    const dynamicFields = document.getElementById('dynamicFields');

    // Handle objekttyp selection
    const objekttypInputs = document.querySelectorAll('input[name="objekttyp"]');
    objekttypInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.checked) {
                updateDynamicFields(this.value);
            }
        });
    });

    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset previous validation states
        form.classList.remove('was-validated');
        messageDiv.innerHTML = '';
        
        // Check if objekttyp is selected
        const selectedObjekttyp = document.querySelector('input[name="objekttyp"]:checked');
        if (!selectedObjekttyp) {
            showMessage('error', 'Bitte wählen Sie einen Objekttyp aus.');
            return;
        }
        
        // Check form validity
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        // Prepare form data
        const formData = collectFormData();

        // Show loading state
        setLoadingState(true);

        // Send Ajax request
        fetch('contact.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            setLoadingState(false);
            
            if (data.success) {
                showMessage('success', data.message);
                form.reset();
                form.classList.remove('was-validated');
                // Clear dynamic fields
                dynamicFields.innerHTML = '';
                // Reset objekttyp selection
                objekttypInputs.forEach(input => input.checked = false);
                // Close modal after short delay
                setTimeout(() => {
                    bootstrap.Modal.getInstance(modal).hide();
                }, 2000);
            } else {
                showMessage('error', data.errors.join('<br>'));
            }
        })
        .catch(error => {
            setLoadingState(false);
            console.error('Error:', error);
            showMessage('error', 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.');
        });
    });

    // Reset form when modal is closed
    modal.addEventListener('hidden.bs.modal', function() {
        form.reset();
        form.classList.remove('was-validated');
        messageDiv.innerHTML = '';
        dynamicFields.innerHTML = '';
        objekttypInputs.forEach(input => input.checked = false);
    });

    function updateDynamicFields(objekttyp) {
        let fieldsHTML = '';

        switch(objekttyp) {
            case 'wohnung':
                fieldsHTML = `
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Objektdetails - Wohnung</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="wohnflaeche" class="form-label">Wohnfläche (m²)</label>
                                <input type="number" class="form-control" id="wohnflaeche" name="wohnflaeche" min="1" required>
                                <div class="invalid-feedback">
                                    Bitte geben Sie die Wohnfläche ein.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="zimmer" class="form-label">Anzahl Zimmer</label>
                                <select class="form-select" id="zimmer" name="zimmer" required>
                                    <option value="">Bitte wählen...</option>
                                    <option value="1">1 Zimmer</option>
                                    <option value="1.5">1,5 Zimmer</option>
                                    <option value="2">2 Zimmer</option>
                                    <option value="2.5">2,5 Zimmer</option>
                                    <option value="3">3 Zimmer</option>
                                    <option value="3.5">3,5 Zimmer</option>
                                    <option value="4">4 Zimmer</option>
                                    <option value="4.5">4,5 Zimmer</option>
                                    <option value="5">5+ Zimmer</option>
                                </select>
                                <div class="invalid-feedback">
                                    Bitte wählen Sie die Anzahl der Zimmer aus.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="etage" class="form-label">Etage</label>
                                <select class="form-select" id="etage" name="etage" required>
                                    <option value="">Bitte wählen...</option>
                                    <option value="Erdgeschoss">Erdgeschoss</option>
                                    <option value="1. Etage">1. Etage</option>
                                    <option value="2. Etage">2. Etage</option>
                                    <option value="3. Etage">3. Etage</option>
                                    <option value="4. Etage">4. Etage</option>
                                    <option value="5+ Etage">5+ Etage</option>
                                </select>
                                <div class="invalid-feedback">
                                    Bitte wählen Sie die Etage aus.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="baujahr" class="form-label">Baujahr</label>
                                <input type="number" class="form-control" id="baujahr" name="baujahr" min="1800" max="2024" required>
                                <div class="invalid-feedback">
                                    Bitte geben Sie das Baujahr ein.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="balkon" class="form-label">Balkon/Terrasse</label>
                                <select class="form-select" id="balkon" name="balkon">
                                    <option value="nein">Nein</option>
                                    <option value="balkon">Balkon</option>
                                    <option value="terrasse">Terrasse</option>
                                    <option value="beides">Balkon und Terrasse</option>
                                </select>
                            </div>
                        </div>
                    </div>
                `;
                break;

            case 'haus':
                fieldsHTML = `
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Objektdetails - Haus</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="wohnflaeche" class="form-label">Wohnfläche (m²)</label>
                                <input type="number" class="form-control" id="wohnflaeche" name="wohnflaeche" min="1" required>
                                <div class="invalid-feedback">
                                    Bitte geben Sie die Wohnfläche ein.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="grundstueck" class="form-label">Grundstücksgröße (m²)</label>
                                <input type="number" class="form-control" id="grundstueck" name="grundstueck" min="1" required>
                                <div class="invalid-feedback">
                                    Bitte geben Sie die Grundstücksgröße ein.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="zimmer" class="form-label">Anzahl Zimmer</label>
                                <select class="form-select" id="zimmer" name="zimmer" required>
                                    <option value="">Bitte wählen...</option>
                                    <option value="3">3 Zimmer</option>
                                    <option value="4">4 Zimmer</option>
                                    <option value="5">5 Zimmer</option>
                                    <option value="6">6 Zimmer</option>
                                    <option value="7">7+ Zimmer</option>
                                </select>
                                <div class="invalid-feedback">
                                    Bitte wählen Sie die Anzahl der Zimmer aus.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="baujahr" class="form-label">Baujahr</label>
                                <input type="number" class="form-control" id="baujahr" name="baujahr" min="1800" max="2024" required>
                                <div class="invalid-feedback">
                                    Bitte geben Sie das Baujahr ein.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="haustyp" class="form-label">Haustyp</label>
                                <select class="form-select" id="haustyp" name="haustyp" required>
                                    <option value="">Bitte wählen...</option>
                                    <option value="Einfamilienhaus">Einfamilienhaus</option>
                                    <option value="Doppelhaushälfte">Doppelhaushälfte</option>
                                    <option value="Reihenhaus">Reihenhaus</option>
                                    <option value="Villa">Villa</option>
                                    <option value="Bungalow">Bungalow</option>
                                </select>
                                <div class="invalid-feedback">
                                    Bitte wählen Sie den Haustyp aus.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="garage" class="form-label">Garage/Stellplatz</label>
                                <select class="form-select" id="garage" name="garage">
                                    <option value="nein">Nein</option>
                                    <option value="stellplatz">Stellplatz</option>
                                    <option value="garage">Garage</option>
                                    <option value="carport">Carport</option>
                                </select>
                            </div>
                        </div>
                    </div>
                `;
                break;

            case 'mehrfamilienhaus':
                fieldsHTML = `
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Objektdetails - Mehrfamilienhaus</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="wohnflaeche" class="form-label">Gesamtwohnfläche (m²)</label>
                                <input type="number" class="form-control" id="wohnflaeche" name="wohnflaeche" min="1" required>
                                <div class="invalid-feedback">
                                    Bitte geben Sie die Gesamtwohnfläche ein.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="grundstueck" class="form-label">Grundstücksgröße (m²)</label>
                                <input type="number" class="form-control" id="grundstueck" name="grundstueck" min="1" required>
                                <div class="invalid-feedback">
                                    Bitte geben Sie die Grundstücksgröße ein.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="wohneinheiten" class="form-label">Anzahl Wohneinheiten</label>
                                <select class="form-select" id="wohneinheiten" name="wohneinheiten" required>
                                    <option value="">Bitte wählen...</option>
                                    <option value="2">2 Wohneinheiten</option>
                                    <option value="3">3 Wohneinheiten</option>
                                    <option value="4">4 Wohneinheiten</option>
                                    <option value="5">5 Wohneinheiten</option>
                                    <option value="6">6+ Wohneinheiten</option>
                                </select>
                                <div class="invalid-feedback">
                                    Bitte wählen Sie die Anzahl der Wohneinheiten aus.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="baujahr" class="form-label">Baujahr</label>
                                <input type="number" class="form-control" id="baujahr" name="baujahr" min="1800" max="2024" required>
                                <div class="invalid-feedback">
                                    Bitte geben Sie das Baujahr ein.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="vermietungsgrad" class="form-label">Vermietungsgrad</label>
                                <select class="form-select" id="vermietungsgrad" name="vermietungsgrad" required>
                                    <option value="">Bitte wählen...</option>
                                    <option value="0">Leerstand</option>
                                    <option value="25">25% vermietet</option>
                                    <option value="50">50% vermietet</option>
                                    <option value="75">75% vermietet</option>
                                    <option value="100">Vollvermietet</option>
                                </select>
                                <div class="invalid-feedback">
                                    Bitte wählen Sie den Vermietungsgrad aus.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="mieteinnahmen" class="form-label">Jährl. Mieteinnahmen (€)</label>
                                <input type="number" class="form-control" id="mieteinnahmen" name="mieteinnahmen" min="0">
                                <small class="form-text text-muted">Bei Vollvermietung (geschätzt)</small>
                            </div>
                        </div>
                    </div>
                `;
                break;
        }

        dynamicFields.innerHTML = fieldsHTML;
    }

    function collectFormData() {
        const formData = {
            form_type: 'betterdeal_modal',
            objekttyp: document.querySelector('input[name="objekttyp"]:checked')?.value || '',
            strasse: document.getElementById('strasse').value.trim(),
            plz: document.getElementById('plz').value.trim(),
            stadt: document.getElementById('stadt').value.trim(),
            bundesland: document.getElementById('bundesland').value,
            vorname: document.getElementById('modalVorname').value.trim(),
            nachname: document.getElementById('modalNachname').value.trim(),
            email: document.getElementById('modalEmail').value.trim(),
            telefon: document.getElementById('telefon').value.trim()
        };

        // Add dynamic fields based on objekttyp
        const dynamicInputs = dynamicFields.querySelectorAll('input, select');
        dynamicInputs.forEach(input => {
            if (input.name) {
                formData[input.name] = input.value;
            }
        });

        return formData;
    }

    function setLoadingState(loading) {
        if (loading) {
            submitBtn.disabled = true;
            spinner.classList.remove('d-none');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Wird verarbeitet...';
        } else {
            submitBtn.disabled = false;
            spinner.classList.add('d-none');
            submitBtn.innerHTML = 'Preiseinschätzung anfordern';
        }
    }

    function showMessage(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        messageDiv.innerHTML = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
    }
}