export function filterNonEmptyValues(data) {
    const filteredData = {};
    for (const [key, value] of Object.entries(data)) {
        if (value !== null && value !== undefined && value !== '') {
            filteredData[key] = value;
        }
    }
    return filteredData;
}

export function clearFilter(formId) {
    document.getElementById(formId).reset(); 
}

export function showSuccessMessage(message) {
    alertify.success(message);
}

export function showErrorMessage(message) {
    alertify.error(message);
}
