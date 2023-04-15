function validateEmail(emailV) {
    const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailRegex.test(emailV);
}

function validateUsername(usernameV) {
    const usernameRegex = /^[a-zA-Z0-9]+$/;
    return usernameRegex.test(usernameV);
}

function validateName(nameV) {
    const nameRegex = /^[a-zA-Z]+$/;
    return nameRegex.test(nameV);
}

function validatePassword(passwordV) {
    const pwRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/;
    const minLength = 8;
    const maxLength = 20;

    if (passwordV.length >= minLength && passwordV.length <= maxLength) {
        return pwRegex.test(passwordV);
    } else {
        return false;
    }
}

function validateSecurityAns(ansV) {
    return ansV.length > 0;
}

module.exports = {
    validateEmail,
    validateUsername,
    validateName,
    validatePassword,
    validateSecurityAns,
  };
