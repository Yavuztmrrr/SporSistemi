function validatePass(p1, p2) {
    if (p1.value != p2.value) {
        p2.setCustomValidity('Parolanız Aynı Degildir.');

    } else {
        p2.setCustomValidity('');
    }
}

     