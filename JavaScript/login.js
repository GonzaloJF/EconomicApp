const formLogin = document.querySelector("#login-form");

function validarEmail(email) {
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s]+$/;
  if (email === "") {
    alert("El email es obligatorio");
    return false;
  } else if (!regexEmail.test(email)) {
    alert("Error en el formato del email");
    return false;
  }
  return true;
}

function validarPassword(password) {
  if (password === "") {
    alert("La password no puede estar vacia");
    return false;
  }
  return true;
}
formLogin.addEventListener("submit", async (e) => {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;

  if (!validarEmail(email)) {
    return;
  }

  const data = {
    email: email,
    password: password,
  };

  try {
    const response = await fetch("../php/auth/loginUser.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });

    const resultado = await response.json();

    if (response.ok && resultado.success) {
      alert(resultado.message);
      formLogin.reset();
      window.location.href = "../pages/dashboard.php";
    } else {
      alert(
        "Error: " + (resultado.message || "No se puede procesar la solicitud"),
      );
    }
  } catch (error) {
    console.error("Error al iniciar sesion");
  }
});
