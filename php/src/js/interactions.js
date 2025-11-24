function validateLoginForm() {
  const username = document.querySelector('input[name="username"]');
  const password = document.querySelector('input[name="password"]');

  if (!username.value.trim() || !password.value.trim()) {
    alert("Please enter both username and password.");
    return false;
  }
  return true;
}

function clearDiagnosisRadios() {
  const radios = document.querySelectorAll('input[type="radio"]');
  radios.forEach(radio => radio.checked = false);
}

window.addEventListener("unload", clearDiagnosisRadios);