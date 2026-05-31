// Capturo el formulario
const form = document.querySelector("#form-registration-platform");

const inputEmail = document.getElementById("email");
// Validaciones de nombre
function validarName(name) {
  if (name === "") {
    alert("El nombre no puede quedar vacío");
    return false;
  }
  return true;
}

// Validaciones de apellido
function validarlastName(lastName) {
  if (lastName === "") {
    alert("El apellido no puede quedar en blanco");
    return false;
  }
  return true;
}

// Validación email
function validarEmail(email) {
  const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (email === "") {
    alert("El email no puede estar vacío");
    return false;
  } else if (!regexEmail.test(email)) {
    alert("No es un formato de email válido");
    return false;
  }
  return true;
}

// Validación contraseñas
function validarPasswords(password, confirmPassword) {
  if (password === "" || confirmPassword === "") {
    alert("Los campos de las contraseñas son obligatorios");
    return false;
  }
  // CORRECCIÓN: Se cambió && por || para que valide correctamente si CUALQUIERA es menor a 8
  else if (password.length < 8 || confirmPassword.length < 8) {
    alert("La longitud de la contraseña debe ser de al menos 8 caracteres");
    return false;
  } else if (password !== confirmPassword) {
    alert("Las contraseñas no coinciden");
    return false;
  }
  return true;
}

let emailUnic = false;
async function EmailUnico(email) {
  if (email === "") {
    return false;
  }
  try {
    const response = await fetch(`../php/auth/emailUnique.php?email=${email}`);
    if (!response.ok) {
      throw new Error("Error en la verificacion del email");
    }
    const data = await response.json();
    if (data.existe) {
      alert("Este email ya existe");
      emailUnic = false;
      return false;
    } else {
      emailUnic = true;
      return true;
    }
  } catch (error) {
    console.error("Error con la validacion del email", error);
    emailUnic = false;
    return false;
  }
}

inputEmail.addEventListener("blur", async (e) => {
  const email = e.target.value;

  if (validarEmail(email)) {
    await EmailUnico(email);
  }
});

// Evento enviar formulario
form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const name = document.getElementById("name").value.trim();
  const lastName = document.getElementById("lastName").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;

  // Realizamos validaciones en JS
  if (
    !validarName(name) ||
    !validarlastName(lastName) ||
    !validarEmail(email) ||
    !validarPasswords(password, confirmPassword)
  ) {
    return;
  }

  const register = {
    name_user: name,
    last_name: lastName,
    email: email,
    password: password,
    confirmPassword: confirmPassword,
  };

  try {
    // NOTA: Asegúrate de que esta ruta sea correcta desde donde se ejecuta el HTML
    const response = await fetch("../php/auth/registerUser.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(register),
    });

    // CORRECCIÓN: Manejar respuestas no-JSON de manera segura si el servidor se cae
    const contentType = response.headers.get("content-type");
    if (contentType && contentType.indexOf("application/json") !== -1) {
      const resultado = await response.json();

      if (response.ok && resultado.success) {
        alert(resultado.message);
        form.reset();
      } else {
        alert(
          "Error: " +
            (resultado.message || "No se puede procesar la solicitud"),
        );
      }
    } else {
      // Si el servidor devolvió un error HTML (un crash de PHP)
      const textError = await response.text();
      console.error("Error del servidor (No es JSON):", textError);
      alert("Ocurrió un error en la respuesta del servidor.");
    }
  } catch (error) {
    console.error("Error al intentar crear el usuario: ", error);
    alert("Ocurrió un error crítico al conectar con el servidor.");
  }
});
