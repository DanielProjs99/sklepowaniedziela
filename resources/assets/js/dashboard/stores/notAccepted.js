function showCoordinatesForm(elem) {
    const acceptForm = elem.parentNode.getElementsByClassName('store-accept-form')[0];
    const rejectForm = elem.parentNode.getElementsByClassName('store-reject-form')[0];

    let currentDisplay = acceptForm.style.display; 
    
    if (! currentDisplay || currentDisplay == "none") {
        acceptForm.style.display = "block";
    }
    else {
        acceptForm.style.display = "none";
    }

    rejectForm.style.display = "none";
}

function showRejectForm(elem) {
    const acceptForm = elem.parentNode.getElementsByClassName('store-accept-form')[0];
    const rejectForm = elem.parentNode.getElementsByClassName('store-reject-form')[0];

    let currentDisplay = rejectForm.style.display; 
    
    if (! currentDisplay || currentDisplay == "none") {
        rejectForm.style.display = "block";
    }
    else {
        rejectForm.style.display = "none";
    }

    acceptForm.style.display = "none";
}

if (document.getElementsByClassName('dashboard-store').length) {
    const acceptButtons = document.getElementsByClassName('store-accept-button');
    const rejectButtons = document.getElementsByClassName('store-reject-button');

    Array.from(acceptButtons).forEach(element => {
        element.addEventListener('click', () => showCoordinatesForm(element));
    });

    Array.from(rejectButtons).forEach(element => {
        element.addEventListener('click', () => showRejectForm(element));
    });
}